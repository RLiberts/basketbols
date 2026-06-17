<x-layout>
    <x-slot name="title">Pievienot komandu</x-slot>
    <h1 class="mb-4">Pievienot komandu</h1>
    <form method="POST" action="{{ route('teams.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nosaukums</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Pilsēta</label>
            <input type="text" name="city" class="form-control" value="{{ old('city') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Menedžeris</label>
            <select name="manager_id" class="form-select">
                <option value="">Nav menedžera</option>
                @foreach($managers as $manager)
                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" name="logo" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Saglabāt</button>
        <a href="{{ route('teams.index') }}" class="btn btn-secondary">Atcelt</a>
    </form>
</x-layout>