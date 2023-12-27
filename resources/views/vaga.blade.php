@extends('layouts.main')

@section('title', 'Detalhes da Vaga')

@section('content')
    <p>Número da Vaga: {{ $vaga->id }}</p>
    @if($vaga->ocupada == 0)
        <p>Status: Disponível</p>
    @else
        <p>Status: Ocupada</p>
    @endif

    <p>Dono: {{ $dono ? $dono->name : 'N/A' }}</p>
    
    @if($vaga->horario_entrada)
        <p>Horário de Entrada: {{ \Carbon\Carbon::parse($vaga->horario_entrada)->format('H:i:s') }}</p>
    @else
        <p>Horário de Entrada: Ainda não entrou</p>
    @endif
    
    @if($vaga->horario_saida)
        <p>Horário de Saída: {{ \Carbon\Carbon::parse($vaga->horario_saida)->format('H:i:s') }}</p>
        @if($vaga->preco !== null || $vaga->preco !== '' || $vaga->preco !== undefined)
            <?php
                $entrada = \Carbon\Carbon::parse($vaga->horario_entrada);
                $saida = \Carbon\Carbon::parse($vaga->horario_saida);
                $tempoEstacionado = $saida->diff($entrada)->format('%H:%I:%S');
            ?>
            <p>Tempo estacionado: {{$tempoEstacionado}}</p>
            <p>Total a Pagar: R${{ number_format($vaga->preco, 2, ',', '.') }}</p>
            <a href="{{ route('vagas.confirm', ['dono' => $dono->id]) }}" class="confirm">Confirmar</a>
        @endif
    @else
        <p>Horário de Saída: Ainda não saiu</p>
        <a href="{{ route('vagas.exit', ['id' => $vaga->id]) }}" class="exit">Finalizar</a>
    @endif
@endsection
