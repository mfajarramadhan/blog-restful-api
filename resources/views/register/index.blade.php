<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="login">
          <!--
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
  ```
-->
      <div class="flex min-h-full flex-col justify-center px-6 pb-12 lg:px-8">
          <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-3 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign Up</h2>
          </div>
          <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

            {{-- form --}}
            <form class="space-y-3" action="/register" method="POST">
              @csrf
              <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                  <input id="name" name="name" type="text" required autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') valid:ring-red-600 @enderror" value={{ old('name') }}>
                  @error('name')
                    <div class="text-red-600 text-xs">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div>
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                <div class="mt-2">
                  <input id="username" name="username" type="text" required autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('username') valid:ring-red-600 @enderror" value={{ old('username') }}>
                  @error('username')
                    <div class="text-red-600 text-xs">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                  <input id="email" name="email" type="email" required autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('email') valid:ring-red-600 @enderror" value={{ old('email') }}>
                  @error('email')
                    <div class="text-red-600 text-xs">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div>
                <div class="flex items-center justify-between">
                  <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                  <div class="text-sm">
                    <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                  </div>
                </div>
                <div class="mt-2">
                  <input id="password" name="password" type="password" required autocomplete="current-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('password') invalid:ring-red-600 @enderror">
                  @error('password')
                    <div class="text-red-600 text-xs">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
        
              <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign Up</button>
              </div>
            </form>
        
            <p class="mt-10 text-center text-sm text-gray-500">
              Have an account?
              <a href="/login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign In</a>
            </p>
          </div>
        </div>
    </div>
</x-layout>