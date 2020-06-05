@extends('layouts.internal')

@section('content')
<div class="container-xl">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <h2 class="page-title">Service</h2>
            </div>
        </div>
    </div>
    <div class="row row-deck">
        <div class="col-md-12 col-lg-12">
            <div class="steps">
                <a href="#" class="step-item active">Register Active Number</a>
                <a href="#" class="step-item">Scan QR Code</a>
                <a href="#" class="step-item">Test Connection</a>
            </div>
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-4">
                            <div class="input-group mb-2">
                                <span class="input-group-text">+62</span>
                                <input type="text" class="form-control" placeholder="822xxx">
                                <small class="form-hint">
                                    <ul>
                                        <li>Your telephone number must be registered on whatsapp</li>                                        
                                        <li>Write phone number without +62 (write number only)</li>                                        
                                    </ul>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button disabled type="button" class="btn btn-pill btn-primary">Continue</button>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-4" style="margin-top: 20px;">
                            <div class="progress progress-sm">
                                <div class="progress-bar progress-bar-indeterminate"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
