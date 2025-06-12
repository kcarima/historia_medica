<x-app-layout>

    @section('contenido')
    <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
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
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name ?? 'Sin Rol' }}</td> {{-- Muestra el nombre del rol --}}
                            <td>
                                <a href="{{ route('users.show', $user) }}" title="Detalle">Ver</a>
                                <a href="{{  route('users.edit', $user) }}" title="Editar">Editar</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Eliminar" onclick="return confirm('¿Estás seguro Que desea Eliminar el usuario?')">Eliminar</button>
                                </form>
                            </td>
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
