<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-screen-xl px-4 py-4 mx-auto lg:px-6">
        <div class="max-w-screen-md mx-auto sm:text-center">
            <form>
                {{-- Jika pencarian judul blog diluar category, maka jangan tampilkan apa2 --}}
                @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                {{-- Jika pencarian judul blog diluar author, maka jangan tampilkan apa2 --}}
                @if(request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="items-center max-w-screen-sm mx-auto mb-3 space-y-4 sm:flex sm:space-y-0">
                    <div class="relative w-full">
                        <label for="search" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search</label>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                              </svg>
                        </div>
                        <input class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search.." type="search" id="search" name="search" autocomplete="off">
                    </div>
                    <div>
                        <button type="submit" class="w-full px-5 py-3 text-sm font-medium text-center text-white border rounded-lg cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-screen-xl px-4 py-4 mx-auto lg:py-8 lg:px-0">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-5 text-gray-500">
                        <a href="/blog?category={{ $post->category->slug }}">
                        <span class="bg-{{ $post->category->color }}-200 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                            {{ $post->category->name }}
                        </span>
                        </a>
                        <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="/blog/{{ $post->slug }}">
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white hover:underline">{{ Str::limit($post->title,25) }}</h2>
                    </a>
                    <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ Str::limit($post->body, 150) }}</p>
                    <div class="flex items-center justify-between">
                        <a href="/blog?author={{ $post->author->username }}">
                        <div class="flex items-center space-x-2">
                            <img class="rounded-full w-7 h-7" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar" />
                            <span class="text-sm font-medium dark:text-white">
                                {{ Str::limit($post->author->name, 20) }}
                            </span>
                        </div>
                    </a>
                        <a href="/blog/{{ $post->slug }}" class="inline-flex items-center text-sm font-medium text-primary-600 dark:text-primary-500 hover:underline">
                            Read more
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                    </div>
                </article> 
            @empty
            <div class="absolute left-0 right-0 text-center">
                <p class="my-2 text-3xl font-bold">Article Not Found!</p>
                <a href="/blog" class="inline-flex items-center text-sm font-medium text-primary-600 dark:text-primary-500 hover:underline">&laquo; Back </a>
            </div>
            @endforelse
        </div>  
    </div>
    {{ $posts->links() }}

</x-layout>
