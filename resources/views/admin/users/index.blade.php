<x-layout>
    <x-slot name="title">Lietotāju pārvaldība</x-slot>

    <h1 class="mb-4">Lietotāju pārvaldība</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Vārds</th>
                <th>Epasts</th>
                <th>Loma</th>
                <th>Statuss</th>
                <th>Darbības</th>
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
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>user</option>
                                <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>manager</option>
                                <option value="secretary" {{ $user->role === 'secretary' ? 'selected' : '' }}>secretary</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Saglabāt</button>
                        </form>
                    </td>
                    <td>
                        @if($user->blocked)
                            <span class="badge bg-danger">Bloķēts</span>
                        @else
                            <span class="badge bg-success">Aktīvs</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.block', $user) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm {{ $user->blocked ? 'btn-success' : 'btn-danger' }}">
                                {{ $user->blocked ? 'Atbloķēt' : 'Bloķēt' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>