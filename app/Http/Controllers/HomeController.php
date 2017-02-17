<?php namespace App\Http\Controllers;

use App\Models\Institucion;
use App\Models\PsicologoHasGrupo;
use App\Models\UsersHasTest;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $tipo_usuario = Auth::user()->tipoUsuario_codigoTipoUsuario;
        $institucion = Institucion::lists('nombre', 'codigoInstitucion');
        if($tipo_usuario == 0) {
            $board_user = 'b_root';
            $grupos = "";
            return view('home', compact('institucion', 'board_user', 'grupos'));
        }
        elseif($tipo_usuario == 1) {
            $board_user = 'b_admin';
            $grupos = "";
            return view('home', compact('institucion', 'board_user', 'grupos'));
        }
        elseif($tipo_usuario == 2) {
            $board_user = 'b_psicologo';
            $grupos = PsicologoHasGrupo::where('users_id', Auth::user()->id)->select('grupo_codigoGrupo')->get()->lists('grupo_codigoGrupo');
            return view('home', compact('institucion', 'board_user', 'grupos'));
        }
        elseif($tipo_usuario == 3) {
            $board_user = 'b_estudiante';
            $grupos = "";
            return view('home', compact('institucion', 'board_user', 'grupos'));
            //Modificar para que
            /*if (!UsersHasTest::where('users_id', '=', Auth::user()->id)->where('estadoTest', '=', 0)->get()->isEmpty()) {
                return view('home', compact('institucion', 'board_user', 'grupos'));
            }
            else {
                return view('home', compact('institucion', 'board_user', 'grupos'));
            }*/
        }
    }

}