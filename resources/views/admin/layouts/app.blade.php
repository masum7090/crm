<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head')
    @stack('css')
</head>

<body class="bg-gray-50 dark:bg-slate-900 text-slate-900 dark:text-slate-50 transition-colors duration-300">
    <!-- Header -->

    @include('admin.layouts.header')


    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 z-30 opacity-0 invisible transition-all lg:hidden" id="backdrop"></div>

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')


    <!-- Main Content -->
    <main class="ml-0 lg:ml-64 mt-14 p-4 sm:p-6 transition-all duration-300" id="main">

        <div>
            {{ $slot }}
        </div>

    </main>

    @include('admin.layouts.script')

    @stack('js')



</body>

</html>
