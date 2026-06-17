<x-layout>
    <x-slot name="title">{{ __('messages.dashboard') }}</x-slot>

    <h1>{{ __('messages.welcome') }}, {{ auth()->user()->name }}!</h1>
    <p>{{ __('messages.your_role') }}: <strong>{{ auth()->user()->role }}</strong></p>

    @if(auth()->user()->isAdmin())
        <div class="alert alert-info">{{ __('messages.role_admin') }}</div>
    @elseif(auth()->user()->isManager())
        <div class="alert alert-info">{{ __('messages.role_manager') }}</div>
    @elseif(auth()->user()->isSecretary())
        <div class="alert alert-info">{{ __('messages.role_secretary') }}</div>
    @else
        <div class="alert alert-warning">{{ __('messages.role_user') }}</div>
    @endif
</x-layout>