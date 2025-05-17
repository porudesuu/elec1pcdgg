<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance | We'll Be Back Soon</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center min-h-screen p-4">
    <div class="max-w-2xl w-full bg-white rounded-xl shadow-lg overflow-hidden animate__animated animate__fadeIn">
        <div class="p-8 md:p-10 text-center">
            <div class="flex justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-500 animate-pulse-slow" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">This is the Global Middleware</h1>
            <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                We're currently working on improving your experience. The site will be back online shortly.
                Thank you for your patience!
            </p>

            <div class="bg-blue-50 rounded-lg p-4 mb-8">
                <div class="flex items-center justify-center space-x-2 text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Estimated downtime: 30 minutes</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <a href="#"
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition duration-200">
                    Refresh Page
                </a>
                <a href="mailto:support@example.com"
                    class="px-6 py-3 border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium rounded-lg transition duration-200">
                    Contact Support
                </a>
            </div>
        </div>

        <div class="bg-gray-50 px-8 py-4 text-center text-sm text-gray-500">
            <p>© 2023 Your Company. All rights reserved.</p>
        </div>
    </div>
</body>

</html>