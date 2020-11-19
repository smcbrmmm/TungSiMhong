<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div style="font-size: 30px">
                <i class="fa fa-home"></i> TungSiMhong
            </div>

        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('ชื่อ-นามสกุล') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="tel" value="{{ __('เบอร์โทรศัพท์') }}" />--}}
{{--                <x-jet-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" required autofocus autocomplete="tel" />--}}
{{--            </div>--}}

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('อีเมลล์') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('รหัสผ่าน') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('ยืนยันรหัสผ่าน') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('มีบัญชีอยู่แล้ว ?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
