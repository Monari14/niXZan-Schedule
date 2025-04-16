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
    public function todosAgendamentos()
    {
// Check if the user is logged
        // Verifica se o usuário está logado
        if (!session('user_id')) {
            return redirect()->route('signin');
        }

        // Search for the user in the database
        // Busca o usuário no banco de dados
        $userLogado = DB::table('users')->where('id', session('user_id'))->first();
        $agendamento = DB::table('agendamentos')->first();

        // Get the username || Pega o nome de usuário
        $username = $user->username ?? 'Usuário';

        // Check if the user exists
        // Verifica se o usuário existe
        if (!$userLogado) {
            return redirect()->route('signin');
        }

        // Fetch the user's appointments
        // Busca os agendamentos do usuário
        $agendamentos = DB::table('agendamentos')
            ->where('user_id', session('user_id'))
            ->get();

        $userAgendamento = DB::table('agendamentos')
            ->where('user_id', session('user_id'))
            ->get();
        $usernome = "@$userAgendamento";

        if ($userLogado->is_admin) {
            return view('admin.todos_agendamentos')->with([
                'user' => $userLogado,
                'username' => $usernome,
                'agendamentos' => $agendamento,
            ]);
        } else {
            return view('dashboard.dash', [
                'user' => $userLogado,
                'username' => $usernome,
                'agendamentos' => $agendamentos,
            ]);
        }
    }
}
