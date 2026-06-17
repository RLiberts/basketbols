<x-layout>
    <x-slot name="title">{{ __('messages.teams') }}</x-slot>
    <h1 class="mb-4">{{ __('messages.teams') }}</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('teams.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_team') }}</a>
    @endif
    @if($teams->count())
        <div class="row">
            @foreach($teams as $team)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if($team->logo)
                                <img src="{{ asset('storage/' . $team->logo) }}"
                                    alt="{{ __('messages.team_logo') }}"
                                    class="img-fluid mb-2" style="max-height: 80px;">
                            @endif
                            <h2 class="card-title">{{ $team->name }}</h2>
                            <p class="text-muted">{{ $team->city }}</p>
                            <a href="{{ route('teams.show', $team) }}" class="btn btn-primary">
                                {{ __('messages.view_profile') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">{{ __('messages.no_teams') }}</div>
    @endif
</x-layout>