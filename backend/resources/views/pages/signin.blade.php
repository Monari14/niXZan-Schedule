@extends('layouts.app')

@include('partials.navPublic')
@section('content')
<title>Login</title>
    <div class="container">
        <form action="{{ route('signin') }}" method="POST">
            @csrf
            <h1>Login</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="text" name="emailUser" id="emailUser" placeholder="Nome de usuário ou E-mail" required> <br><br>
            <input type="password" name="senha" placeholder="Senha" required> <br><br>
            <button type="reset">Reset</button>
            <button type="submit">Entrar</button>
        </form>
    </div>
@endsection

