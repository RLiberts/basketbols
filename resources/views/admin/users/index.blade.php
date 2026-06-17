<x-layout>
    <x-slot name="title">{{ __('messages.users_title') }}</x-slot>

    <h1 class="mb-4">{{ __('messages.users_title') }}</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>{{ __('messages.user_name') }}</th>
                <th>{{ __('messages.user_email') }}</th>
                <th>{{ __('messages.user_role') }}</th>
                <th>{{ __('messages.user_status') }}</th>
                <th>{{ __('messages.user_actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.role', $user) }}" class="d-flex gap-2">
                            @csrf
                            @method('PUT')
                            <select name="role" class="form-select form-select-sm">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>{{ __('messages.role_user_label') }}</option>
                                <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>{{ __('messages.role_manager_label') }}</option>
                                <option value="secretary" {{ $user->role === 'secretary' ? 'selected' : '' }}>{{ __('messages.role_secretary_label') }}</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>{{ __('messages.role_admin_label') }}</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">{{ __('messages.save') }}</button>
                        </form>
                    </td>
                    <td>
                        @if($user->blocked)
                            <span class="badge bg-danger">{{ __('messages.user_blocked') }}</span>
                        @else
                            <span class="badge bg-success">{{ __('messages.user_active') }}</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.block', $user) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm {{ $user->blocked ? 'btn-success' : 'btn-danger' }}">
                                {{ $user->blocked ? __('messages.unblock') : __('messages.block') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>