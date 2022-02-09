@extends('server.layout')

@section('page_title') System Information @endsection

@push('page_css')

@endpush

@section('page_content')
<div class="container mb-3">

    @if(isset($have_extension_error)) 
    <div class="row">
        <div class="col-md-12">
            @if($have_extension_error)
            <div class="alert alert-danger">
                <strong>Extension Error!</strong> Require Extensions Not Loaded! Please Check in Extension Section, Thankyou.
            </div>
            @else
            <div class="alert alert-success">
                <strong>All Looks Good!</strong>
            </div>
            @endif
        </div>
    </div>
    @endif
    <hr/>
    @if(!empty($php_version))
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><strong>PHP VERSION INFORMATION</strong></h3></div>
                <div class="card-body">
                    <table class="table table-sm table-bordered" style="table-layout:fixed">
                        <tbody>
                            @foreach($php_version as $k => $v)
                            <tr>
                                <th style="width: 50%;">{{ strtoupper(str_replace('_', ' ', $k)) }}</th>
                                <td style="width: 50%; word-wrap: break-word;">{{ $v }}</td>
                            </tr>
                            @endforeach
                            @if(isset($php_port))
                            <tr>
                                <th style="width: 50%">PHP PORT NO</th>
                                <td>{{ $php_port }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><strong>SERVER REQUIREMENTS FOR LARAVEL - 8</strong></h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('images/laravel_8_server_requirement.png') }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($require_extensions))
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><strong>CHECKING SERVER REQUIREMENTS FOR LARAVEL - 8</strong></h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Require</th>
                                        <th>Current</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Require Laravel Version - Minimum 8</th>
                                        <td>{{ $laravel_version }}</td>
                                        <td>
                                            @if($laravel_version >= 8)
                                                <span class="text-success"><strong>Success!</strong></span>
                                            @else
                                                <span class="text-danger"><strong>Failed!</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                    @foreach($require_extensions as $k => $v)
                                    <tr>
                                        <th>Require {{ ucwords(str_replace('_', ' ', $k)) }}</th>
                                        <td>{{ $v == 'Y' ? 'Enabled' : ''}}</td>
                                        <td>
                                            {!! $v == 'Y' ? '<span class="text-success"><strong>Success!</strong></span>' : '<span class="text-danger"><strong>Failed!</strong></span>'!!}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p><a href="https://laravel.com/docs/8.x/deployment" target="_blank">If Require, Please Check Laravel 8 Documentation</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(!empty($server_details))
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><strong>SERVER INFORMATIONS</strong></h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-sm table-bordered" style="table-layout:fixed">
                                <tbody>
                                  @foreach($server_details as $k => $v)
                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', $k)) }}</th>
                                            <td style="word-wrap: break-word;">{!! $v !!}</td>
                                        </tr>
                                        @endforeach  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection