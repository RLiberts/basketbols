<x-layout>
    <x-slot name="title">Pieteikšanās</x-slot>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-4">Pieteikšanās</h1>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Epasts</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Parole</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Atcerēties mani</label>
                </div>
                <button type="submit" class="btn btn-primary">Pieteikties</button>
            </form>
            <p class="mt-3">Nav konta? <a href="{{ route('register') }}">Reģistrējies!</a></p>
        </div>
    </div>
</x-layout>