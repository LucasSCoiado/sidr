<x-layout.layout title="Cadastro de novo remédio">
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="row justify-content-center mb-3">
                    <div class="col">
                        <p class="display-6 mb-0">Cadastro de novo remédio</p>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('remedios.home') }}" class="btn btn-outline-danger">
                            <i class="fa-solid fa-xmark"></i>
                        </a>            
                    </div>
                </div>
                <hr>
                
                <form action="{{ route('remedios.store') }}" method="post">
                    @csrf 
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="form-group row mt-2">
                                <label for="nome" class="col-sm-2 col-form-label fw-bold">Nome do remédio</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="nome" required>
                               </div>
                               @error('nome')
                                    <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-2">
                                <label for="miligramas" class="col-sm-2 col-form-label fw-bold">Miligramas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="miligramas" required>
                               </div>
                               @error('miligramas')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-4">
                                <label for="quantidadeCaixa" class="col-sm-2 col-form-label fw-bold">Comprimidos na caixa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="quantidadeCaixa" required>
                               </div>
                               @error('quantidadeCaixa')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-2">
                                <label for="quantidadeTomada" class="col-sm-2 col-form-label fw-bold">Quantidade tomada</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="quantidadeTomada" required>
                               </div>
                               @error('quantidadeTomada')
                                    <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-2">
                                <label for="dose" class="col-sm-2 col-form-label fw-bold">Dose</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="dose" required>
                               </div>
                               @error('dose')
                                    <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-4">
                                <label for="caixas" class="col-sm-2 col-form-label fw-bold">Caixas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="caixas" required>
                               </div>
                               @error('caixas')
                                    <div class="text-danger">{{ $message }}</div>
                               @enderror
                            </div>
                            <div class="form-group row mt-4">
                                <label for="frequencia" class="col-sm-2 col-form-label fw-bold">Frequencia diaria</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control w-75 bg-light rounded-top-2" name="frequencia" required>
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