@extends('layouts.layout')

@section("content")
<addkitchendisplaycomponent :statuses="{{ json_encode($statuses) }}" :kitchen_display_data="{{ json_encode($kitchen_display_data) }}" :available_categories="{{ json_encode($categories) }}"></addkitchendisplaycomponent>
@endsection