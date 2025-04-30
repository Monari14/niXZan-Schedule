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
                    <td>
                        <form action="{{ route('admin_update', $usuario->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $usuario->id }}">
                            <select name="admin" id="admin">
                                <option value="0" {{ $usuario->is_admin == 0 ? 'selected' : '' }}>Não</option>
                                <option value="1" {{ $usuario->is_admin == 1 ? 'selected' : '' }}>Sim</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
