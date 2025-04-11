@extends('layouts.app')

@include('partials.navPublic')
@section('content')
<title>Sign Up</title>
    <div class="container">
        <form action="{{ route('signup') }}" method="POST">
            @csrf
            <h1>Sign Up</h1>
            <input type="text" name="username" id="username" placeholder="Nome de usuário" required> <br><br>
            <input type="text" name="email" id="email" placeholder="E-mail" required> <br><br>
            <input type="tel" name="telefone" id="telefone" placeholder="Telefone" required> <br><br>
            <input type="password" name="senha" placeholder="Senha" required> <br><br>
            <button type="submit">Cadastrar</button>
            <button type="reset">Resetar</button>
        </form>
    </div>
@endsection
