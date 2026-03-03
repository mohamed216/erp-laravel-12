<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function index()
    {
        $backups = glob(storage_path('app/backups/*.sql'));
        rsort($backups);
        return view('admin.backups.index', compact('backups'));
    }

    public function create()
    {
        $filename = 'backup_' . date('Y_m_d_H_i_s') . '.sql';
        $path = storage_path('app/backups');
        
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $tables = DB::select('SHOW TABLES');
        $dbName = config('database.connections.mysql.database');
        $sql = '';
        
        foreach ($tables as $table) {
            $tableName = $table->{'Tables_in_' . $dbName};
            $sql .= "DROP TABLE IF EXISTS `$tableName`;\n\n";
            
            $create = DB::select("SHOW CREATE TABLE `$tableName`")[0];
            $sql .= $create->{'Create Table'} . ";\n\n";
            
            $rows = DB::table($tableName)->get();
            foreach ($rows as $row) {
                $values = [];
                foreach ($row as $value) {
                    $values[] = is_null($value) ? 'NULL' : "'" . addslashes($value) . "'";
                }
                $sql .= "INSERT INTO `$tableName` VALUES (" . implode(', ', $values) . ");\n";
            }
            $sql .= "\n";
        }

        File::put($path . '/' . $filename, $sql);
        
        return back()->with('success', 'Backup created: ' . $filename);
    }

    public function download($file)
    {
        $path = storage_path('app/backups/' . $file);
        if (file_exists($path)) {
            return response()->download($path);
        }
        return back()->with('error', 'File not found');
    }

    public function restore(Request $r, $file)
    {
        $path = storage_path('app/backups/' . $file);
        
        if (!file_exists($path)) {
            return back()->with('error', 'File not found');
        }

        $r->validate(['confirm' => 'required']);

        try {
            DB::unprepared(file_get_contents($path));
            return back()->with('success', 'Database restored successfully from: ' . $file);
        } catch (\Exception $e) {
            return back()->with('error', 'Restore failed: ' . $e->getMessage());
        }
    }

    public function delete($file)
    {
        $path = storage_path('app/backups/' . $file);
        if (file_exists($path)) {
            unlink($path);
            return back()->with('success', 'Backup deleted');
        }
        return back()->with('error', 'File not found');
    }
}
