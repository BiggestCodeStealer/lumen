<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;

class SensorsController extends Controller
{
    //consultar todos los sensores
    public function index(){
        //return Sensor::all();
        return Sensor::paginate();
    }

    //consultar un sensor
    public function show($id){
        return Sensor::find($id);
    }

    //crear un sensor
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:sensors',
            'type' => 'required',
            'value' => 'required',
            'date' => 'required',
            'user_id' => 'required',
        ]);
        $sensor = new Sensor;
        $sensor->fill($request->all());
        $sensor->save();
        return $sensor;
    }

    //actualizar un sensor
    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'filled|unique:sensors'
        ]);
        $sensor = Sensor::find($id);
        if(!$sensor) return response('El sensor no existe', 404);
        $sensor->update($request->all());
        $sensor->save();
        return $sensor;
    }

    //eliminar un sensor
    public function destroy($id){
        $sensor = Sensor::find($id);
        if(!$sensor) return response('El sensor no existe', 404);
        $sensor->delete();
        return $sensor;
    }
}
