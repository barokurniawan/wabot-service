@extends('layouts.internal')

@section('content')
<div class="container-xl">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-auto">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                    Dashboard
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ml-auto d-print-none">
                <a href="{{ route('internal_service_new') }}" class="btn btn-primary ml-3 d-none d-sm-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Create New Service
                </a>
                <a href="{{ route('internal_service_new') }}" class="btn btn-primary ml-3 d-sm-none btn-icon" aria-label="Create new report">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="row row-deck row-cards">
        <div class="col-md-6 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Services</h4>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter" id="datatable">
                        <thead>
                            <tr>
                                <th>Device</th>
                                <th>Status</th>
                                <th>Message send</th>
                                <th>Media send</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Message Traffic</h4>
                </div>
                <table class="table card-table table-vcenter">
                    <thead>
                        <tr>
                            <th>Tag</th>
                            <th colspan="2">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PAYMENT_NOTIF</td>
                            <td>3,550</td>
                            <td class="w-50">
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>REG_NOTIF</td>
                            <td>1,798</td>
                            <td class="w-50">
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-primary" style="width: 35.96%"></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('extended_js')
<script>
    $(document).ready(function(){
        $('#datatable').DataTable({
            ordering: false,
            lengthChange: false,
            language: { search: "" },
            responsive: true,
            pagingType: "simple",
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("datatable_service") }}',
                type: 'POST',
            },
            columns: [
                { data: "no" },
                { data: "whatsapp_number" },
                { data: "sum_message_text" },
                { data: "sum_message_media" },
            ],
            drawCallback: function(){
                $('.dataTables_filter input').removeClass('form-control-sm')
                .attr('placeholder', 'Search here..');
            }
        });
    });
</script>
@endpush