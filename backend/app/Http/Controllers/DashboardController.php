<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Check if the user is logged
        // Verifica se o usuário está logado
        if (!session('user_id')) {
            return redirect()->route('signin');
        }

        // Search for the user in the database
        // Busca o usuário no banco de dados
        $user = DB::table('users')->where('id', session('user_id'))->first();
        // Get the username || Pega o nome de usuário
        $username = $user->username ?? 'Usuário';

        // Check if the user exists
        // Verifica se o usuário existe
        if (!$user) {
            return redirect()->route('signin');
        }

        // Fetch the user's appointments
        // Busca os agendamentos do usuário
        $agendamentos = DB::table('agendamentos')
            ->where('user_id', session('user_id'))
            ->get();

        $usernome = "@$username";

        if ($user->is_admin) {
            return view('admin.dashboard')->with([
                'user' => $user,
                'username' => $usernome,
            ]);
        } else {
            return view('dashboard.dash', [
                'user' => $user,
                'username' => $usernome,
                'agendamentos' => $agendamentos,
            ]);
        }
    }

    public function mySettings()
    {
        // Check if the user is logged
        // Verifica se o usuário está logado
        if (!session('user_id')) {
            return redirect()->route('signin');
        }

        // Search for the user in the database
        // Busca o usuário no banco de dados
        $user = DB::table('users')->where('id', session('user_id'))->first();
        // Get the username || Pega o nome de usuário
        $username = $user->username ?? 'Usuário';

        // Check if the user exists
        // Verifica se o usuário existe
        if (!$user) {
            return redirect()->route('signin');
        }

        $usernome = "@$username";

        if ($user->is_admin) {
            return view('admin.settings')->with([
                'usuarios' => $user,
                'username' => $usernome,
            ]);
        } else {
            return redirect()->route('dashboard');
        }
    }
    public function todosAgendamentos()
    {
        // Check if the user is logged
        // Verifica se o usuário está logado
        if (!session('user_id')) {
            return redirect()->route('signin');
        }

        // Search for the user in the database
        // Busca o usuário no banco de dados
        $user = DB::table('users')->where('id', session('user_id'))->first();
        // Get the username || Pega o nome de usuário
        $username = $user->username ?? 'Usuário';

        // Check if the user exists
        // Verifica se o usuário existe
        if (!$user) {
            return redirect()->route('signin');
        }

        $usernome = "@$username";


        if ($user->is_admin) {
            // pegar todos os agendamentos em ordem do mais recente para o mais antigo
            $agendamentos = DB::table('agendamentos')
            ->join('users', 'agendamentos.user_id', '=', 'users.id')
            ->select('agendamentos.*', 'users.username')
            ->orderBy('agendamentos.data', 'desc')
            ->get();
            return view('admin.agendamentos')->with([
                'user' => $user,
                'username' => $usernome,
                'agendamentos' => $agendamentos,
            ]);
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function todosUsuarios()
    {
        // Check if the user is logged
        // Verifica se o usuário está logado
        if (!session('user_id')) {
            return redirect()->route('signin');
        }

        // Search for the user in the database
        // Busca o usuário no banco de dados
        $user = DB::table('users')->where('id', session('user_id'))->first();
        // Get the username || Pega o nome de usuário
        $username = $user->username ?? 'Usuário';

        // Check if the user exists
        // Verifica se o usuário existe
        if (!$user) {
            return redirect()->route('signin');
        }

        $usernome = "@$username";

        if ($user->is_admin) {
            $usuarios = DB::table('users')->get();

            return view('admin.todos_usuarios')->with([
                'user' => $user,
                'username' => $usernome,
                'usuarios' => $usuarios,
            ]);
        } else {
            return redirect()->route('dashboard');
        }
    }
}
