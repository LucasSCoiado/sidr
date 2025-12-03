<x-layout.layout title="Remedio">
    <div class="d-flex mb-3">
        <p class="display-6 mb-0">{{ $remedios->nome }}</p>
        <a href="{{ route('remedios.home') }}" class="btn btn-primary ms-auto">Retornar</a>
    </div>
    <hr>
    <div class="card p-4 border rounded shadow-sm bg-light">
        <div class="row">
            <div class="col">
                <h4>Nome: {{ $remedios->nome }}</h4>
                <p>Comprimidos por caixa: {{ $remedios->quantidadeCaixa }}</p>
                <p>Quantidade por tomada: {{ $remedios->quantidadeTomada }}</p>
                <p>Frequência (vezes por dia): {{ $remedios->frequencia }}</p>
                <p>Consumo diário estimado: {{ $dailyConsumption ?? ($remedios->quantidadeTomada * $remedios->frequencia) }} comprimidos por dia</p>
                <p>Comprimidos restantes: {{ $remedios->qtdRestante }}</p>
                <p>Miligramas: {{ $remedios->miligramas }} mg</p>
                <p>Dose por consumo: {{ $remedios->dose }} mg</p>
                <p>Frequencia: {{ $remedios->frequencia }} vezes ao dia</p>
                <p>Caixas: {{ $remedios->caixas }} caixas</p>
            </div>
            <div class="col">
                <p><strong>Tempo de duração do medicamento</strong></p>
                <p>{{ $tempoDuracao }} dias</p>
                @if($sobra != 0)
                    <p><strong>Comprimidos restantes após o ultimo dia de consumo completo</strong></p>
                    <p>{{ $sobra }}</p>
                @endif
            </div>
            @if ($remedios->caixas == 0 && $remedios->qtdRestante == 0)
                <div class="col text-end">
                    <span class="badge bg-danger p-3 fs-5">Sem estoque</span>
                </div>
            @endif
        </div>
</x-layout.layout>