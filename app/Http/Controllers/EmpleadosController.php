<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
// libreria para manejo del storage (imagenes)
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    public function index()
    {
        $datos['empleados'] = Empleados::paginate(2);
        return view('empleados.index', $datos);
    }


    public function create()
    {
        return view('empleados.create');
    }


    public function store(Request $request)
    {
        // Validaciones del formulario
        $campos=[
            'nombres'=>'required|string|max:100',
            'apellidos'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto_empleado'=>'required|max:100000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requierido ',
            'foto_empleado.required'=>'La foto es requierida ',
        ];
        $this->validate($request,$campos,$mensaje);
        // FIN Validaciones del formulario

        //trae todos los datos del post 
        //$datosdeempleado = request()->all();
        // le agregamos sentencia que nos quite el campo token 
        $datosdeempleado = request()->except('_token');
        // validamos si hay foto
        if ($request->hasFile('foto_empleado')) {
            $datosdeempleado['foto_empleado'] = $request->file('foto_empleado')->store('uploads', 'public');
        }

        // gracias al modelo realizamos directamente el insert a la BD
        Empleados::insert($datosdeempleado);
        //return response()->json($datosdeempleado);
        return redirect('empleados')->with('mensaje', 'Empleado agregado con Exito!!');
    }


    public function show(Empleados $empleados)
    {
        //
    }


    public function edit($id)
    {
        $empleados = Empleados::findOrFail($id);
        return view('empleados.edit', compact('empleados'));
    }


    public function update(Request $request, $id)
    {

        // Validaciones del formulario
        $campos = [
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'correo' => 'required|email',
            
        ];
        $mensaje = [
            'required' => 'El :attribute es requierido ',
            'foto_empleado.required' => 'La foto es requierida ',
        ];
        if ($request->hasFile('foto_empleado')) {
            $campos = [
                'foto_empleado' => 'required|max:100000|mimes:jpeg,png,jpg'
            ];
            $mensaje = [
            'foto_empleado.required' => 'La foto es requierida ',
            ];
        }
        $this->validate($request, $campos, $mensaje);
        // FIN Validaciones del formulario


        //dd($id, $request);
        $datosdeempleado = request()->except('_token', '_method');
        // validamos si hay foto
        if ($request->hasFile('foto_empleado')) {

            $empleados = Empleados::findOrFail($id);

            Storage::delete('public/', $empleados->foto_empleado);

            $datosdeempleado['foto_empleado'] = $request->file('foto_empleado')->store('uploads', 'public');
        }

        Empleados::where('id', '=', $id)->update($datosdeempleado);

        $empleados = Empleados::findOrFail($id);
        // asi se deja por si se desea seguir editando 
        /* return view('empleados.edit', compact('empleados')); */
        // o asi para redirecionar a la pagina principal con el mensaje de la accion 
        return redirect('empleados')->with('mensaje', 'Empleado Editado con Exito!!');
    }


    public function destroy($id)
    {
        //Buscamos la imagen para borrar del storage
        $empleados = Empleados::findOrFail($id);
        //preguntamos y borramos 
        if (storage::delete('public/' . $empleados->foto_empleado)) {
            Empleados::destroy($id);
        }
        return redirect('empleados')->with('mensaje', 'Empleado Eliminado con Exito!!');
    }
}
