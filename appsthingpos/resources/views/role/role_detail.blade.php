@extends('layouts.layout')

@section("content")
<roledetailcomponent :role_data="{{ json_encode($role_data) }}" :access_menus="{{ json_encode($access_menus) }}" :delete_access="{{ json_encode($delete_access) }}"></roledetailcomponent>
@endsection