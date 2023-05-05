@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Home') }}</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="" id="form-search" class="formOrder">
                                    <div class="d-flex justify-content-start">
                                        <div class="input-search ms-2">
                                            <input type="date" class="form-control" name="date"
                                                value="{{ $date->format('Y-m-d') }}" id="date">
                                        </div>
                                        <button type="submit" class="btn-search ms-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <ul>
                            <li>Tổng tiên hôm nay: <span
                                    class="text-danger"><strong>{{ formatPrice($totalPrice) }}</strong></span></li>
                        </ul>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div>
                                            <h3 class="title-food">Danh sách món ăn ngày: <span
                                                    class="text-danger">{{ $date->format('d/m/Y') }}</span></h3>
                                            <p class="m-0">Tổng món ăn hôm nay: <span
                                                    class="text-danger"><strong>{{ $totalFood }}</strong></span> </p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-Food">
                                            @foreach ($orderDetails as $detail)
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex justify-content-start d-product">
                                                            <div class="d-product-image">
                                                                <div class="product_image_view">
                                                                    <div class="main-view">
                                                                        <img src="{{ $detail->Product->image && $detail->Product->image != '' ? asset('/uploads/product/' . $detail->Product->image) : asset('/image/no-image.gif') }}"
                                                                            alt="{{ $detail->Product->name }}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="ms-2 d-product-name">
                                                                <p class="m-0">{{ $detail->Product->name }} @if ($detail->Product->price == 0)
                                                                        x <span
                                                                            class="text-danger">{{ $detail->quantity }}</span>
                                                                    @endif
                                                                </p>

                                                            </div>
                                                        </div>
                                                        @if ($detail->Product->price > 0)
                                                            <div class="d-price">
                                                                {{ $detail->quantity }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
