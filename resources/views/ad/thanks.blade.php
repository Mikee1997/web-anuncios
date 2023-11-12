@extends('layout')

@section('content')
    <h1>{{__('THANK YOU FOR BOOKING')}}</h1>
    <p>{{__('You will receive an email to')}} {{auth()->user()->email}} {{__('when you can pick it up')}}</p>
@endsection
