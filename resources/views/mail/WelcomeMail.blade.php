@extends('mail.BaseMail')
@section('body')

    <h4>welcome:{{$data??''}}</h4>
    <hr>
    <p>Hi there,</p>
    <p>Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>
@endsection
