<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center bg-white">
                <div class="card-header bg-white">
                    <label for="urlSite" class="form-label">Monitoramento de URL</label>
                    <div class="input-group mb-3">
                        <input type="url" placeholder="Informe a url" class="form-control" id="urlSite" name="urlSite" aria-describedby="btnAdicionar" required>
                        <button class="btn btn-success" type="button" id="btnAdicionar">SALVAR</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container p-0 w-100">
                        <div class="row row-cols-md-4">
                          <div class="col">
                            <div class="card mx-auto" style="width: 12.5rem;">
                                <div class="card-body p-0">
                                    <img src="https://via.placeholder.com/200x200.png?text=AGENDADO" class="card-img-top"/>       
                                </div>
                                <div class="card-footer p-0">
                                    <h6 class="mt-1">http://www.google.com</h6>
                                    <small><strong>Última Verificação: </strong></small><br />
                                    <small>29/09/2021 - 17:43:32</small><br/>
                                    <small><strong>Status Code: </strong></small><br />
                                    <span class="badge rounded-pill bg-success">200</span>

                                    <div class="container mt-2">
                                        <div class="row">
                                          <div class="col p-0">Monitorar:</div>
                                          <div class="col p-0">
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" id="checkMonitorar">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                            <div class="col p-1">Verificação:</div>
                                            <div class="col p-0">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                      5 minutos
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                      <li><a class="dropdown-item" href="#">1 minuto</a></li>
                                                      <li><a class="dropdown-item" href="#">5 minutos</a></li>
                                                      <li><a class="dropdown-item" href="#">10 minutos</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="btn-group mt-2" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger">Excluir</button>
                                        <button type="button" class="btn btn-warning">Log</button>
                                        <button type="button" class="btn btn-success">Visitar</button>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>