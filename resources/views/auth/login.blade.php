<x-auth-layout>
    <form action="{{ route('user.login') }}" method="POST">
        @csrf
        <div class="max-w-md mx-auto bg-white shadow-xl rounded my-8 items-center justify-center">
            <div class="bg-gray-200 pt-8 pb-16">
                <div class="text-center text-gray-600 mb-6">Sign in with Email & Password</div>
                <div class="w-4/5 mx-auto">
                    <div class="flex items-center bg-white rounded shadow-md mb-4">
                        <span class="px-3">
                            <svg class="fill-current text-gray-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/></svg>
                        </span>
                        <input class="w-full h-12 focus:outline-none" type="email" name="email" value="user@mail.com" placeholder="Email">
                    </div>
                    <div class="flex items-center bg-white rounded shadow-md mb-4">
                        <span class="px-3">
                            <svg class="fill-current text-gray-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 8V6a6 6 0 1 1 12 0h-3v2h4a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/></svg>
                        </span>
                        <input class="w-full h-12 focus:outline-none" type="password" name="password" value="password" placeholder="Password">
                    </div>
                    <button class="bg-indigo-600 block mx-auto text-white text-sm uppercase rounded shadow-md px-6 py-2">Sign in</button>
                </div>
            </div>
        </div>
    </form>
</x-auth-layout>
