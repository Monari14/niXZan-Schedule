@extends('layouts.app')

@include('partials.navPublic')
@section('content')
<title>Cadastre-se</title>
    <div class="container">
        <form action="{{ route('signup') }}" method="POST">
            @csrf
            <h1>Cadastre-se</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="text" name="username" id="username" placeholder="Nome de usuário" required> <br><br>
            <input type="text" name="email" id="email" placeholder="E-mail" required> <br><br>
            <input type="tel" name="telefone" id="telefone" placeholder="Telefone" required> <br><br>
            <input type="password" name="senha" placeholder="Senha" required> <br><br>
            <button type="reset">Resetar</button>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
@endsection
