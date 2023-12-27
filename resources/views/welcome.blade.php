@extends('layouts.main')

@section('title', 'Home')

@section('content')
<nav class="containerBody">
    <h1>Vagas</h1>

        @if(isset($vagas) && count($vagas) > 0)
            <div class="containerVagas">
            @foreach($vagas as $vaga)
                <div class="cardVaga">
                    @if($vaga->ocupada == 0)
                        <img src="/img/livre.png" alt="">
                        <h3>Vaga {{ $vaga->id }}</h3>
                        <a href="{{ route('vagas.estacionar', ['id' => $vaga->id]) }}" >Estacionar</a>
                    @else
                        <img src="/img/ocupado.png" alt="">
                        <h3>Vaga {{ $vaga->id }}</h3>
                        <a href="{{ route('vagas.show', ['id' => $vaga->id]) }}">Ver Mais</a>
                    @endif
                </div>
            @endforeach
            </div>
        @else
            <p>Não há vagas cadastradas.</p>
        @endif
</nav>

@endsection
