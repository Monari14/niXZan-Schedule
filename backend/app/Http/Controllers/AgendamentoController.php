<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AgendamentoController extends Controller
{
    public function novo_agendamento(Request $request)
    {
        // Verifica se o usuário está logado
        if (!session('user_id')) {
            return redirect()->route('signin');
        }

        if ($request->isMethod('post')) {


            $rules = [
                'data'     => 'required|date',
                'hora'     => 'required',
                'quadra'   => 'required',
            ];


            $messages = [
                'data.required' => 'É necessário selecionar uma data',
                'data.date' => 'Data inválida',

                'hora.required' => 'É necessário selecionar uma hora',

                'quadra.required' => 'É necessário selecionar uma quadra',
            ];

            $validator = \Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            try {
                // Insere o novo agendamento no banco de dados
                DB::table('agendamentos')->insert([
                    'user_id'  => session('user_id'),
                    'data'     => $request->input('data'),
                    'hora'     => $request->input('hora'),
                    'quadra'   => $request->input('quadra'),
                ]);

                // Redireciona para o dashboard com mensagem de sucesso
                return redirect()->route('dashboard')->with('sucesso', 'Agendamento realizado com sucesso!');
            } catch (\Exception $e) {
                // Redireciona de volta com mensagem de erro
                return redirect()->back()->with('error', 'Erro ao realizar o agendamento. Tente novamente.');
            }
        }

        // Retorna a view de novo agendamento
        return view('dashboard.novo_agendamento');
    }
    public function getAgendamentos($data, $quadra)
    {
        // Filtra os agendamentos pela data e quadra
        $agendamentos = Agendamento::
            whereDate('data', $data)
            ->where('quadra', $quadra)
            ->pluck('hora')
            ->toArray();

        return response()->json($agendamentos);
    }
    public function getQuadrasIndisponiveis($data, $hora)
    {
        // Log os valores recebidos
        \Log::info("Data recebida: $data, Hora recebida: $hora");

        // Consulta ao banco de dados
        $quadrasIndisponiveis = Agendamento::where('data', $data) // Usa o formato 'DD-MM-YYYY' diretamente
            ->where('hora', $hora)
            ->pluck('quadra')
            ->toArray();

        // Log o resultado da consulta
        \Log::info("Quadras indisponíveis: " . json_encode($quadrasIndisponiveis));

        return response()->json($quadrasIndisponiveis);
    }
    public function meus_agendamentos()
    {
        // Verifica se o usuário está logado
        if (!session('user_id')) {
            return redirect()->route('signin');
        }

        // Busca os agendamentos do usuário
        $agendamentos = DB::table('agendamentos')
            ->where('user_id', session('user_id'))
            ->get();

        // Verifica se existem agendamentos
        if ($agendamentos->isEmpty()) {
            return view('dashboard.meus_agendamentos', [
                'error' => 'Você não possui agendamentos.'
            ]);
        }

        // Retorna a view com os agendamentos
        return view('dashboard.meus_agendamentos', [
            'agendamentos' => $agendamentos
        ]);
    }

    public function delete_agendamentos($id)
    {
        // Verifica se o usuário está logado
        if (!session('user_id')) {
            return redirect()->route('signin');
        }
        $agendamento = Agendamento::findOrFail($id);

        if ($agendamento->user_id !== session('user_id')) {
            abort(403);
        }

        $agendamento->delete();

        $agendamentos = DB::table('agendamentos')
            ->where('user_id', session('user_id'))
            ->get();

        return view('dashboard.meus_agendamentos', [
            'agendamentos' => $agendamentos
        ]);
    }

    public function admin_delete_agendamentos($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();

        // pegar todos os agendamentos em ordem do mais recente para o mais antigo
        $agendamentos = DB::table('agendamentos')
        ->join('users', 'agendamentos.user_id', '=', 'users.id')
        ->select('agendamentos.*', 'users.username')
        ->orderBy('agendamentos.data', 'desc')
        ->get();

        return view('admin.agendamentos', [
            'agendamentos' => $agendamentos,
        ])->with('success', 'Agendamento excluído com sucesso!');
    }
}
