@extends('layouts.app')

@section('nav')
<header>
<link rel="stylesheet" href="{{ asset('css/nav.css') }}">

  <nav class="navbar">
    <a class="navbar-brand" href="/dashboard">niXZan - Admin</a>
    <div class="menu-toggle" onclick="document.querySelector('.nav-links').classList.toggle('show')">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="nav-links">
      <a href="/dashboard">Dashboard</a>
      <a href="/dashboard/usuarios">Usuários</a>
      <a href="/dashboard/agendamentos">Todos os agendamentos</a>
      <a href="/dashboard/novo-servico">Novo serviço</a>
      <a href="/dashboard/relatorios">Relatórios</a>
      <a href="/dashboard/configuracoes">Configurações</a>
      <a class="logout" href="/logout">Logout</a>
    </div>
  </nav>
</header>
@endsection
