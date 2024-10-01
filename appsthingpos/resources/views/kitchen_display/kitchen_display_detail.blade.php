@extends('layouts.layout')

@section("content")
<kitchendisplaydetailcomponent :kitchen_display_data="{{ json_encode($kitchen_display_data) }}" :delete_access="{{ json_encode($delete_access) }}" :all_categories="{{ json_encode($categories) }}"></kitchendisplaydetailcomponent>
@endsection