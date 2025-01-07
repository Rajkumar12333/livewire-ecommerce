<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Livewire</title>
    @livewireStyles
</head>
<body>
    <nav>
        <!-- Navbar Content -->
    </nav>

    <div class="container">
        <!-- The slot for Livewire content -->
        {{ $slot }}
    </div>

    @livewireScripts
    @stack('scripts')  <!-- For DataTables scripts -->
</body>
</html>
