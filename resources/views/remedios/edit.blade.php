<x-layout.layout title="Editando">
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="row justify-content-center mb-3">
                    <div class="col">
                        <p class="display-6 mb-0">Editando dados do medicamento</p>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('remedios.home') }}" class="btn btn-outline-danger">
                            <i class="fa-solid fa-xmark"></i>
                        </a>            
                    </div>
                </div>
                <hr>
                
                <form action="{{ route('remedios.edit', ['id'=>$remedios->id]) }}" method="post">
                    @csrf 
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="form-group row mt-2">
                                <label for="nome" class="col-sm-2 col-form-label fw-bold">Nome do remédio</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="nome" required value="{{ $remedios->nome }}">
                               </div>
                               @error('nome')
                                    <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-2">
                                <label for="miligramas" class="col-sm-2 col-form-label fw-bold">Miligramas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="miligramas" required value="{{ $remedios->miligramas }}">
                               </div>
                               @error('miligramas')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            {{-- <div class="form-group row mt-4">
                                <label for="qtdRestante" class="col-sm-2 col-form-label fw-bold">Quantidade restante</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="qtdRestante" required value="{{ $remedios->qtdRestante }}">
                               </div>
                               @error('qtdRestante')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div> --}}
                            <div class="form-group row mt-2">
                                <label for="quantidadeTomada" class="col-sm-2 col-form-label fw-bold">Quantidade tomada</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="quantidadeTomada" required value="{{ $remedios->quantidadeTomada }}">
                               </div>
                               @error('quantidadeTomada')
                                    <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-2">
                                <label for="dose" class="col-sm-2 col-form-label fw-bold">Dose</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="dose" required value="{{ $remedios->dose }}">
                               </div>
                               @error('dose')
                                    <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-4">
                                <label for="caixas" class="col-sm-2 col-form-label fw-bold">Caixas</label>
                                <div class="col-sm-10">
                                     <div class="d-flex align-items-center gap-3">
                                        <input type="text" readonly class="form-control w-25 bg-white" value="{{ $remedios->caixas }}">
                                        <input type="number" min="0" class="form-control w-25" name="add_caixas" placeholder="Adicionar caixas (ex: 1)">
                                     </div>
                               </div>
                                 @error('add_caixas')
                                     <div class="text-danger">{{ $message }}</div>
                                 @enderror
                            </div>
                            <div class="form-group row mt-2">
                                <label for="qtdRestante" class="col-sm-2 col-form-label fw-bold">Quantidade restante</label>
                                <div class="col-sm-10">
                                    <div class="d-flex align-items-center gap-3">
                                        <input type="text" readonly class="form-control w-25 bg-white" value="{{ $remedios->qtdRestante }}">
                                        <input type="number" min="0" class="form-control w-25" name="add_qtdRestante" placeholder="Adicionar unidades (ex: 10)">
                                    </div>
                               </div>
                               @error('add_qtdRestante')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-4">
                                <label for="frequencia" class="col-sm-2 col-form-label fw-bold">Frequencia diaria</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="frequencia" required value="{{ $remedios->frequencia }}">
                               </div>
                               @error('frequencia')
                                    <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col text-end">
                            <a href="{{ route('remedios.home') }}" class="btn btn-secondary px-5"><i class="fa-solid fa-ban me-2"></i>Cancelar</a>
                            <button type="submit" class="btn btn-primary px-5"><i class="fa-regular fa-circle-check me-2"></i>Salvar</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

</x-layout.layout>