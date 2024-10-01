@extends('layouts.layout_with_nav')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kitchen_view.css') }}">
    <link rel="stylesheet" href="{{ asset('css/labels.css') }}">
@endpush

@section("content")
<kitchenviewcomponent :store_slack="{{ json_encode($store_slack) }}" :kitchen_display_slack="{{ json_encode($kitchen_display_slack) }}" :kitchen_display_data="{{ json_encode($kitchen_display_data) }}" :order_link="{{ json_encode($order_link) }}"></kitchenviewcomponent>
@endsection