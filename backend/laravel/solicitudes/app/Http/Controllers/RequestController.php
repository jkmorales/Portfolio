<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use App\Models\Solicitud;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    private static $response = [
        'status'  => 'Success',
        'message' => 'Ok',
        'data'    => [],
    ];

    private static $user = null;

    public function __construct()
    {

    }

    private function getUser($id)
    {
        return User::where('id',$id)->join('perfiles as p', 'p.pkPerfil', 'users.fkPerfil')->first();
    }

    private function getSolicitudes($estatus)
    {
        switch (strtoupper($estatus))
        {
            case 'ELIMINADAS':
                $filtro = 3;
                break;
            case 'GENERADAS':
                $filtro = 4;
                break;
            case 'DENEGADAS':
                $filtro = 5;
                break;
            case 'AUTORIZADAS':
                $filtro = 6;
                break;
            case 'ENTREGADAS':
                $filtro = 7;
                break;
            default:
                $filtro = 6;
        }

        $solicitudes = Solicitud::select('solicitudes.created_at as creada','solicitudes.updated_at as autorizada',
            'solicitudes.fkOt as ot','solicitudes.monto','solicitudes.observaciones','solicitudes.pkSolicitud as id',
            'u.name','u.paterno','u.materno','p.perfil','rs.*','f.signature_b64 as firma')
            ->join('users as u','u.id','solicitudes.fkUser')
            ->join('record_status as rs','rs.pkRecordStatus','solicitudes.fkRecordStatus')
            ->join('perfiles as p', 'p.pkPerfil', 'u.fkPerfil')
            ->leftJoin('firmas as f', 'solicitudes.fkFirma', 'f.pkFirmas')
            ->where('solicitudes.fkRecordStatus',$filtro)
            ->orderBy('solicitudes.updated_at','DESC')
            ->get();

        return $solicitudes;
    }

    private function getSolicitudesUsuarios($id)
    {
        $solicitudes = Solicitud::select('solicitudes.created_at as creada','solicitudes.updated_at as autorizada',
            'solicitudes.fkOt as ot','solicitudes.monto','solicitudes.observaciones','rs.*','p.perfil')
            ->join('users as u','u.id','solicitudes.fkUser')
            ->join('record_status as rs','rs.pkRecordStatus','solicitudes.fkRecordStatus')
            ->join('perfiles as p', 'p.pkPerfil', 'u.fkPerfil')
            ->where('solicitudes.fkUser',$id)
            ->orderBy('creada')
            ->get();

        return $solicitudes;
    }

    public function getTeamLeaders()
    {
        $teamLeaders = User::where('fkPerfil',3)->get();

        self::$response['data'] = [
            'teamLeaders' => $teamLeaders
        ];

        return self::$response;
    }

    public function index()
    {
        $solicitudes = Solicitud::select('solicitudes.created_at as creada','u.name','u.paterno','solicitudes.*','rs.*',
                                         'f.signature_b64 as firma')
                                ->join('users as u','u.id','solicitudes.fkUser')
                                ->join('record_status as rs','rs.pkRecordStatus','solicitudes.fkRecordStatus')
                                ->leftJoin('firmas as f', 'solicitudes.fkFirma', 'f.pkFirmas')
                                ->orderBy('fkRecordStatus','ASC')
                                ->get();

        self::$response['data'] = [
                'solicitudes' => $solicitudes
        ];

        return self::$response;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $solicitud = Solicitud::create($request->all());

        self::$response['data'] = [
            'solicitud' => $solicitud
        ];

        return self::$response;
    }

    public function show($id)
    {
        $solicitud = Solicitud::select('solicitudes.created_at as creada','solicitudes.updated_at as autorizada',
            'solicitudes.fkOt as ot','solicitudes.monto','solicitudes.observaciones',
            'u.name','u.paterno','u.materno')
            ->join('users as u','u.id','solicitudes.pkSolicitud')
            ->where('solicitudes.pkSolicitud',$id)
            ->get();

        self::$response['data'] = [
            'solicitudes' => $solicitud
        ];

        return self::$response;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $solicitud = Solicitud::find($id);
        $solicitud->observaciones = $request->observaciones;
        $solicitud->monto = $request->monto;
        $solicitud->save();

        self::$response['data'] = [
            'solicitud' => $solicitud
        ];

        return self::$response;
    }

    public function destroy($id)
    {
        $solicitud = Solicitud::find($id);
        $solicitud->fkRecordStatus = 3;
        $solicitud->update();
        $solicitud->delete();

        self::$response['data'] = [
            'solicitud' => $solicitud
        ];

        return self::$response;
    }

    public function autorizar(Request $request, $id)
    {
        $solicitud = Solicitud::find($id);
        $solicitud->observaciones = $request->observaciones;
        $solicitud->monto = $request->monto;
        $solicitud->fkRecordStatus = 6;
        $solicitud->save();

        self::$response['data'] = [
            'solicitud' => $solicitud
        ];

        return self::$response;
    }

    public function denegar($id)
    {
        $solicitud = Solicitud::find($id);
        $solicitud->fkRecordStatus = 5;
        $solicitud->update();

        self::$response['data'] = [
            'solicitud' => $solicitud
        ];

        return self::$response;
    }

    public function firmar(Request $request)
    {
        $id_solicitud = $request->solicitud['id'];
        $firma = new Signature();
        $firma->file_path = 'https://';
        $firma->file_name = 'Firma_' . $id_solicitud;
        $firma->file_ext  = '.jpg';
        $firma->fkRecordStatus = 1;
        $firma->signature_b64 = $request->solicitud['firma'];
        $firma->save();

        $solicitud = Solicitud::find($id_solicitud);
        $solicitud->fkRecordStatus = 7;
        $solicitud->fkFirma = $firma->id;
        $solicitud->update();

        self::$response['data'] = [
            'solicitud' => $solicitud
        ];

        return self::$response;

    }

    public function solicitudes($estatus)
    {
        self::$response['data'] = [
            'solicitudes' => self::getSolicitudes($estatus),
            'user'        => self::$user
        ];

        return self::$response;
    }

    public function solicitudesUsusarios($id)
    {
        self::$response['data'] = [
            'solicitudes' => self::getSolicitudesUsuarios($id)
        ];

        return self::$response;
    }

    public function login(Request $request)
    {
        $credentials = $this->validate(request(),[
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($credentials)){

            self::$user = Auth::user();

            if(Auth::user()->fkRecordStatus == 1){

                $user = User::find(Auth::id());
                $user->email_verified_at = Carbon::now(); //Logged
                $user->remember_token = $request->usserId; //usserId_One_Signal
                $user->update();

                switch(Auth::user()->fkPerfil){
                    case 1: //Ninja - Administrador
                        self::$response['data'] = [
                            'user'        => self::getUser(Auth::id())
                        ];
                        break;
                    case 2: //Project Managment
                        self::$response['data'] = [
                            'solicitudes' => self::getSolicitudes('generadas'),
                            'user'        => self::getUser(Auth::id())
                        ];
                        break;
                    case 3: //Team Leader
                        self::$response['data'] = [
                            'solicitudes' => self::getSolicitudesUsuarios(Auth::id()),
                            'user'        => self::getUser(Auth::id())
                        ];
                        break;
                    case 4: //Tesorero
                        self::$response['data'] = [
                            'autorizadas' => self::getSolicitudes('autorizadas'),
                            'denegadas'   => self::getSolicitudes('denegadas'),
                            'entregadas'  => self::getSolicitudes('entregadas'),
                            'generadas'   => self::getSolicitudes('generadas'),
                            'user'        => self::getUser(Auth::id())
                        ];
                        break;
                    default:
                        self::$response['status'] = 'Fail';
                        self::$response['message'] = 'Estas credenciales no concuerdan con nuestros registros.';
                        self::$response['data'] = ['user'=> ['fkPerfil' => Auth::user()->fkPerfil]];
                }
            }
        } else {
            self::$response['status'] = 'Fail';
            self::$response['message'] = 'Estas credenciales no concuerdan con nuestros registros.';
            self::$response['data'] = ['user'=> ['fkPerfil' => 0]];
        }

        return self::$response;
    }

    public function logout($id)
    {
        $user = User::find($id);

        if($user){
            $user->email_verified_at = NULL; //Logged
            $user->remember_token = NULL; //usserId_One_Signal
            $user->update();

        } else {
            self::$response['status'] = 'Fail';
            self::$response['message'] = 'Usuario no encontrado.';
        }

        return self::$response;

    }

    public function isLoggedPMO()
    {
        $pmo = User::where('fkPerfil',2)->first();

        if($pmo->remember_token){
            self::$response['data'] = ['player_id' => $pmo->remember_token];
        } else {
            self::$response['status'] = 'Fail';
            self::$response['message'] = 'PMO no logueado.';
        }

        return self::$response;
    }
}
