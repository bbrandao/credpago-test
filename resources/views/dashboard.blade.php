<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @livewire('url-monitor')
        </div>
    </div>

    @push('modals')
        <div class="modal fade hide" id="modalUrlLog" tabindex="-1" aria-labelledby="modalUrlLog" style="display: none;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                @livewire('log-url')
            </div>
        </div>
    @endpush

    @push('scripts')
        <script>
            setInterval(updateComponent, (60 *1000) );
                
            function updateComponent() {
                Livewire.emit('urlUpdated');
            }
        </script>
    @endpush    

</x-app-layout>
