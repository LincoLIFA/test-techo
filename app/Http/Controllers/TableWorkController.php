<?php

namespace App\Http\Controllers;

use App\Region;
use App\TableWork;
use Illuminate\Http\Request;

class TableWorkController extends UserController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = $this->getUser();
        $acronym = $this->acronymName();
        $modules = $this->getModules();
        $region = Region::all();

        return view('tableWork.tableWork', [
            'acronym' => $acronym,
            'modules' => $modules,
            'user' => $user,
            'region' => $region
        ]);
    }
    /**
     * Crea una nueva mesa de trabajo
     * @param Request $request
     */
    public function store(Request $request)
    {
        $table = new Tablework();
        $table->name = $request->name;
        $table->region_id = $request->id;
        $table->comuna = $request->comuna;
        $table->comunidad = $request->comunidad;
        $table->latitud = $request->latitud;
        $table->longitud = $request->longitud;
        $table->save();
    }



    public function updateTable($request, $id)
    {
        $table = TableWork::find($id);
        $table->name = $request->name;
        $table->region_id = $request->id;
        $table->comuna = $request->comuna;
        $table->comunidad = $request->comunidad;
        $table->latitud = $request->latitud;
        $table->longitud = $request->longitud;
        $table->update();
    }


    public function showUpdate(int $id)
    {
        $table = TableWork::find($id);
        $user = $this->getUser();
        $acronym = $this->acronymName();
        $modules = $this->getModules();
        $region = Region::all();

        return view('tableWork.tableWork', [
            'acronym' => $acronym,
            'modules' => $modules,
            'user' => $user,
            'table' => $table,
            'region' => $region
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $table = Tablework::findOrfail($id);
        $table->delete();
        return route('table_module');
    }
}
