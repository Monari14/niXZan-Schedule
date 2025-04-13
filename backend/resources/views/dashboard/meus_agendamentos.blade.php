@extends('layouts.app')

@section('content')
    @include('partials.navDash')

    <div class="containerDash">
        @if (isset($error))
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            <a class="btn btn-primary mt-3" href="/dashboard/novo-agendamento">Faça um agendamento agora</a>
        @else
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Meus Agendamentos</h1>
                <a class="btn btn-success" href="/dashboard/novo-agendamento">Novo Agendamento</a>
            </div>

            @if ($agendamentos->isEmpty())
                <p>Você ainda não tem agendamentos.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>Quadra</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agendamentos as $agendamento)
                            <tr>
                                <td>{{ $agendamento->data }}</td>
                                <td>{{ $agendamento->hora }}</td>
                                <td>{{ $agendamento->quadra }}</td>
                                <td>
                                    <form style="background: transparent; box-shadow: 0 4px 10px transparent;" action="{{ route('delete_agendamentos', ['id' => $agendamento->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endif
    </div>
@endsection
