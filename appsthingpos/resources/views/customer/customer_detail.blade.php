@extends('layouts.layout')

@section("content")
<customerdetailcomponent :customer_data="{{ json_encode($customer_data) }}" :delete_access="{{ json_encode($delete_access) }}"></customerdetailcomponent>
@endsection