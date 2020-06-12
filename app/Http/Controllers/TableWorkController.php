<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('tableWork.tableWork', [
            'acronym' => $acronym,
            'modules' => $modules,
            'user' => $user,
        ]);
    }
}
