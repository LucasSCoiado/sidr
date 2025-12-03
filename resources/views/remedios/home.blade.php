<x-layout.layout title="Remédios">
    <div class="d-flex mb-3">
        <p class="display-6 mb-0">Medicamentos</p>
        <a href="{{ route('remedios.create')  }}" class="btn btn-primary ms-auto">Novo remedio</a>
        <a href="{{ route('home')  }}" class="btn btn-primary ms-2">Menu</a>
    </div>
    <hr>
    <ul>
        @foreach ($remedios as $remedio)
            @include('remedios.tabela_remedios', ['remedio'=>$remedio])
        @endforeach
    </ul>
</x-layout.layout>
