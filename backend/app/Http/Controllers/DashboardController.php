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

    public function dash()
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
        // Return the view with the user, username, and appointments
        // Retorna a view com o usuário, nome de usuário e agendamentos
        return view('dashboard.dash', [
            'user' => $user,
            'username' => $usernome,
            'agendamentos' => $agendamentos,
        ]);
    }

}
