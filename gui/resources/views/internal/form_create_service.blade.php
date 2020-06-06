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
                <a href="#" class="step-item {{ ($step == "1" || empty($step)) ? "active" : "" }}">Register Active Number</a>
                <a href="#" class="step-item {{ ($step == "2") ? "active" : "" }}">Scan QR Code</a>
                <a href="#" class="step-item {{ ($step == "3") ? "active" : "" }}">Test Connection</a>
            </div>
        </div>
        @if (empty($step) || $step == 1)
            @include('internal.step.first')
        @endif

        @if ($step == 2)
            @include('internal.step.second')
        @endif

        @if ($step == 3)
            @include('internal.step.third')
        @endif
    </div>
</div>
@endsection
