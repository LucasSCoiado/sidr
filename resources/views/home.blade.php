<x-layout.layout title="Menu">
    <div class="d-flex mb-3">
        <h3>Menu</h4>
        <p class="ms-auto fw-bolder"><i class="fa-solid fa-pills"></i> Drougs Control System</p>
    </div>
    <hr>
    <div class="w-100 p-4">
        <h4 class="float-end">Medicamentos</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Comprimidos na Caixa</th>
                    <th>Miligramas</th>
                    <th>Caixas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($remedios as $remedio)
                <tr>
                    <td>{{ $remedio->nome }}</td>
                    <td>{{ $remedio->quantidadeCaixa }}</td>
                    <td>{{ $remedio->miligramas }}</td>
                    <td>{{ $remedio->caixas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout.layout>