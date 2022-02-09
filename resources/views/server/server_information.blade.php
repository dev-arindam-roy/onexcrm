@extends('server.layout')

@section('page_title') Server Information @endsection

@push('page_css')

@endpush

@section('page_content')
<div class="container mb-3">
    <h3><strong>Server Information</strong></h3>
    <hr/>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9"><strong>Server Variables</strong></div>
                        <div class="col-md-3">
                            <input type="text" id="searchTxt" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(!empty($server))
                    <div class="table-responsive">
                        <table id="serverTab" class="table table-bordered table-sm table-striped" style="table-layout:fixed">
                            <tbody>
                                @foreach($server as $variable => $value)
                                <tr>
                                    <th>{{ $variable }}</th>
                                    <td style="word-wrap: break-word;">{{ $value }}</td>
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
</div>
@endsection


@push('page_script')
<script src="{{asset('assets/markjs/jquery.mark.min.js')}}"></script>
@endpush
@push('page_js')
<script>
$(function() {
    var $input = $("#searchTxt"),
    $context = $("#serverTab tr");
    $input.on("input", function() {
        var term = $(this).val();
        $context.show().unmark();
        if (term) {
            $context.mark(term, {
                done: function() {
                    $context.not(":has(mark)").hide();
                }
            });
        }
    });
});
</script>
@endpush