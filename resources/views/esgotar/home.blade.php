<x-layout.layout title="Esgotando">
    <div class="d-flex mb-3">
        <p class="display-6 mb-0">Remédios proximos de esgotar</p>
        <a href="{{ route('home') }}" class="btn btn-primary ms-auto">Menu</a>
    </div>
    <hr>
    <div class="d-flex mb-3">
        <div class="w-100 p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Comprimidos por Caixa</th>
                        <th>Comprimidos restantes</th>
                        <th>Miligramas</th>
                        <th>Caixas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($remedios as $remedio)
                        @if($remedio->qtdRestante > $remedio->qtdRestante/2 && $remedio->caixas ===0)
                            <tr>
                                <td>{{ $remedio->nome }}</td>
                                <td>{{ $remedio->quantidadeCaixa }}</td>
                                <td>{{ $remedio->qtdRestante }}</td>
                                <td>{{ $remedio->miligramas }}</td>
                                <td>{{ $remedio->caixas }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <p class="display-6 mb-0">Remédios esgotados</p>
    <hr>
    <div class="d-flex mb-3">
        <div class="w-100 p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Comprimidos por Caixa</th>
                        <th>Comprimidos restantes</th>
                        <th>Miligramas</th>
                        <th>Caixas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($remedios as $remedio)
                        @if($remedio->qtdRestante === 0 && $remedio->caixas ===0)
                            <tr>
                                <td>{{ $remedio->nome }}</td>
                                <td>{{ $remedio->quantidadeCaixa }}</td>
                                <td>{{ $remedio->qtdRestante }}</td>
                                <td>{{ $remedio->miligramas }}</td>
                                <td>{{ $remedio->caixas }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-layout.layout>