@extends('master.index')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/dist/css/alt/select2.min.css') }}">
@endpush

@section('title')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Invoice</h1>
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
                Segera lakukan pembayaran melalui BNI Virtual Account.
            </div>
            <div class="invoice p-3">
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <img src="{{ asset('assets/dist/img/logo-ubp.png') }}" width="50" alt="logo-ubp"> TOEFL UBP Karawang
                            <small class="float-right">Date: {{ $data->created_at->format('d/m/Y') }}</small>
                        </h4>
                    </div>
                </div>
        
                <div class="row invoice-info mt-4">
                    <div class="col-sm-4 invoice-col">
                        Dari
                        <address>
                            <strong>Universitas Buana Perjuangan Karawang</strong><br>
                            Jl. HS.Ronggo Waluyo<br>
                            Puseurjaya, Telukjambe Timur, Karawang<br>
                            Jawa Barat, 41361<br>
                            Phone: (0267) 8403140<br>
                        </address>
                    </div>
        
                    <div class="col-sm-4 invoice-col">
                        Kepada
                        <address>
                            <strong>{{ strtoupper($data->user->nama) }}</strong><br>
                            {{ $data->user->profile->nim }}<br>
                            Email: {{ $data->user->email }}
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #{{ $data->invoice->nomor_invoice }}</b><br>
                        <br>
                        <b>Tempo Pembayaran :</b> null<br>
                        <b>Virtual Account :</b> {{ $data->virtual_account }}<br>
                        <b>Periode :</b> {{ $data->periode->nama_periode }}
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
                                    <td>{{ strtoupper($data->user->nama) }}</td>
                                    <td>{{ $data->user->profile->nim }}</td>
                                    <td>{{ ucwords($data->product->bahasa) }}</td>
                                    <td>{{ ucwords($data->product->jenis) }}</td>
                                    <td>@currency(intval($data->subtotal))</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <p class="lead">Payment Methods:</p>
                        <img src="{{ asset('assets/dist/img/logo-bni.jpg') }}" alt="BNI" height="50px;">
                    </div>
                    <div class="col-6">
                        <p class="lead">Tempo Pembayaran 2/22/2014</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>@currency(intval($data->subtotal))</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>@currency(intval($data->subtotal))</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-12">
                        <button type="button" onclick="window.print();return false;" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush