@extends('layouts.layout')

@section("content")
<supplierdetailcomponent :supplier_data="{{ json_encode($supplier_data) }}" :delete_access="{{ json_encode($delete_access) }}"></supplierdetailcomponent>
@endsection