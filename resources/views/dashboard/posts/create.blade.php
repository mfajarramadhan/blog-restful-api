<x-main>
    <h1 class="text-2xl font-bold">Create Post </h1>
    <div class="flex flex-col w-full p-8 mx-auto mt-4 bg-white border rounded-lg">
        <form action="/dashboard/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="text-sm leading-7 text-gray-600">Title</label>
                <input type="text" autofocus id="title" name="title" class="w-full rounded border border-gray-300 bg-white py-1 px-3 text-base leading-8 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('title') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" required value="{{ old('title') }}" />
                @error('title')
                    <div class="text-xs text-red-600">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="slug" class="text-sm leading-7 text-gray-600">Slug</label>
                <input type="text" id="slug" name="slug" class="read-only:bg-gray-200 w-full rounded border border-gray-300 bg-white py-1 px-3 text-base leading-8 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('slug') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" required value="{{ old('slug') }}"/>
                @error('slug')
                    <div class="text-xs text-red-600">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="category" class="text-sm leading-7 text-gray-600">Category</label>
                <select class="block w-full text-sm font-medium transition duration-75 border border-gray-800 rounded-lg shadow-sm h-9 focus:border-blue-600 focus:ring-1 focus:ring-inset focus:ring-blue-600 bg-none" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected': ''}}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Blog Image</label>
                <img class="max-w-md img-preview max-h-32" alt="">
                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" id="image" name="image" onchange="previewImage()" type="file">
                @error('image')
                    <div class="text-xs text-red-600">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="body" class="text-sm leading-7 text-gray-600">Body</label>
                <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                <trix-editor input="body"></trix-editor>
                @error('body')
                    <div class="text-xs text-red-600">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            
            
            
            <button class="w-full px-6 py-2 text-lg text-white bg-indigo-500 border-0 rounded focus:bg-indigo-600 hover:bg-indigo-600 focus:outline-none">Create</button>
        </form>
    </div>
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
         title.addEventListener('change', function(){
            fetch('/dashboard/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
         }); 


        // // syntax sakti buat slug otomatis
        // // tapi minusnya ga cek database apakah ada kesamaan slug
        // // ga unik
        // const title = document.querySelector("#title");
        // const slug = document.querySelector("#slug");
        // title.addEventListener("keyup", function() {
        //     slug.value = title.value.toLowerCase().replace(/ /g, '-');
        // });
        // //g artinya keyword global berfungsi untuk mengambil lebih dari satu kata


        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault(); 
        })


        // Add previewImage
        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            imgPreview.style.display = "block";
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
</x-main>