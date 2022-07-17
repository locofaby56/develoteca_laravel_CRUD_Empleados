@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    {{-- <span aria-hidden="true">&times;</span> --}}
                </button>
                
            </div>
            @endif

    <a href="{{ route('empleados.create') }}" class=" btn btn-success "> Nuevo registro de empleado</a>
    <br>
    <br>
    <table class="table table-dark">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleadoitem)
                <tr>
                    <td>{{ $empleadoitem->id }}</td>
                    <td>
                        <img class="img-thumbnail img-fluid"
                            src="{{ asset('storage') . '/' . $empleadoitem->foto_empleado }}" width="150"
                            alt="">
                    </td>
                    <td>{{ $empleadoitem->nombres }}</td>
                    <td>{{ $empleadoitem->apellidos }}</td>
                    <td>{{ $empleadoitem->correo }}</td>
                    <td>
                        <a href="{{ url('/empleados/' . $empleadoitem->id . '/edit') }}" class="btn btn-warning">
                            Editar
                        </a>
                        |
                        <form action="{{ url('/empleados/' . $empleadoitem->id) }}" class="d-inline" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" onclick="return confirm('¿Quieres Borrar?')" value="Borrar"
                                class="btn btn-danger">
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
    <div class="col-12 d-flex justify-content-center text-center">
        {!! $empleados->links(); !!}
    </div>
</div>
    
    </div>
@endsection
