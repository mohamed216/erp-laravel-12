<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Setting;

class NotificationSSEController extends Controller
{
    public function stream(Request $request)
    {
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        header('Access-Control-Allow-Origin: *');
        
        $lastCheck = time();
        
        while (true) {
            // Check for low stock
            $lowStockAlert = Setting::get('low_stock_alert', 10);
            $lowStockProducts = Product::with('inventory')
                ->get()
                ->filter(function($p) use ($lowStockAlert) {
                    return ($p->inventory?->stock_quantity ?? 0) < $lowStockAlert;
                });
            
            if ($lowStockProducts->count() > 0) {
                $data = json_encode([
                    'type' => 'low_stock',
                    'message' => 'Low stock alert: ' . $lowStockProducts->count() . ' products',
                    'products' => $lowStockProducts->pluck('name')->toArray()
                ]);
                echo "data: {$data}\n\n";
                ob_flush();
                flush();
            }
            
            // Send heartbeat every 30 seconds
            echo "data: " . json_encode(['type' => 'heartbeat', 'time' => time()]) . "\n\n";
            ob_flush();
            flush();
            
            // Sleep for 10 seconds
            sleep(10);
            
            // Close connection after 5 minutes to prevent memory issues
            if (time() - $lastCheck > 300) {
                break;
            }
        }
    }
}
