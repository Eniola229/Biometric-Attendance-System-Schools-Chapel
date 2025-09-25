<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FingerprintController extends Controller
{
    public function capture()
    {
        set_time_limit(300);

        $pythonPath = 'C:\Users\Admin\AppData\Local\Programs\Python\Python313-32\python.exe'; 
        $scriptPath = base_path('fingerprint/fingerprint_capture.py');
        $outputPath = base_path('fingerprint/fingerprint_output.json');

        // Clean previous output
        if (file_exists($outputPath)) {
            @unlink($outputPath);
        }

        // Build command and capture stdout & stderr
        $command = "\"{$pythonPath}\" \"{$scriptPath}\" 2>&1";
        exec($command, $output, $return_var);

        // Log error details (even if successful for debugging)
        Log::info('Running fingerprint capture script...');
        Log::info('Command: ' . $command);
        Log::info('Output:', $output);
        Log::info('Exit Code: ' . $return_var);

        // Handle failure gracefully
        if ($return_var !== 0 || !file_exists($outputPath)) {
            Log::error('Fingerprint capture failed', [
                'command' => $command,
                'output' => $output,
                'exit_code' => $return_var
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Fingerprint capture failed. Please contact administrator.'
            ], 500);
        }

        // If successful, read and return the result
        $result = json_decode(file_get_contents($outputPath), true);
        return response()->json($result);
    }
}
