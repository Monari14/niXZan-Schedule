@extends('layouts.app')
@section('content')
<title>Agendamentos</title>
@include('partials.navDashAdm')

<div class="container mt-5">
    <div class="card mt-4">
        <div class="card-header">
            Todos Agendamentos
        </div>
        <div class="card-body">
            <table class="table table-bordered">
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
