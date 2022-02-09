@extends('server.layout')

@section('page_title') Extensions Information @endsection

@push('page_css')

@endpush

@section('page_content')
<div class="container mb-3">
    <h3><strong>All Enabled Extensions</strong></h3>
    <hr/>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9"><strong>Extension List</strong></div>
                        <div class="col-md-3">
                            <input type="text" id="searchTxt" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(!empty($loaded_extensions))
                    <div class="table-responsive">
                        <table id="extensionTab" class="table table-sm table-bordered">
                            <tr>
                                @foreach($loaded_extensions as $k => $v)
                                    @if($k % 3 == 0)
                                        <tr></tr>
                                    @endif
                                    <td><i>{{ $v }}</i></td>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page_js')
<script src="{{asset('assets/markjs/jquery.mark.min.js')}}"></script>
<script>
$(function() {
    var $input = $("#searchTxt"),
    $context = $("#extensionTab tr");
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