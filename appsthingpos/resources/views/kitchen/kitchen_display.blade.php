@extends('layouts.layout')

@section("content")
<kitchendisplaycomponent :kitchen_display_data="{{ json_encode($kitchen_display_data) }}" :kitchen_link="{{ json_encode($kitchen_link) }}"></kitchendisplaycomponent>
@endsection