@extends('layouts.app')

@section('content')
    @include('partials.navDash')

    <div class="containerDash">
        <h2>Bem-vindo(a) Administrador, {{ $username }}!</h2>
    </div>
@endsection
