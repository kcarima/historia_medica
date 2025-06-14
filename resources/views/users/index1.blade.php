<x-app-layout>

    @section('contenido')
    <div class="container">
        <h2>Usuarios</h2>
        <div class="row mb-3">
            <div class="col-md-8">
                <form method="GET" action="{{ route('users.index') }}" class="form-inline">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2" placeholder="Buscar usuario, nombre o email">
                    <button type="submit" class="btn btn-primary mr-2">Buscar</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Limpiar</a>
                </form>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ route('users.create') }}" class="btn btn-success">Nuevo Usuario</a>
               {{--  <a href="{ { route('users.pdf', request()->only('search')) }}" class="btn btn-outline-danger" target="_blank">Imprimir PDF</a>  --}}
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->descriction }}</td>
                    <td>
                        <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6">No hay usuarios registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $users->appends(request()->except('page'))->links() }}
        </div>
    </div>

    @endsection
</x-app-layout>