<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'company_name' => Setting::get('company_name', 'My Company'),
            'company_email' => Setting::get('company_email', 'info@company.com'),
            'company_phone' => Setting::get('company_phone', ''),
            'company_address' => Setting::get('company_address', ''),
            'currency' => Setting::get('currency', 'SAR'),
            'tax_rate' => Setting::get('tax_rate', 15),
            'low_stock_alert' => Setting::get('low_stock_alert', 10),
        ];
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $r)
    {
        foreach ($r->except('_token') as $key => $value) {
            Setting::set($key, $value);
        }
        return back()->with('success', 'Settings updated');
    }
}
