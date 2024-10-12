

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Home</title>

    {{-- trix editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"]{
            display: none;
        }
    </style>
</head>
<body>
   <div class="flex h-screen bg-gray-100">

      <!-- sidebar -->
      <x-sidebar></x-sidebar>

      <!-- Main content -->
      <div class="flex flex-col flex-1 overflow-y-auto">
        <x-header-dashboard></x-header-dashboard>
        <div class="p-4">
            {{ $slot }}
        </div>
    </div>      
  </div>
 
  
<script>
    const hamburger = document.querySelector('#hamburger');
    const sidebar = document.querySelector('#sidebar');
    hamburger.onclick = () => {
        sidebar.classList.toggle('hidden');
    }
</script>
</body>
</html>