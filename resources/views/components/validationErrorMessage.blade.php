<script>
// display validation error messages 
    @if(Session::has('create_error') AND count($errors))
        $('#{{$createModal}}').modal({show:true});
        var content = $(':radio[name="content"]:checked').val();
        toggleContentView(content);
        @foreach($errors->all() as $err)
            $('#{{$createModal}} .create-error-message').append('{{$err}}<br>');
        @endforeach
    @endif
    @if(Session::has('update_error') AND count($errors))
        idClicked = '{{Session::get('update_id')}}';
        $('#{{$updateModal}}').modal({show:true});
        $('#{{$updateModal}} form').attr('action','/{{$updateRoute}}/'+idClicked+'/update');
        var content = $(':radio[name="content"]:checked').val();
        toggleContentView(content);
        @foreach($errors->all() as $err)
            $('#{{$updateModal}} .update-error-message').append('{{$err}}<br>');
        @endforeach
    @endif
</script>