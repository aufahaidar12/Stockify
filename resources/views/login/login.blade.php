<x-login_layout.app>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Sign in to your account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 max-w">
                    Or
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                        create an account
                    </a>
                </p>
            </div>
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                @include('components.login_layout.form')
            </div>
        </div>
    </div>
</x-login_layout.app>
