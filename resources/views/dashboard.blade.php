<x-layout>
    <x-slot name="title">Dashboard</x-slot>

    <h1>Sveiks, {{ auth()->user()->name }}!</h1>
    <p>Tava loma: <strong>{{ auth()->user()->role }}</strong></p>

    @if(auth()->user()->isAdmin())
        <div class="alert alert-info">Tu esi administrators. Tev ir pilna piekļuve sistēmai.</div>
    @elseif(auth()->user()->isManager())
        <div class="alert alert-info">Tu esi menedžeris. Tu vari pārvaldīt savu komandu.</div>
    @elseif(auth()->user()->isSecretary())
        <div class="alert alert-info">Tu esi sekretārs. Tu vari ievadīt spēļu statistiku.</div>
    @else
        <div class="alert alert-warning">Tava loma vēl nav piešķirta. Sagaidi administratora apstiprinājumu.</div>
    @endif
</x-layout>