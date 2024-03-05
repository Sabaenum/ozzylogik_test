<div class="container-fluid h-100vh p-0">
    <div class="flex mb-4">
        <div class="w-1/2 bg-gray-400 h-12">
            <table id="multiTable" class="table table-bordered">
                <tbody>
                @foreach($banks as $bank)
                    <tr wire:click="showBankModal({{ $bank->id }})" style="cursor: pointer">
                        <td> {{$bank->title}} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-1/2 bg-gray-400 h-300px">
            <livewire:livewire-column-chart
                :column-chart-model="$columnChartModel"
            />
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="showBankModal" tabindex="-1" data-bs-backdrop="static"
         data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-wide" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Bank Show</h5>
                    <button type="button" class="close" aria-label="Close" wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{$showBank->logo}}"/>
                    <h1>{{$showBank->title}}</h1>
                    <p>{{$showBank->phone}}</p>
                    <p>{{$showBank->email}}</p>
                    <p>{{$showBank->legalAddress}}</p>
                    <p>{{$showBank->site}}</p>
                    <p>{{$showBank->ratingBank}}</p>
                    @foreach($showBank->branches as $branch)
                        @if($branch->data)
                            @foreach($branch->data as $data)
                                <p>{{$data->address}}</p>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('close-modal', () => {
            $('#showBankModal').modal('hide');
        });
        window.addEventListener('show-bank-modal', function () {
            $('#showBankModal').modal('show');
        });
    </script>
@endpush
