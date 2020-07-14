<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserStoreRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('users.fkRecordStatus','ASC')
                     ->join('perfiles','perfiles.pkPerfil','users.fkPerfil')
                     ->join('record_status','record_status.pkRecordStatus','users.fkRecordStatus')
                     ->paginate(5);
        return view('index',compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request)
    {
        $user = new User();

        $user->name             = $request->name;
        $user->paterno          = $request->paterno;
        $user->materno          = ($request->materno == '') ? '' : $request->materno;
        $user->email            = $request->email;
        $user->picture_path     = $request->picture_path;
        $user->fkPerfil         = $request->fkPerfil;
        $user->fkRecordStatus   = $request->pkRecordStatus;
        $user->password = Hash::make($request->pass_word);
        $user->save();

        if($request->file('picture_path')){
            $path = Storage::disk('public')->put('image',$request->file('picture_path'));
            $user->fill(['picture_path'=>asset($path)])->save();
        }

        return redirect()->route('users.index')
            ->with('info','El usuario fue dado de alta correctamente');
    }

    public function show($id)
    {
        $user = User::join('perfiles','perfiles.pkPerfil','users.fkPerfil')
              ->join('record_status','record_status.pkRecordStatus','users.fkRecordStatus')
              ->where('users.id',$id)
              ->get()[0];
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::join('perfiles','perfiles.pkPerfil','users.fkPerfil')
            ->join('record_status','record_status.pkRecordStatus','users.fkRecordStatus')
            ->where('users.id',$id)
            ->get()[0];
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        $user->name             = $request->name;
        $user->paterno          = $request->paterno;
        $user->materno          = ($request->materno == '') ? '' : $request->materno;
        $user->email            = $request->email;
        $user->picture_path     = $request->picture_path;
        $user->fkPerfil         = $request->fkPerfil;
        $user->fkRecordStatus   = $request->pkRecordStatus;
        if($request->pass_word != ''){
            $user->password = Hash::make($request->pass_word);
        }
        $user->save();

        if($request->file('picture_path')){
            $path = Storage::disk('public')->put('image',$request->file('picture_path'));
            $user->fill(['picture_path'=>asset($path)])->save();
        }

        return redirect()->route('users.index')
                         ->with('info','El usuario fue actualizado');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->fkRecordStatus = 3;
        $user->save();

        return back()->with('info','El usuario fue eliminado satisfactoriamente');
    }
}
