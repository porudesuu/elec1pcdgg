@extends ('generallayout')

@section('title', 'Dashboard')

@section('contents')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD Log Viewer</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            .log-entry {
                transition: all 0.3s ease;
            }

            .log-entry.new {
                background-color: rgba(74, 222, 128, 0.2);
                border-left: 4px solid rgba(74, 222, 128, 1);
            }

            .log-entry.updated {
                background-color: rgba(250, 204, 21, 0.2);
                border-left: 4px solid rgba(250, 204, 21, 1);
            }

            .log-entry.deleted {
                background-color: rgba(248, 113, 113, 0.2);
                border-left: 4px solid rgba(248, 113, 113, 1);
            }

            .operation-create {
                color: #10b981;
            }

            .operation-read {
                color: #3b82f6;
            }

            .operation-update {
                color: #f59e0b;
            }

            .operation-delete {
                color: #ef4444;
            }

            .badge-create {
                background-color: #10b981;
                color: white;
            }

            .badge-read {
                background-color: #3b82f6;
                color: white;
            }

            .badge-update {
                background-color: #f59e0b;
                color: white;
            }

            .badge-delete {
                background-color: #ef4444;
                color: white;
            }
        </style>
    </head>

    <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">CRUD Operations Log</h1>
                <div class="flex space-x-4">
                    <button id="refreshBtn" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        <i class="fas fa-sync-alt mr-2"></i>Refresh
                    </button>
                    <button id="clearBtn" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                        <i class="fas fa-trash-alt mr-2"></i>Clear Log
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
                <div class="p-4 bg-gray-800 text-white flex justify-between items-center">
                    <div>
                        <span class="font-mono">laravel.log (CRUD operations only)</span>
                        <span class="text-gray-400 ml-4">Size: {{ round($fileSize / 1024, 2) }} KB</span>
                    </div>
                    <div id="lastUpdate" class="text-gray-400">
                        Last updated: {{ $lastUpdate }}
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Timestamp</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Operation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Model</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Details</th>
                            </tr>
                        </thead>
                        <tbody id="logEntries" class="bg-white divide-y divide-gray-200">
                            @foreach($entries as $entry)
                                <tr class="log-entry">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry['timestamp'] }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium operation-{{ $entry['operation'] }}">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium badge-{{ $entry['operation'] }}">
                                            {{ strtoupper($entry['operation']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($entry['model'])
                                            <span class="font-mono bg-gray-100 px-2 py-1 rounded">{{ $entry['model'] }}</span>
                                        @else
                                            <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $entry['message'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="emptyState"
                class="bg-white rounded-lg shadow-md p-8 text-center {{ count($entries) ? 'hidden' : '' }}">
                <i class="fas fa-file-alt text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">No CRUD operations found</h3>
                <p class="mt-1 text-sm text-gray-500">The log file doesn't contain any CRUD operations yet.</p>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Poll for new log entries every 5 seconds
                const pollInterval = 5000;
                let polling = true;

                function pollLogs() {
                    if (!polling) return;

                                                .catch (error => {
                        console.error('Error polling logs:', error);
                    })
                .finally(() => {
                    setTimeout(pollLogs, pollInterval);
                });
                                        }

            function addNewEntries(entries) {
                const logEntries = document.getElementById('logEntries');
                const emptyState = document.getElementById('emptyState');

                if (entries.length === 0) return;

                emptyState.classList.add('hidden');

                entries.forEach(entry => {
                    const row = document.createElement('tr');
                    row.className = 'log-entry new';
                    row.innerHTML = `
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${entry.timestamp}</td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium operation-${entry.operation}">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium badge-${entry.operation}">
                                                                            ${entry.operation.toUpperCase()}
                                                                        </span>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                        ${entry.model ? `<span class="font-mono bg-gray-100 px-2 py-1 rounded">${entry.model}</span>` : '<span class="text-gray-400">N/A</span>'}
                                                                    </td>
                                                                    <td class="px-6 py-4 text-sm text-gray-500">${entry.message}</td>
                                                                `;

                    if (logEntries.firstChild) {
                        logEntries.insertBefore(row, logEntries.firstChild);
                    } else {
                        logEntries.appendChild(row);
                    }

                    // Remove highlight after 3 seconds
                    setTimeout(() => {
                        row.classList.remove('new');
                    }, 3000);
                });
            }

            function replaceAllEntries(entries) {
                const logEntries = document.getElementById('logEntries');
                const emptyState = document.getElementById('emptyState');

                logEntries.innerHTML = '';

                if (entries.length === 0) {
                    emptyState.classList.remove('hidden');
                    return;
                }

                emptyState.classList.add('hidden');

                entries.forEach(entry => {
                    const row = document.createElement('tr');
                    row.className = 'log-entry deleted';
                    row.innerHTML = `
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${entry.timestamp}</td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium operation-${entry.operation}">
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium badge-${entry.operation}">
                                                                            ${entry.operation.toUpperCase()}
                                                                        </span>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                        ${entry.model ? `<span class="font-mono bg-gray-100 px-2 py-1 rounded">${entry.model}</span>` : '<span class="text-gray-400">N/A</span>'}
                                                                    </td>
                                                                    <td class="px-6 py-4 text-sm text-gray-500">${entry.message}</td>
                                                                `;

                    logEntries.appendChild(row);

                    // Remove highlight after 3 seconds
                    setTimeout(() => {
                        row.classList.remove('deleted');
                    }, 3000);
                });
            }

            function updateLastUpdate(timestamp) {
                document.getElementById('lastUpdate').textContent = `Last updated: ${timestamp}`;
            }

            // Manual refresh
            document.getElementById('refreshBtn').addEventListener('click', function () {
                                    .catch (error => {
                    console.error('Error refreshing logs:', error);
                });
                            });

            // Clear log confirmation
            document.getElementById('clearBtn').addEventListener('click', function () {
                if (confirm('Are you sure you want to clear the log file? This action cannot be undone.')) {

                }
            });

            // Start polling
            pollLogs();

            // Stop polling when tab is inactive
            document.addEventListener('visibilitychange', function () {
                polling = !document.hidden;
                if (polling) pollLogs();
            });
        });
        </script>
    </body>

    </html>
@endsection