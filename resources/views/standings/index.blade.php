<x-layout>
    <x-slot name="title">{{ __('messages.standings') }}</x-slot>
    <h1 class="mb-4">{{ __('messages.standings') }}</h1>
    @if($standings->count())
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.team_name') }}</th>
                    <th>{{ __('messages.team_city') }}</th>
                    <th>{{ __('messages.players') }}</th>
                    <th>{{ __('messages.games') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($standings as $index => $standing)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('teams.show', $standing['team']) }}">
                                {{ $standing['team']->name }}
                            </a>
                        </td>
                        <td>{{ $standing['team']->city ?? '-' }}</td>
                        <td>{{ $standing['players'] }}</td>
                        <td>{{ $standing['played'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">{{ __('messages.no_teams') }}</div>
    @endif
</x-layout>