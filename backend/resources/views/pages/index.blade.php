@extends('layouts.app')

@section('content')
@include('partials.navPublic')

<title>Agendamentos</title>

<div class="containerDash text-center">
    <h1 style="font-size: 2.5rem; color: #333;">Bem-vindo ao niXZan Agendamentos</h1>

    <p style="font-size: 1.2rem; color: #555;">Reserve horários de forma rápida e eficiente.</p>

    <div style="display: flex; justify-content: center; gap: 20px;">
        <a href="{{ route('signin') }}">
            <button style="background: linear-gradient(135deg, #007bff, #0056b3); color: white;">
                Login
            </button>
        </a>
        <a href="{{ route('signup') }}">
            <button style="background: linear-gradient(135deg, #17a2b8, #117a8b); color: white;">
                Cadastrar-se
            </button>
        </a>
    </div>
</div>

@endsection

@include('partials.footer')
