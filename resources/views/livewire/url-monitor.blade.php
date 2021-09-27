<div>
    <div class="card text-center bg-white">
        <div class="card-header bg-white">
            <label for="urlSite" class="form-label">Monitoramento de URL</label>
            <div class="input-group mb-3">

                <input type="url" placeholder="Informe a url" class="form-control" id="urlSite" name="urlSite" wire:model="urlSite" aria-describedby="btnAdicionar" required>
                <button class="btn btn-success" type="button" id="btnAdicionar" wire:click="create">SALVAR</button>
            </div>
            @error('urlSite')
            <div class="alert alert-danger p-1" role="alert">
                {{ $message }}
            </div>
            @enderror
            @if(session()->has('message'))
            <div class="alert alert-success p-1" role="alert">
                {{ session('message') }}
            </div>
            @endif
        </div>
        <div class="card-body">
            <div class="container p-0 w-100">
                <div class="row row-cols-md-4">
                  @foreach ($arrUrl as $url)
                   <div class="col my-2">
                    <div class="card mx-auto" style="width: 12.5rem;">
                        <div class="card-body p-0">
                            @if($url->logs->count() > 0)
                            @if($url->logs->last()->status_code == 200)
                            <div style="max-height: 140px; overflow:hidden;">
                                <img src="{{ $url->logs->last()->data }}" class="card-img-top"/>
                            </div>
                            @else
                            <img src="https://via.placeholder.com/200x140.png?text=ERRO!" class="card-img-top"/>
                            @endif       
                            @else
                            <img src="https://via.placeholder.com/200x140.png?text=AGENDADO" class="card-img-top"/>       
                            @endif
                        </div>
                        <div class="card-footer p-0">
                            <h6 class="mt-1">{{ $url->url }}</h6>
                            <small><strong>Última Verificação: </strong></small><br />
                            @if($url->logs->count() > 0)
                            <small>{{ $url->logs->last()->created_at->format("d/m/Y H:i:s") }}</small><br/>
                            @else
                            <span class="badge rounded-pill bg-info">Aguardando Atualização</span><br />
                            @endif
                            <small><strong>Status Code: </strong></small><br />
                            @if($url->logs->count() > 0)
                            <span class="badge rounded-pill @if($url->logs->last()->status_code < 400) bg-success @else bg-danger @endif">{{ $url->logs->last()->status_code }}</span>
                            @else
                            <span class="badge rounded-pill bg-info">Aguardando Atualização</span>
                            @endif
                            <div class="container mt-2">
                                <div class="row">
                                  <div class="col p-0">Monitorar:</div>
                                  <div class="col p-0">
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input" type="checkbox" id="checkMonitorar-{{ $url->id }}" @if($url->monitorar == 1) checked @endif wire:change="alterarStatusMonitoramento({{ $url->id }}, {{ $url->monitorar }})">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col p-1">Verificação:</div>
                                    <div class="col p-0">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button id="btnPeriodoMonitoramento-{{ $url->id }}" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                              {{ $url->check_time }} minutos
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnPeriodoMonitoramento-{{ $url->id }}">
                                              <li><a class="dropdown-item" href="#" wire:click="alterarPeriodoMonitoramento({{ $url->id }}, 1)">1 minuto</a></li>
                                              <li><a class="dropdown-item" href="#" wire:click="alterarPeriodoMonitoramento({{ $url->id }}, 5)">5 minutos</a></li>
                                              <li><a class="dropdown-item" href="#" wire:click="alterarPeriodoMonitoramento({{ $url->id }}, 10)">10 minutos</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                  </div>
                            </div>
                            <div class="btn-group mt-2" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-danger" wire:click="excluirUrl({{ $url->id }})">Excluir</button>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUrlLog" wire:click="openModal({{ $url->id }})">Log</button>
                                <a href="{{ $url->url }}" target="_blank" class="btn btn-success">Visitar</a>
                            </div>
                        </div>
                    </div>
                  </div>
                  @endforeach 
                </div>
              </div>      
        </div>
    </div>
</div>