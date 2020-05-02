@extends('layouts.admin')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
@endpush
@section('content')
<div id="ledger-page" class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="align-self-center page-title">Ledger Book: {{ $store->name }}</h5>
                    
                    @can('viewAny', App\LedgerEntry::class)
                    <div class="ml-auto" v-cloak>
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-info btn-md m-0 px-3 py-2 z-depth-0 rounded-0 dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-filter pr-2"></i> {{ $store->name ?? 'Select Store' }} </button>
                            <div class="dropdown-menu">
                                <a v-for="store in stores" class="dropdown-item" v-bind:href="store.ledger_url">@{{ store.name }}</a></option>
                            </div>
                        </div>
                    </div>
                    @endcan
                    
                    @can('request-payment', $store)
                    <div class="ml-auto align-self-center">
                        <div class="text-center">
                            @if( ! $store->hasRequestedPayment && $data->balance >= $store->credit_limit)
                            <button type="button" class="btn btn-success card-shadow text-capitalize" data-toggle="modal" data-target="#paymentRequestModal"><i class="far fa-paper-plane mr-2"></i> Request Payment</button>
                            @endif
                            @if($store->hasRequestedPayment)
                            <div class="text-success"><i class="fa fa-check mr-2"></i> Payment Requested</div>
                            @endif
                        </div>
                    </div>
                    @endcan
                    
                    
                </div>
                @include('partials.alerts')
            </div>
            
            <div class="col-md-12">
                <div class="row justify-content-center mb-3">
                    <div class="col-md-3">
                        <div class="card card-shadow mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="mb-3">Total Earning</div>
                                        <div>
                                            <h4><strong class="text-green"><small>NRs.</small> {{ number_format($data->earnings) }}</strong></h4>
                                        </div>
                                    </div>
                                    <div class="grey lighten-4 rounded p-2">
                                        <span class="text-ink"><i class="fas fa-hand-holding-usd fa-2x"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-shadow mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="mb-3">Total Withdrawal</div>
                                        <div>
                                            <h4><strong class="text-red"><small>NRs.</small> {{ number_format($data->withdrawals) }}</strong></h4>
                                        </div>
                                    </div>
                                    <div class="grey lighten-4 rounded p-2">
                                        <span class="text-ink"><i class="far fa-credit-card fa-2x"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-shadow mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="mb-3">Balance</div>
                                        <div>
                                            <h4><strong class="text-ink"><small>NRs.</small> {{ number_format($data->balance) }} </strong></h4>
                                        </div>
                                    </div>
                                    <div class="grey lighten-4 rounded p-2">
                                        <span class="text-ink"><i class="fas fa-dollar-sign fa-2x"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-shadow mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="mb-3">Min. Withdrawal </div>
                                        <div>
                                            <h4><strong class="text-ink"><small>NRs.</small> {{ number_format($store->credit_limit) }}  </strong></h4>
                                        </div>
                                    </div>
                                    <div class="grey lighten-4 rounded p-2">
                                        <span class="text-ink"><i class="fas fa-sign-out-alt fa-lg"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card card-shadow">
                    <div class="card-header grey lighten-5">
                        <div class="d-flex">
                            <div class="align-self-center">
                                Showing ledger of {{ $store->name }}
                            </div>
                            @can('create', App\LedgerEntry::class)
                            {{ $data->balance }}
                            @if($data->balance >= $store->credit_limit)
                            <div class="ml-auto">
                                <div class="text-center">
                                    <a href="" class="btn btn-outline-primary btn-sm card-shadow" data-toggle="modal" data-target="#modalDepositForm">Deposit Voucher</a>
                                </div>
                            </div>
                            @endif
                            @endcan
                            
                        </div>
                    </div>
                    <div class="card-body white card-shadow p-3">
                        <table id="transactions-table" class="table custom-table table-hover white">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Details</th>
                                    <th>S.P.</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($entries as $entry)
                                <tr>
                                    <td>{{ \carbon\carbon::parse($entry->created_at)->format('j M , Y @ h:i A') }}</td>
                                    <td>{{ $entry->details }}</td>
                                    <td>{{ $entry->sellingPriceAmount }}</td>
                                    <td class="text-danger">{{ $entry->debitAmount }}</td>
                                    <td class="text-success">{{ $entry->creditAmount }}</td>
                                    <td>{{ $entry->balanceAmount }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center font-italic" colspan="10">
                                        !! No transactions found !!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex">
                        <div class="align-self-center text-dark">
                            Showing {{ $entries->firstItem() }} to {{ $entries->lastItem() }} of {{ $entries->total() }} entries
                        </div>
                        @if($entries->hasPages())
                        <div class="align-self-center ml-auto">
                            {{ $entries->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- Deposit Form Modal --}}
@can('create', App\LedgerEntry::class)
<div class="modal fade" id="modalDepositForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Deposit Voucher</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ledgers.store', $store->id) }}" method="POST" class="form white">
                @csrf
                <div class="modal-body mx-3">
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <div class="form-group">
                        <label for="">Amount</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">NRs.</div>
                            </div>
                            <input type="number" name="amount" class="form-control py-0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Transaction Details</label>
                        <input type="text" name="details" class="form-control" required>
                        <small>Type in transaction date, E-sewa or bank transaction number.</small>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-success card-shadow">Deposit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
{{-- End of Deposit Form Modal --}}

{{-- Payment Request Modal --}}
<div class="modal fade" id="paymentRequestModal" tabindex="-1" role="dialog" aria-labelledby="paymentRequestModal"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Cast Withdrawal Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('store.payment.request', $store) }}" method="POST" class="form">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="number" name="requested_amount" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary card-shadow mr-auto" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success card-shadow text-capitalize"><i class="far fa-paper-plane mr-2"></i> Ok, Withdraw</button>
            </div>
        </form>
    </div>
</div>
</div>
{{-- End of Payment Request Modal --}}
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script>
    $(function () {
        $('[data-toggle="popover"]').popover();
        
        @if(Auth::user()->hasRole('admin', 'manager'))
        var adminSidebar = new Vue({
            el: '#ledger-page',
            data: {
                stores: []
            },
            created() {
                this.fetchStoresList();
            },
            methods: {
                fetchStoresList: function(){
                    axios.get("{{ route('ajax.ledgers.stores_list') }}")
                    .then(response => {
                        console.log(response.data);
                        this.stores = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
                }
            }
        })
        @endif
        
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = yyyy + '/' + mm + '/' + dd;
        
        var printTitle = '<span style="font-size: 20px; font-weight: 600;">Chhitomitho.com</span><small style="font-size: 12px; float:right;">Date: ' + today + '</small><p style="font-size: 14px;">Report of:  {{ $store->name }}</p>';
        var exportTitle = '{{ $store->name }} ( ' + today + ' )';
        $('#transactions-table').DataTable( {
            order: [],
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'copy',
                title: exportTitle,
                messageTop: 'Chhitomitho.com'
            },
            {
                extend: 'excel',
                title: exportTitle,
                messageTop: 'Chhitomitho.com'
            },
            'csvHtml5',
            {
                extend: 'print',
                title: printTitle
            }
            ]
        } );
        
    });
</script>
@endpush