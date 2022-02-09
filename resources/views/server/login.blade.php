@extends('server.layout')

@section('page_title') Dev Login @endsection

@push('page_css')

@endpush

@section('page_content')
<div class="container mb-3">
    <h3><strong>Core System Login</strong></h3>
    <hr/>
    <div class="row mt-3">
        <div class="col-md-12">
            <form name="csTeamLoginFrm" id="csTeamLoginFrm" action="{{ route('dev.checklogin') }}?teamLogin=true" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-lebel">User ID: <em>*</em></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="user_id" id="userId" class="form-control" placeholder="User ID" autocomplete="off" required="required" maxlength="12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-lebel">Password: <em>*</em></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required="required" maxlength="20">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-lebel">6 Digit Pin: <em>*</em></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="pin" id="pin" class="form-control" placeholder="6 digit pin" autocomplete="off" required="required" maxlength="6" minlength="6">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="submitBtn" class="submit-btn btn btn-primary" value="Login">
                            <input type="button" id="resetBtn" class="reset-btn btn btn-danger" data-formid="csTeamLoginFrm" value="Reset">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('page_script')
<script src="{{ asset('assets/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/jquery-validation/jquery.validate-default-settings.js') }}"></script>
@endpush
@push('page_js')
<script>
$( "#csTeamLoginFrm" ).validate({
    rules: {
        user_id: {
            required: true,
            maxlength: 12
        },
        password: {
            required: true,
            maxlength: 20
        },
        pin: {
            required: true,
            digits: true,
            maxlength: 6,
            minlength: 6
        }
    },
    messages: {
        user_id: {
            required: "Please enter user ID.",
            maxlength: "User ID should be less than 12 chars."
        },
        password: {
            required: "Please enter password.",
            maxlength: "Password should be less than 20 chars."
        },
        pin: {
            required: "Please enter 6 digits pin number",
            maxlength: "Pin should be equal to 6 chars.",
            minlength: "Pin should be equal to 6 chars.",
            digits: "Pin accept only digit chars."
        }
    },
    submitHandler : function(form) { 
        $.ajax({
            type: form.method,
            url: form.action,
            data: $(form).serialize(),
            headers: {
                'devteam': "{{ env('DEV_TEAM') }}",
                'devname': "{{ env('DEV_NAME') }}"
            },
		    cache: false,
            beforeSend: function () {
                
                $(form).find('#submitBtn').attr('disabled', 'disabled');
                $(form).find('#resetBtn').attr('disabled', 'disabled');
            },
            success: function (axjResponse) {
                if(axjResponse.isSuccess == 1) {
                    toastr.success(axjResponse.msg, 'Login Successfull');
                    setTimeout(function() {
                        window.location.href = "{{ route('devsystem.dashboard') }}";
                    }, 3000);
                }
            },
            error: function (xhr, status, error) {
                var errContain = JSON.parse(xhr.responseText);
                toastr.error(errContain.msg, 'Error');
                $(form).find('#submitBtn').removeAttr('disabled');
                $(form).find('#resetBtn').removeAttr('disabled');
            }
        });
    }
});
</script>
@endpush