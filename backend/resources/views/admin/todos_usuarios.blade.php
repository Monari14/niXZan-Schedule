@extends('layouts.app')
@section('content')
<title>Usuários</title>
@include('partials.navDashAdm')

<div class="container mt-5">
    <div class="card mt-4">
        <div class="card-header">
            Todos Usuários
        </div>
        <div class="card-body">
            <table class="table table-bordered">
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
    </div>
</div>
@endsection
