<?php

namespace App\Http\Controllers;

use App\Region;
use App\Region_TableWork;
use App\TableWork;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProfileController extends UserController
{

    /** Controllador para los cambios en los perfiles */


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

        return view('profile.profile', [
            'acronym' => $acronym,
            'modules' => $modules,
            'user' => $user
        ]);
    }

    public function showOwner(Request $request)
    {

        $region = Region::all();
        $table = Tablework::all();
        $acronym = $this->acronymName();
        $modules = $this->getModules();

        $find = $request->id;
        if (is_null($find)) {
            $find = 13;
        }
        $data = $this->getWorkTable($find);

        $array = $this->processData($data);

        return view('owner.owner', [
            'acronym' => $acronym,
            'modules' => $modules,
            'data' => $array,
            'region' => $region
        ]);
    }

    /**
     * Retorna el perfil del dueño de una mascota
     * @param int $id
     * @return mixed
     */
    public function showProfile(int $id)
    {
        $acronym = $this->acronymName();
        $modules = $this->getModules();
        $user = User::find($id);
        return view('profile.profile', [
            'acronym' => $acronym,
            'modules' => $modules,
            'user' => $user
        ]);
    }

    /**
     * Obtiene la mesa de trabajo por region
     * @param int $region
     * @return json $data
     */
    public function getWorkTable($region)
    {
        $response = Http::asForm()->post('https://domain.chile.techo.org/api/v2/', [
            'f' => 'gms',
            'region' => $region,
        ]);
        $data = $response->getBody()->getContents();
        return $data;
    }

    /**
     * Procesa json de API Techo para generar Tabla
     * @param json $data
     * @return array $processData
     */
    public function processData($data)
    {
        $decode = json_decode($data);
        return $decode->data;
    }

    /**
     * Genera Mapa en Google Maps de Mesas de trabajo
     * @param string $latitud
     * @param string $longitud
     * @return object
     */
    public function googleMaps(string $latitud, string $longitud)
    {
        $key = 'AIzaSyBL8rFtgXOvnzsJuWoWh7mj2rFSmwv5VE8';
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $latitud . ',' . $longitud . '&key=' . $key;
        $response = Http::post($url);
        return $response->getBody()->getContents();
    }
}
