<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $title }} </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
     <div class="mb-6 px-[50px] py-[40px] flex gap-4 items-center justify-between bg-blue-400 text-[#fff]">
        <div class="flex gap-8">
            <a href="#" class="text-xl font-semibold cursor-pointer">
                Početna
            </a>
            <a href="{{ route('posts') }}" class="text-xl font-semibold cursor-pointer">
                Postovi
            </a>
            <a href="{{ route('group-posts') }}" class="text-xl font-semibold cursor-pointer">
                Grupisani postovi
            </a>
        </div>

        
    </div>
    <div class="px-[50px] mb-2">
        {{ $slot }}
    </div>
    
</body>
</html>