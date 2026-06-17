<x-layout>
    <x-slot name="title">{{ __('messages.edit_team') }}</x-slot>
    <h1 class="mb-4">{{ __('messages.edit_team') }}</h1>
    <form method="POST" action="{{ route('teams.update', $team) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">{{ __('messages.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $team->name) }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.city') }}</label>
            <input type="text" name="city" class="form-control" value="{{ old('city', $team->city) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.manager') }}</label>
            <select name="manager_id" class="form-select">
                <option value="">{{ __('messages.no_manager') }}</option>
                @foreach($managers as $manager)
                    <option value="{{ $manager->id }}"
                        {{ $team->manager_id == $manager->id ? 'selected' : '' }}>
                        {{ $manager->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.team_logo') }}</label>
            @if($team->logo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $team->logo) }}" style="max-height: 80px;">
                </div>
                <div class="form-check mb-2">
                    <input type="checkbox" name="remove_logo" id="remove_logo" class="form-check-input">
                    <label for="remove_logo" class="form-check-label">{{ __('messages.remove_logo') }}</label>
                </div>
            @endif
            <input type="file" name="logo" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('teams.show', $team) }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
    </form>
</x-layout>