<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    public function database()
    {
        
        return view("doctor.export.database");
    }
    public function AllDatabase()
    {
        $host = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');
        $outputFile = storage_path('app/database/database_dump_' . date("Y-m-d") . '.sql');
    
        // Ensure the directory exists
        if (!file_exists(dirname($outputFile))) {
            mkdir(dirname($outputFile), 0755, true);
        }
    
        // Build the mysqldump command
        $command = sprintf(
            'mysqldump --host=%s --user=%s --password=%s %s > %s',
            escapeshellarg($host),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($outputFile)
        );
    
        // Execute the command
        exec($command, $output, $returnValue);
    
        // Check the command execution result
        if ($returnValue !== 0) {
            // Log the output for debugging
            return response()->json(['error' => "Database export failed: " . implode("\n", $output)], 500);
        }
    
        // Return the file for download
        return response()->download($outputFile)->deleteFileAfterSend(true);
    }

    
    public function storeDatabase(Request $request)
    {

      $file = $request->file('sql_file'); // Assuming file input name is 'sql_file'
  
      if ($file) {
          $filePath = $file->getRealPath();
          // Read SQL statements from the file
          $sql = file_get_contents($filePath);
  
          // Execute SQL statements
          DB::unprepared($sql);
  
          return redirect()->back()->with('success', 'Database imported successfully!');
      }
  
      return redirect()->back()->withErrors(['error', 'Error: File not found or empty.']);
  
    }
}
