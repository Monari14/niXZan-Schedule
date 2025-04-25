@extends('layouts.app')

@section('content')
<title>Agendamentos</title>
@include('partials.navDashAdm')
<div class="containerDash">
    <table class="table table-striped">
    <h1>Todos agendamentos</h1>
        <thead>
            <tr>
                <th style="display: none;">ID</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Usuário</th>
                <th>Quadra</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendamentos as $agendamento)
                <tr>
                    <td style="display: none;">{{ $agendamento->id }}</td>
                    <td>{{ $agendamento->data }}</td>
                    <td>{{ $agendamento->hora }}</td>
                    <td>{{ $agendamento->username }}</td>
                    <td>{{ $agendamento->quadra }}</td>
                    <td>
                    <form style="background: transparent; box-shadow: 0 4px 10px transparent;" action="{{ route('deletar_agendamentos', ['id' => $agendamento->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
