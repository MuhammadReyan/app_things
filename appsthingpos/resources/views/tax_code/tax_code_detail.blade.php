@extends('layouts.layout')

@section("content")
<taxcodedetailcomponent :tax_code_data="{{ json_encode($tax_code_data) }}" :delete_access="{{ json_encode($delete_access) }}"></taxcodedetailcomponent>
@endsection