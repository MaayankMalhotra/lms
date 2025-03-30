<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Config for Google Font -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        };
    </script>
</head>

<body class="bg-gray-100 text-gray-900 font-sans" style="font-family: 'Inter', sans-serif;">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="h-full bg-[#2c1d56] px-2  transition-all flex flex-col">
            @include('admin.partials.sidebar')
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-grow h-screen">
            <!-- Header -->
            <header class="bg-white shadow-md w-full px-6 py-2 flex justify-between items-center">
                @include('admin.partials.header')
            </header>

            <!-- Main Content -->
            <main class="flex-grow overflow-y-auto p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
