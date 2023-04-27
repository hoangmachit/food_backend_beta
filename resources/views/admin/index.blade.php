@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Home') }}</div>
                    <div class="card-body">
                        <ul>
                            <li>Tổng món ăn hôm nay: {{ $totalFood }} </li>
                            <li>Tổng tiên hôm nay: {{ $totalPrice }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
