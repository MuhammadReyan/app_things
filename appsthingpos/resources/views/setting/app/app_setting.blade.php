@extends('layouts.layout')

@section("content")
<appsettingcomponent :app_setting="{{ json_encode($setting_data) }}" :customer="{{ json_encode($customer) }}"></appsettingcomponent>
@endsection