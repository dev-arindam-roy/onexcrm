@php
	$toastrMessage = '';
    $toastrTitle = '';
	if(Session::has('msg') && Session::get('msg') != '') {
		$toastrMessage = Session::get('msg');
	} 
    if(Session::has('msg_title') && Session::get('msg_title') != '') {
		$toastrTitle = Session::get('msg_title');
	} 
@endphp

@if(Session::has('msg_class') && Session::get('msg_class') == 'alert alert-success')
<script>
$(document).ready(function(){
	toastr.success('{{ $toastrMessage }}', '{{ $toastrTitle }}');
});
</script>
@endif

@if(Session::has('msg_class') && Session::get('msg_class') == 'alert alert-danger')
<script>
$(document).ready(function(){
	toastr.error('{{ $toastrMessage }}', '{{ $toastrTitle }}');
});
</script>
@endif

@if(Session::has('msg_class') && Session::get('msg_class') == 'alert alert-warning')
<script>
$(document).ready(function(){
	toastr.warning('{{ $toastrMessage }}', '{{ $toastrTitle }}');
});
</script>
@endif

@if(Session::has('msg_class') && Session::get('msg_class') == 'alert alert-info')
<script>
$(document).ready(function(){
	toastr.info('{{ $toastrMessage }}', '{{ $toastrTitle }}');
});
</script>
@endif