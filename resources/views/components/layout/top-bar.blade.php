<div class="d-flex justify-content-between py-4 px-3 bg-black text-white">
    <div class="d-flex align-items-center">
    <a href="{{ route('home') }}" class="text-white text-decoration-none d-flex align-items-center">
            <img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid me-3" style="height: 30px;">
            <h4 class="mb-0">{{ config('app.name') }}</h4>
        </a>
    </div>
    <div class="d-flex align-items-center">
        <a href="{{ route('home') }}" class=" me-2 text-decoration-none btn btn-outline-secondary">
            Menu
        </a>
        <a href="{{ route('remedios.home') }}" class=" me-2 text-decoration-none btn btn-outline-secondary">
            Remédios
        </a>
        <a href="{{ route('lista.index') }}" class=" me-2 text-decoration-none btn btn-outline-secondary">
            Lista do dia
        </a>
        <a href="{{ route('remedios.fimDeEstoque') }}" class=" me-2 text-decoration-none btn btn-outline-secondary">
            Próximos a esgotar 
        </a>
    </div>
</div>