@extends('layouts.app')

@section('content')
    @include('partials.navDash')

    <div class="containerDash">
        <h2>Bem-vindo(a), {{ $username }}!</h2>

        @if ($agendamentos->isEmpty())
            <p>Você ainda não possui agendamentos.</p>
        @else
            <p>
                <a href="/dashboard/meus-agendamentos">
                    Você possui {{ $agendamentos->count() }} {{ Str::plural('agendamento', $agendamentos->count()) }}.
                </a>
            </p>
        @endif

        <p>
            <a href="/dashboard/novo-agendamento">
                {{ $agendamentos->isEmpty() ? 'Faça um agendamento agora' : 'Fazer um novo agendamento' }}
            </a>
        </p>
    </div>
@endsection
