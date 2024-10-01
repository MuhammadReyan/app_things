@extends('layouts.layout')

@section("content")
<categorydetailcomponent :category_data="{{ json_encode($category_data) }}" :delete_access="{{ json_encode($delete_access) }}"></categorydetailcomponent>
@endsection