<h2>{{ $modo . ' Empleado' }}</h2>
 {{-- forma de mostrar una lista de errores del formulario --}}
@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    </div>
@endif
 {{-- FIN forma de mostrar una lista de errores del formulario --}}

<div class="form-group">

    <label for="nombres"> Nombres </label>
    <input type="text" class="form-control" name="nombres" id="nombres"
        value="{{ isset($empleados->nombres) ? $empleados->nombres : old('nombres') }}">
    <br>

    <label for="apellidos"> Apellidos </label>
    <input type="text" class="form-control" name="apellidos" id="apellidos"
        value="{{ isset($empleados->apellidos) ? $empleados->apellidos : old('apellidos') }}">
    <br>
    <label for="correo"> correo </label>
    <input type="email" class="form-control" name="correo" id="correo"
        value="{{ isset($empleados->correo) ? $empleados->correo : old('correo') }}">
    <br>
    <label for="foto"> foto </label>

    @if (isset($empleados->foto_empleado))
        {{ $empleados->foto_empleado }} <br>
        <img src="{{ asset('storage') . '/' . $empleados->foto_empleado }}" class="img-thumbnail img-fluid"
            width="150" alt="">
    @endif

    <input type="file" class="form-control" name="foto_empleado" id="foto_empleado" value="">
    <br>

    <input type="submit" value="{{ $modo . ' Empleado' }}" class="btn btn-success">
    <a href="{{ route('empleados.index') }}" class="btn btn-primary"> Regresar </a>

</div>
