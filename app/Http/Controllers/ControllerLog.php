<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ControllerLog extends Controller
{
    private string $logFilePath;
    private int $lastSize = 0;
    private array $lastEntries = [];

    public function __construct()
    {
        $this->logFilePath = storage_path('logs/laravel.log');
    }

    public function index()
    {
        $logContent = $this->getLogContent();
        $this->lastSize = File::size($this->logFilePath);
        $this->lastEntries = $logContent['entries'];

        return view('logView', [
            'entries' => $logContent['entries'],
            'fileSize' => $this->lastSize,
            'lastUpdate' => now()->toDateTimeString(),
        ]);
    }

    public function poll(Request $request)
    {
        $currentSize = File::size($this->logFilePath);

        if ($currentSize > $this->lastSize) {
            $newContent = $this->getNewLogContent($this->lastSize);
            $this->lastSize = $currentSize;

            return response()->json([
                'status' => 'new',
                'entries' => $newContent['entries'],
                'fileSize' => $currentSize,
                'lastUpdate' => now()->toDateTimeString(),
            ]);
        } elseif ($currentSize < $this->lastSize) {
            // Log was cleared or rotated
            $this->lastSize = $currentSize;
            $logContent = $this->getLogContent();
            $this->lastEntries = $logContent['entries'];

            return response()->json([
                'status' => 'cleared',
                'entries' => $logContent['entries'],
                'fileSize' => $currentSize,
                'lastUpdate' => now()->toDateTimeString(),
            ]);
        }

        return response()->json(['status' => 'no-change']);
    }

    private function getLogContent(): array
    {
        if (!File::exists($this->logFilePath)) {
            return ['entries' => []];
        }

        $logContent = File::get($this->logFilePath);
        return $this->parseLogContent($logContent);
    }

    private function getNewLogContent(int $offset): array
    {
        $handle = fopen($this->logFilePath, 'r');
        fseek($handle, $offset);
        $newContent = stream_get_contents($handle);
        fclose($handle);

        return $this->parseLogContent($newContent);
    }

    private function parseLogContent(string $content): array
    {
        $pattern = '/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.*)/';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        $entries = [];
        foreach ($matches as $match) {
            $message = $match[4];

            // Check if this is a CRUD operation
            $operation = $this->detectCrudOperation($message);

            if ($operation) {
                $entries[] = [
                    'timestamp' => $match[1],
                    'env' => $match[2],
                    'level' => strtolower($match[3]),
                    'message' => $message,
                    'raw' => $match[0],
                    'operation' => $operation,
                    'model' => $this->extractModelName($message),
                ];
            }
        }

        return ['entries' => array_reverse($entries)];
    }

    private function detectCrudOperation(string $message): ?string
    {
        $message = strtolower($message);

        if (str_contains($message, 'created') || str_contains($message, 'creating')) {
            return 'create';
        }

        if (str_contains($message, 'retrieved') || str_contains($message, 'reading')) {
            return 'read';
        }

        if (str_contains($message, 'updated') || str_contains($message, 'updating')) {
            return 'update';
        }

        if (str_contains($message, 'deleted') || str_contains($message, 'deleting')) {
            return 'delete';
        }

        // For Eloquent events
        if (str_contains($message, 'eloquent.created')) {
            return 'create';
        }

        if (str_contains($message, 'eloquent.retrieved')) {
            return 'read';
        }

        if (str_contains($message, 'eloquent.updated')) {
            return 'update';
        }

        if (str_contains($message, 'eloquent.deleted')) {
            return 'delete';
        }

        return null;
    }

    private function extractModelName(string $message): ?string
    {
        // Pattern for model names in typical Laravel log messages
        if (preg_match('/App\\\\Models\\\\([a-zA-Z]+)/', $message, $matches)) {
            return $matches[1];
        }

        // Pattern for model names in Eloquent events
        if (preg_match('/eloquent\.(created|updated|deleted|retrieved): App\\\\Models\\\\([a-zA-Z]+)/', $message, $matches)) {
            return $matches[2];
        }

        return null;
    }

    public function download(): BinaryFileResponse
    {
        return response()->download($this->logFilePath, 'laravel.log');
    }

    public function clear(): \Illuminate\Http\RedirectResponse
    {
        File::put($this->logFilePath, '');
        return redirect()->route('log.viewer')->with('success', 'Log file cleared successfully.');
    }
}