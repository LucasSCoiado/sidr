<x-layout.layout title="Excluir remédio">
    <div class="p-4">
        <h3>Remoção de remédio</h3>
        <hr>
        <div class="w-75">
            <p class="p-2">Tem certeza que deseja remover este remédio?</p>
            <div class="text-center">
                <h3 class="my-5">{{ $remedios->nome }}</h3>
                <a href="{{ route('remedios.home') }}" class="btn btn-danger">Não</a>
                <a href="{{ route('remedios.destroy', ['id'=>$remedios->id]) }}" class="btn btn-success">Sim</a>
            </div>
        </div>
    </div>
</x-layout.layout>