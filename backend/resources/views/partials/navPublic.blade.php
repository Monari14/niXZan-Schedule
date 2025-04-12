@extends('layouts.app')

@section('nav')
<header>
<link rel="stylesheet" href="{{ asset(path: 'css/nav.css') }}">

  <nav class="navbar">
    <a class="navbar-brand" href="/">niXZan</a>
    <div class="menu-toggle" onclick="document.querySelector('.nav-links').classList.toggle('show')">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="nav-links">
      <a href="/signin">Login</a>
      <a href="/signup">Cadastre-se</a>
    </div>
  </nav>
</header>
@endsection
