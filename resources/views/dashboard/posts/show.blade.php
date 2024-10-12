<x-main>
    <main class="px-5 pt-8 pb-8 bg-white rounded-lg shadow-md dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos">
                            <div >
                                <p>
                                <a href="/blog?category={{ $post->category->slug }}">
                                    <span class="bg-{{ $post->category->color }}-200 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                        {{ $post->category->name }}
                                    </span>
                                </a>
                            </p>
                                <a href="/blog?author={{ $post->author->username }}" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->author->name }}</a>
                                <p class="text-xs text-gray-500 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022">{{ $post->created_at->format('j F Y')  }}</time></p>
                            </div>
                        </div>
                    </address>
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $post->title }}</h1>
                </header>
                @if ($post->image)
                <div class="max-h-72 overflow-hidden bg-black">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}">
                </div>
                @else
                <img src="https://source.unsplash.com/?{{ $post->category->name }}" alt="{{ $post->category->name }}">
                @endif
                <p>{{ $post->body }}</p>

                

                {{-- Back --}}
                <a href="/dashboard/posts" class="px-4 py-2 font-medium no-underline text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">&laquo; Back</a>

                {{-- Update --}}
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="px-4 py-2 font-medium no-underline text-white bg-green-600 rounded-md hover:bg-green-500 focus:outline-none focus:shadow-outline-blue active:bg-green-600 transition duration-150 ease-in-out">Edit</a>

                {{-- Delete --}}
                <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="inline">
                    @method('delete')
                    @csrf
                  <button class="px-4 py-1 font-medium no-underline text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-blue active:bg-red-600 transition duration-150 ease-in-out" onclick="confirm('Delete this blog?')">
                    Delete
                  </button>
                </form>
            
            </article>
        </div>
    </main>
</x-main>
