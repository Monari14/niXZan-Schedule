<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class AuthController extends Controller
{
    public function signin(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'emailUser' => 'required',
                'senha' => 'required',
            ]);

            $emailUser = $request->input('emailUser');
            $senha = $request->input('senha');
            $userOrEmail = "";
            if (filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
                $user = DB::table('users')->where('email', $emailUser)->first();
                $userOrEmail = "email";
            } else {
                $user = DB::table('users')->where('username', $emailUser)->first();
                $userOrEmail = "username";
            }

            if ($user && Hash::check($senha, $user->senha)) {
                Session::put('user_id', $user->id);
                return redirect()->route('dashboard');
            } else {
                if($userOrEmail == "email") {
                    return redirect()->route('signin')->withErrors(['signin' => 'E-mail ou senha incorretos!']);
                } else {
                    return redirect()->route('signin')->withErrors(['signin' => 'Nome de usuário ou senha incorretos!']);
                }
            }
        }
        return view('pages.signin');
    }

    public function signup(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'username' => 'required|unique:users,username|max:64|regex:/^\S*$/',
                'email' => 'required|email|unique:users,email|max:128',
                'telefone' => 'required|max:19',
                'senha' => 'required|min:6|max:64',
            ];

            $messages = [
                'username.required' => 'Nome de usuário é obrigatório',
                'username.unique' => 'Nome de usuário já existe',
                'username.max' => 'Nome de usuário não pode passar de 64 caracteres',
                'username.regex' => 'Nome de usuário não pode conter espaços',

                'email.required' => 'E-mail é obrigatório',
                'email.email' => 'E-mail inválido',
                'email.unique' => 'E-mail já está em uso',
                'email.max' => 'E-mail não pode passar de 128 caracteres',

                'telefone.required' => 'Telefone é obrigatório',
                'telefone.max' => 'Telefone não pode passar de 19 caracteres',

                'senha.required' => 'Senha é obrigatória',
                'senha.min' => 'Senha deve ter no mínimo 6 caracteres',
                'senha.max' => 'Senha não pode passar de 64 caracteres',
            ];

            $validator = \Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $primeiroUsuario = DB::table('users')->count() === 0;

            DB::table('users')->insert([
                'username' => $request->input('username'),
                'email'    => $request->input('email'),
                'telefone' => $request->input('telefone'),
                'senha'    => Hash::make($request->input('senha')),
                'is_admin' => $primeiroUsuario ? 1 : 0,
            ]);

            $username = $request->input('username');
            $user = User::where('username', $username)->first();

            if (!$user) {
                return redirect()->back()->with('error', 'Usuário não encontrado');
            }

            Session::put('user_id', $user->id);

            $agendamentos = DB::table('agendamentos')
                ->where('user_id', session('user_id'))
                ->get();

            if ($user->is_admin) {
                return view('admin.dashboard')->with([
                    'user' => $user,
                    'username' => "@$username",
                ]);
            } else {
                return redirect()->route('dashboard')->with([
                    'user' => $user,
                    'username' => "@$username",
                    'agendamentos' => $agendamentos,
                ]);
            }
        }
        return view('pages.signup');
    }

    public function admin_update(Request $request, $id)
    {
        $request->validate([
            'admin' => 'required|boolean',
        ]);

        DB::table('users')
            ->where('id', $id)
            ->update(['is_admin' => $request->input('admin')]);

        return redirect()->route('todos_usuarios')->with('success', 'Permissão de administrador atualizada com sucesso!');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('logout');
    }
}
