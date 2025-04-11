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
                'senha'         => 'required',
            ]);

            $emailUser = $request->input('emailUser');
            $senha         = $request->input('senha');

            if (filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
                $user = DB::table('users')->where('email', $emailUser)->first();
            } else {
                $user = DB::table('users')->where('username', $emailUser)->first();
            }

            if ($user && Hash::check($senha, $user->senha)) {
                Session::put('user_id', $user->id);
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('signin')->withErrors(['signin' => 'E-mail ou senha incorretos!']);
            }
        }

        return view('pages.signin');
    }

    public function signup(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|unique:users,username',
                'email'    => 'required|email|unique:users,email',
                'telefone' => 'required',
                'senha'    => 'required|min:6',
            ]);

            DB::table('users')->insert([
                'username' => $request->input('username'),
                'email'    => $request->input('email'),
                'telefone' => $request->input('telefone'),
                'senha'    => Hash::make($request->input('senha')),
            ]);

            $username = $request->input('username');
            $user = User::where('username', $username)->first(); // Busca o usuário

            if (!$user) {
                return redirect()->back()->with('error', 'Usuário não encontrado');
            }

            Session::put('user_id', $user->id);

            $agendamentos = DB::table('agendamentos')
            ->where('user_id', session('user_id'))
            ->get();


            $usernome = "@$username";
            // Return the view with the user, username, and appointments
            // Retorna a view com o usuário, nome de usuário e agendamentos

            return redirect()->route('dashboard')->with([
                'user' => $user,
                'username' => $usernome,
                'agendamentos' => $agendamentos,
            ]);


        }

        return view('pages.signup');
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('logout');
    }
}
