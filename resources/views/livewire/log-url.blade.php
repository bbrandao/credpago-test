<div>
    <div class="modal-content" style="display: {{ $display }};">
        <div class="modal-header">
            <h5 class="modal-title" id="modalUrlLog">{{ $urlSite }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
        </div>
        <div class="modal-body">
            <div style="max-height: 400px; overflow:auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Screenshot</th>
                            <th scope="col" class="text-center">Status Code</th>
                            <th scope="col" class="text-center">Data Verificação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrLogs as $log)
                        <tr class="align-middle">
                            <td class="text-center">
                                <div style="max-height: 70px; max-width: 100px; overflow:hidden;">
                                    <img src="{{ $log->data }}" style="max-width: 100px;"/>
                                </div>
                            </td>
                            <td class="text-center p-2">
                                <span class="badge rounded-pill @if($log->status_code < 400) bg-success @else bg-danger @endif">{{ $log->status_code }}</span>
                            </td>
                            <td class="text-center p-2">{{  $log->created_at->format("d/m/Y H:i:s")  }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">Fechar</button>
        </div>
    </div>
        
</div>
