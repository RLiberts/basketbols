<x-layout>
    <x-slot name="title">{{ __('messages.register') }}</x-slot>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-4">{{ __('messages.register') }}</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.first_name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.password') }}</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">{{ __('messages.confirm_password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('messages.register') }}</button>
            </form>
            <p class="mt-3">{{ __('messages.already_account') }} <a href="{{ route('login') }}">{{ __('messages.login') }}</a></p>
        </div>
    </div>
</x-layout>