<x-main>
    <h1 class="text-2xl font-bold">Edit Category </h1>
    <div class="flex flex-col w-full p-8 mx-auto mt-4 bg-white border rounded-lg">
        <form action="/dashboard/categories/{{ $category->slug }}" method="POST">
            @method('put')
            @csrf
            <div class="mb-4">
                <label for="name" class="text-sm leading-7 text-gray-600">Category Name</label>
                <input type="text" autofocus id="name" name="name" class="w-full rounded border border-gray-300 bg-white py-1 px-3 text-base leading-8 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('name') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" required value="{{ old('name', $category->name) }}" />
                @error('name')
                    <div class="text-xs text-red-600">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="slug" class="text-sm leading-7 text-gray-600">Slug</label>
                <input type="text" id="slug" name="slug" class="read-only:bg-gray-200 w-full rounded border border-gray-300 bg-white py-1 px-3 text-base leading-8 text-gray-700 outline-none transition-colors duration-200 ease-in-out focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('slug') valid:border-red-600 valid:focus:border-red-600 valid:focus:ring-red-200 @enderror" required value="{{ old('slug', $category->slug) }}"/>
                @error('slug')
                    <div class="text-xs text-red-600">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <button class="w-full px-6 py-2 text-lg text-white bg-indigo-500 border-0 rounded focus:bg-indigo-600 hover:bg-indigo-600 focus:outline-none">Update Post</button>
        </form>
    </div>
    
    <script>
        // const title = document.querySelector('#title');
        // const slug = document.querySelector('#slug');
        //  title.addEventListener('keyup', function(){
        //     fetch('/dashboard/checkSlug?title=' + title.value)
        //     .then(response => response.json())
        //     .then(data => slug.value = data.slug)
        //  }); 


        // // syntax sakti buat slug otomatis
        // // tapi minusnya ga cek database apakah ada kesamaan slug
        // // ga unik
        const title = document.querySelector("#title");
        const slug = document.querySelector("#slug");
        title.addEventListener("keyup", function() {
            slug.value = title.value.toLowerCase().replace(/ /g, '-');
        });
        // //g artinya keyword global berfungsi untuk mengambil lebih dari satu kata


        // document.addEventListener('trix-file-accept', function(e){
        //     e.preventDefault(); 
        // })

        // Add previewImage
        // function previewImage(){
        //     const image = document.querySelector('#image');
        //     const imgPreview = document.querySelector('.img-preview');
        //     imgPreview.style.display = "block";
        //     const oFReader = new FileReader();
        //     oFReader.readAsDataURL(image.files[0]);
        //     oFReader.onload = function(oFREvent){
        //         imgPreview.src = oFREvent.target.result;
        //     }
        // }
    </script>
</x-main>