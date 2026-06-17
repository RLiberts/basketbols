<x-layout>
    <x-slot name="title">Komandas</x-slot>
    <h1 class="mb-4">Komandas</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('teams.create') }}" class="btn btn-primary mb-3">Pievienot komandu</a>
    @endif
    @if($teams->count())
        <div class="row">
            @foreach($teams as $team)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if($team->logo)
                                <img src="{{ asset('storage/' . $team->logo) }}"
                                    class="img-fluid mb-2" style="max-height: 80px;">
                            @endif
                            <h5 class="card-title">{{ $team->name }}</h5>
                            <p class="text-muted">{{ $team->city }}</p>
                            <a href="{{ route('teams.show', $team) }}" class="btn btn-primary">
                                Skatīt profilu
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Nav nevienas komandas.</div>
    @endif
</x-layout>