<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="bg-white shadow-xl rounded-lg p-10 max-w-md text-center">
        <div class="text-red-500 text-6xl mb-4">⚠️</div>

        <h1>Page Not Found</h1>

        <p class="text-gray-600 mb-6">
            Please contact your <span class="font-semibold">IT Officer</span>.
        </p>

        <a href="{{ url('/') }}"
           class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Go Back Home
        </a>
    </div>

</body>
</html>
