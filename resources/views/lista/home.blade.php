<x-layout.layout title="Lista de medicamentos diarios">
    <div class="d-flex mb-3">
        <p class="display-6 mb-0">Lista de medicamentos diarios</p>
        <a href="{{ route('home') }}" class="btn btn-primary ms-auto">Menu</a>
    </div>
    <hr>
    <div class="d-flex mb-3">
        <div class="w-100 p-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Dose</th>
                        <th>Miligramas</th>
                        <th>Frequencia</th>
                        <th>Intervalo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($remedios as $remedio)
                        <tr>
                            <td>{{ $remedio->nome }}</td>
                            <td>{{ $remedio->dose }}</td>
                            <td>{{ $remedio->miligramas }}</td>
                            <td>{{ $remedio->frequencia }}</td>
                            <td>{{ $remedio->intervaloHoras }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout.layout>