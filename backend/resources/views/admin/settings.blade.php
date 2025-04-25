@extends('layouts.app')
@section('content')
<title>Informações</title>
@include('partials.navDashAdm')

<div class="container mt-5">
    <div class="card mt-4">
        <div class="card-header">
            Minhas informações
        </div>
        <div class="card-body">
            <p><strong>Nome de Usuário:</strong> {{ $username }}</p>
            <p><strong>ID:</strong> {{ $usuarios->id }}</p>
            <p><strong>Email:</strong> {{ $usuarios->email }}</p>
            <p><strong>Admin:</strong> {{ $usuarios->is_admin ? 'Sim' : 'Não' }}</p>
        </div>
    </div>
</div>
@endsection
