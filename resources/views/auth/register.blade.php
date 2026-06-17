<x-layout>
    <x-slot name="title">Reģistrācija</x-slot>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-4">Reģistrācija</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Vārds</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Epasts</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Parole</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Apstiprināt paroli</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Reģistrēties</button>
            </form>

            <p class="mt-3">Jau ir konts? <a href="{{ route('login') }}">Piesakies!</a></p>
        </div>
    </div>
</x-layout>