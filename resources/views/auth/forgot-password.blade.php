<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
        رمز عبور خود را فراموش کرده اید؟ مشکلی نیست. فقط آدرس ایمیل خود را به ما اطلاع دهید و ما پیوند بازنشانی رمز عبور را برای شما ایمیل می کنیم که به شما امکان می دهد یک رمزعبور جدید انتخاب کنید.
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('passwordaction.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" value="ایمیل" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    ارسال لینک بازنشانی رمزعبور به ایمیل
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
