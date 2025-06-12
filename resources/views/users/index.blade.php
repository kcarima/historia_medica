<x-app-layout>

    @section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="top-bar mb-2 col-end-9">
                <div class="card my-4">
                    <div class=" p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h2 class="text-black text-capitalize ps-3">Lista de Usuarios</h2>
                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-border btn-round"><span class="icon">+ </span>Crear Usuario</a>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <button href="{{ route('users.index') }}" class="btn btn-refresh" title="Recargar">⟳</button>
                                <button class="btn btn-print" title="Imprimir">🖨️</button>

                                <div class="filters mb-3">
                                    <div class="filter-group">
                                        <input type="text" class="form-control" placeholder="Usuario" />
                                        <button class="btn btn-search" title="Buscar">🔍</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="table-header mb-2">
                            Total de usuarios | {{ $users->count() }} de {{ $users->count() }}
                        </div>
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Acciones</th>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td with='5px' >
                                            <a href="{{ route('users.show', $user) }}" class="edit-icon" title="Detalle"><i class="bi bi-layout-text-window-reverse"></i></a>
                                            <a href="{{  route('users.edit', $user) }}"  class="edit-icon" title="Editar"><i class="bi bi-pencil-square"></i></a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <a class="edit-icon" type="submit" title="Eliminar" onclick="return confirm('¿Estás seguro Que desea Eliminar el usuario?')"><i class="bi bi-eraser"></i></a>
                                            </form>
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name ?? 'Sin Rol' }}</td> {{-- Muestra el nombre del rol --}}

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
          </div>
        </div>
    </div>

    @endsection
</x-app-layout>
