<x-layout>
    <x-slot name="title">{{ __('messages.add_team') }}</x-slot>
    <h1 class="mb-4">{{ __('messages.add_team') }}</h1>
    <form method="POST" action="{{ route('teams.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('messages.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.city') }}</label>
            <input type="text" name="city" class="form-control" value="{{ old('city') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.manager') }}</label>
            <select name="manager_id" class="form-select">
                <option value="">{{ __('messages.no_manager') }}</option>
                @foreach($managers as $manager)
                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.logo') }}</label>
            <input type="file" name="logo" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('teams.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</x-layout>