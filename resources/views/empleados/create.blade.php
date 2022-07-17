@extends('layouts.app')

@section('content')
<div class="container">
<form method="post" action="{{route('empleados.store')}}" enctype="multipart/form-data">
  @csrf
  @include('empleados.form', ['modo'=>'Crear'])
  <br>

</form>
</div>
@endsection