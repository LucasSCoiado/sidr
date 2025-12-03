<div class="row mb-2">
    <div class="col">
        <div class="card p-4 border rounded-pill shadow-sm bg-light">
            <div class="row">
                <div class="col">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-pills"></i><h4 class="mb-0"><a href="{{ route('remedios.medicamento', ['id' => $remedio->id]) }}" class="text-decoration-none text-secondary">{{ $remedio->nome }}</a></h4>
                        @if($remedio->caixas == 0 && $remedio->qtdRestante == 0)
                            <span class="badge bg-danger">Sem estoque</span>
                        @elseif($remedio->caixas == 1)
                            <span class="badge bg-success">Última caixa</span>
                        @elseif($remedio->caixas == 0 && $remedio->qtdRestante >0)
                            <span class="badge bg-warning text-dark">Sem caixas, apenas unidades restantes</span>
                        @endif
                        @if($remedio->qtdRestante < $remedio->quantidadeCaixa/2 && $remedio->caixas == 1)
                            <span class="badge bg-warning text-dark">Restam poucas unidades</span>
                        @endif    
                    </div>
                    <small>{{ $remedio->miligramas }} mg</small>
                </div>
                <div class="col text-end">
                    <a href="{{ route('remedios.update', ['id'=>$remedio->id]) }}" class="btn btn-outline-secondary btn-primary  rounded-circle"><i class="fa-regular fa-pen-to-square"></i></a>
                    <a href="{{ route('remedios.delete', ['id'=> $remedio->id]) }}" class="btn btn-outline-secondary btn-danger  rounded-circle"><i class="fa-regular fa-trash-can"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
