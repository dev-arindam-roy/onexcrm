@extends('server.layout')

@section('page_title') Laravel Information @endsection

@push('page_css')

@endpush

@section('page_content')
<div class="container mb-3">
    <h3><strong>Laravel Informations</strong></h3>
    <hr/>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><strong>Paths</strong></div>
                        <div class="card-body">
                            @if(!empty($paths))
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" style="table-layout:fixed">
                                    <tbody>
                                        @foreach($paths as $k => $v)
                                        <tr>
                                            <th>{{ Str::title(Str::replace('_', ' ', $k)) }}</th>
                                            <td style="word-wrap: break-word;">{{ $v }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><strong>Writables</strong></div>
                        <div class="card-body">
                            @if(!empty($writables))
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" style="table-layout:fixed">
                                    <tbody>
                                        @foreach($writables as $k => $v)
                                        <tr>
                                            <th>{{ Str::title(Str::replace('_', ' ', $k)) }}</th>
                                            <td style="word-wrap: break-word;">{!! $v !!}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><strong>Environment Variables</strong></div>
                        <div class="card-body">
                            @if($is_env_exist)
                                @if(!empty($envs))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" style="table-layout:fixed">
                                        <tbody>
                                            @foreach($envs as $k => $v)
                                            <tr>
                                                <th>{{ Str::title(Str::replace('_', ' ', $k)) }}</th>
                                                <td style="word-wrap: break-word;">{!! $v !!}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            @else
                                <div class="alert alert-danger">.env file is missing.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @if($composer)
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><strong>Composer</strong></div>
                        <div class="card-body">
                            @php
                                echo "<pre>";
                                print_r($composer);
                                echo "</pre>";
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($package)
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><strong>Package</strong></div>
                        <div class="card-body">
                            @php
                                echo "<pre>";
                                print_r($package);
                                echo "</pre>";
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>
@endsection

@push('page_js')
<script>

</script>
@endpush