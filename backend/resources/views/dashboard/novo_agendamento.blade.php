@extends('layouts.app')

@section('content')
    @include('partials.navDash')

    <!-- CSS do Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Scripts do Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script> <!-- Tradução PT -->
    <div class="container">
        @if(isset($error))
            <div class="alert alert-danger" style="align-self: center; max-width: 500px;">
                {{ $error }}
            </div>
        @endif
        @if(isset($sucesso))
            <div class="alert alert-sucess" style="align-self: center; max-width: 500px;">
                {{ $sucesso }}
            </div>
        @endif
        <form id="agendamentoForm" action="{{ route('dashboard/novo-agendamento') }}" method="POST">
            @csrf
            <h2>Novo Agendamento</h2>


            <!-- Etapa 1: Data -->
            <div class="step" id="step1" style="display: none;">
                <label for="data">Data:</label>
                <div style="display: flex; align-items: center;">
                    <input type="text" name="data" id="data" placeholder="Selecione a data" required >
                    <button type="button" id="calendarButton" style="display:none;"></button>
                    <span id="selectedDate" style="display:none;">Selecione uma data</span>
                </div>
                    <button type="button" class="nextButton">Prosseguir</button>
            </div>

            <!-- Etapa 2: Horário -->
            <div class="step" id="step2" style="display: none;">
                <label for="hora">Horário:</label>
                <select name="hora" id="hora" required>
                    <option value="" disabled selected>Selecione a hora</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                    <option value="21:00">21:00</option>
                    <option value="22:00">22:00</option>
                </select>
                <button type="button" class="prevButton">Voltar</button>
                <button type="button" class="nextButton">Prosseguir</button>
            </div>

            <!-- Etapa 3: Quadra -->
            <div class="step" id="step3" style="display: none;">
                <label for="quadra">Quadra:</label>
                <select name="quadra" id="quadra" required>
                    <option value="" disabled selected>Selecione a quadra</option>
                    <option value="Quadra 1">Quadra 1</option>
                    <option value="Quadra 2">Quadra 2</option>
                    <option value="Quadra 3">Quadra 3</option>
                    <option value="Quadra 4">Quadra 4</option>
                </select>
                <button type="button" class="prevButton">Voltar</button>
                <button type="button" class="nextButton">Prosseguir</button>
            </div>

            <!-- Etapa 4: Confirmação -->
            <div class="step" id="step4" style="display: none;">
                <h4>Confirmação:</h4>
                <p><strong>Data:</strong> <span id="confirmData"></span></p>
                <p><strong>Horário:</strong> <span id="confirmHora"></span></p>
                <p><strong>Quadra:</strong> <span id="confirmQuadra"></span></p>
                <button type="button" class="prevButton">Voltar</button>
                <button type="submit">Confirmar</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
