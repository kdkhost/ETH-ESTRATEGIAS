<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest; 
use App\Http\Requests\UserEditRequest; 
use App\Models\Role;
use App\Models\Photo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);

        

        return view('users.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::select('select * from roles');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        if(trim($request->password) == '') {
            $input = $request->except('password'); //pass everything excerpt the pass field
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if ($file = $request->file('photo_id')) {
            
            $name = time() . $file->getClientOriginalName();

            $file->move('images/media/', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }


        User::create($input);

        return redirect('/admin/users/create')->with('user_success','User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = DB::select('select * from roles');
        return view('users.edit', compact('user', 'roles'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        if(trim($request->password) == '') {
            $input = $request->except('password'); //pass everything excerpt the pass field
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
     
        if ($file = $request->file('photo_id')) {
            
            $name = time() . $file->getClientOriginalName();

            $file->move('images/media/', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user->update($input);

        return back()->with('user_success','User updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id == auth()->id()){
             return back()->with('user_error', 'Você não pode excluir sua própria conta!');
        }
        $user->delete();
        return back()->with('user_success', 'Usuário excluído com sucesso!');
    }

    public function delete_users(Request $request) {
        if(isset($request->delete_all) && !empty($request->checkbox_array)) {
            $users = User::findOrFail($request->checkbox_array);
            $deletedCount = 0;
            foreach ($users as $user) {
                if($user->id != auth()->id()){
                    $user->delete();
                    $deletedCount++;
                }
            }
            if ($deletedCount < count($request->checkbox_array)) {
                return back()->with('user_success', 'Usuários excluídos. O usuário atual não pôde ser excluído.');
            }
            return back()->with('user_success','Usuários excluídos com sucesso!');
        } else {
            return back();
        }
    }

    /**
     * Iniciar sessão supervisionada como outro usuário.
     */
    public function impersonate(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->with('user_error', 'Você não pode supervisionar sua própria conta.');
        }

        // Armazena o ID original do admin na sessão
        session(['impersonator_id' => auth()->id()]);
        
        // Loga como o usuário alvo
        Auth::loginUsingId($user->id);

        return redirect()->route('dashboard.index')->with('user_success', 'Acesso supervisionado iniciado. Você está acessando como ' . $user->name . '.');
    }

    /**
     * Encerrar sessão supervisionada e retornar ao admin original.
     */
    public function leave_impersonation()
    {
        if (session()->has('impersonator_id')) {
            $adminId = session('impersonator_id');
            session()->forget('impersonator_id');
            
            // Retorna ao login do admin original
            Auth::loginUsingId($adminId);
            
            return redirect()->route('users.index')->with('user_success', 'Acesso supervisionado encerrado. Você retornou à sua conta original.');
        }

        return redirect()->route('dashboard.index');
    }
}
