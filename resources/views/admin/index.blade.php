@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('bb95ed2387c38eb26efe', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
    var numberNoti = $('#my-notification span.badge').text();
    numberNoti++;
    $('#my-notification span.badge').text(numberNoti);

    var string = `<a href="#" class="item-notification"> ${data.message.username} vừa đặt hàng </a> `;

    $('.adminlte-dropdown-content').prepend(string);


});
</script>
@stop