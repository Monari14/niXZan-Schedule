@extends('layouts.app')

@section('nav')
<header>
<link rel="stylesheet" href="{{ asset(path: 'css/nav.css') }}">

  <nav class="navbar">
    <a class="navbar-brand" href="/dashboard">niXZan</a>
    <div class="menu-toggle" onclick="document.querySelector('.nav-links').classList.toggle('show')">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="nav-links">
      <a href="/dashboard">Dashboard</a>
      <a href="/dashboard/novo-agendamento">Novo agendamento</a>
      <a href="/dashboard/meus-agendamentos">Meus agendamentos</a>
      <a class="logout" href="/logout">Logout</a>
    </div>
  </nav>
</header>
@endsection

