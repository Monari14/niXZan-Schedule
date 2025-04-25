@extends('layouts.app')
@section('content')
<title>Usuários</title>
@include('partials.navDashAdm')

<div class="containerDash">
    <table class="table table-striped">
    <h1>Todos agendamentos</h1>
        <thead>
            <tr>
                <th style="display: none;">ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td style="display: none;">{{ $usuario->id }}</td>
                    <td>{{ $usuario->username }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->telefone }}</td>
                    <td>{{ $usuario->is_admin == 1 ? 'Sim' : 'Não' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
