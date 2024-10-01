@extends('layouts.layout')

@section("content")
<productdetailcomponent :product_data="{{ json_encode($product_data) }}" :delete_access="{{ json_encode($delete_access) }}"></productdetailcomponent>
@endsection