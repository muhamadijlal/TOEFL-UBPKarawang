@extends('master.index')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/dist/css/alt/select2.min.css') }}">
@endpush

@section('breadcrumbs')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Invoice</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-12">
            <div class="callout callout-info">
                <h4><i class="fas fa-info text-info"></i> Note:</h4>
                This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>
            <div class="invoice p-3">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <img src="{{ asset('assets/dist/img/logo-ubp.png') }}" width="50" alt="logo-ubp"> TOEFL UBP Karawang
                            <small class="float-right">Date: Tanggal dibuat</small>
                        </h4>
                    </div>
                </div>
        
                <div class="row invoice-info mt-4">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Admin, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com
                        </address>
                    </div>
        
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>Nama Mahasiswa</strong><br>
                            NIM<br>
                            Phone: (555) 539-1037<br>
                            Email: john.doe@example.com
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #0202202301</b><br>
                        <br>
                        <b>Order ID:</b> 4F3S8J<br>
                        <b>Tempo Pembayaran:</b> 2/22/2014<br>
                        <b>Virtual Account:</b> 968-34567
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Nim</th>
                                    <th>Bahasa</th>
                                    <th>Jenis</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Call of Duty</td>
                                    <td>455-981-221</td>
                                    <td>El snort testosterone trophy driving gloves handsome</td>
                                    <td>$64.50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <p class="lead">Payment Methods:</p>
                        <img src="{{ asset('assets/dist/img/credit/visa.png') }}" alt="Visa">
                        <img src="{{ asset('assets/dist/img/credit/mastercard.png') }}" alt="Mastercard">
                        <img src="{{ asset('assets/dist/img/credit/american-express.png') }}" alt="American Express">
                        <img src="{{ asset('assets/dist/img/credit/paypal2.png') }}" alt="Paypal">
                        {{-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                        plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                        </p> --}}
                    </div>
                    <div class="col-6">
                        <p class="lead">Tempo Pembayaran 2/22/2014</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>$250.30</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>$265.24</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        
                <div class="row no-print">
                    <div class="col-12">
                        <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                            Payment
                        </button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-download"></i> Generate PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush