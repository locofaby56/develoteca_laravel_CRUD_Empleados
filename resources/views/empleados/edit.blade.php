@extends('layouts.app')

@section('content')
<div class="container">
<form method="post" action="{{ url('/empleados/'.$empleados->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    @include('empleados.form', ['modo'=>'Editar'])

</form>
</div>
@endsection
