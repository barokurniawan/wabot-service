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
                <a href="#" class="btn btn-primary ml-3 d-none d-sm-inline-block" data-toggle="modal" data-target="#modal-report">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Create New Service
                </a>
                <a href="#" class="btn btn-primary ml-3 d-sm-none btn-icon" data-toggle="modal"
                    data-target="#modal-report" aria-label="Create new report">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>
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
                    <table class="table card-table table-vcenter">
                        <thead>
                            <tr>
                                <th>Device</th>
                                <th>Status</th>
                                <th>Message send</th>
                                <th>Media send</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>
                                <a href="">082215512601</a>
                            </td>
                            <td class="text-muted">Connected</td>
                            <td class="text-muted">4,896</td>
                            <td class="text-muted">3,654</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="">082215512602</a>
                            </td>
                            <td class="text-muted">Connected</td>
                            <td class="text-muted">4,896</td>
                            <td class="text-muted">3,654</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="">082215512603</a>
                            </td>
                            <td class="text-muted">Connected</td>
                            <td class="text-muted">4,896</td>
                            <td class="text-muted">3,654</td>
                        </tr>
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
                            <td>Instagram</td>
                            <td>3,550</td>
                            <td class="w-50">
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Twitter</td>
                            <td>1,798</td>
                            <td class="w-50">
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-primary" style="width: 35.96%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Facebook</td>
                            <td>1,245</td>
                            <td class="w-50">
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-primary" style="width: 24.9%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Pinterest</td>
                            <td>854</td>
                            <td class="w-50">
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-primary" style="width: 17.08%"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>VK</td>
                            <td>650</td>
                            <td class="w-50">
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-primary" style="width: 13.0%"></div>
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
