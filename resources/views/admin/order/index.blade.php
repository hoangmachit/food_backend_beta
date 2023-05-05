@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            {{ __('Order') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="" id="form-search" class="formOrder">
                                    <div class="d-flex justify-content-start">
                                        <div class="input-search">
                                            <input type="text" class="form-control" name="keyword"
                                                placeholder="Tìm kiếm đơn hàng" id="keyword">
                                        </div>
                                        <div class="input-search ms-2">
                                            <input type="date" class="form-control" name="date" placeholder="Date"
                                                value="{{ $date->format('Y-m-d') }}" id="date">
                                        </div>
                                        <button type="submit" class="btn-search ms-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                                <div class="ms-2 bulk-order" data-route="{{ route('admin.order.status') }}"
                                    data-redirect="{{ route('admin.order.index') }}">
                                    <button type="button" name="status" value="1" class="btn btn-danger">
                                        Mới đặt hàng
                                    </button>
                                    <button type="button" name="status" value="2" class="btn btn-warning">
                                        Chờ nhận hàng
                                    </button>
                                    <button type="button" name="status" value="3" class="btn btn-primary">
                                        Đã có hàng
                                    </button>
                                    <button type="button" name="status" value="4" class="btn btn-success">
                                        Đã nhận hàng
                                    </button>
                                    <button type="button" name="status" value="5" class="btn btn-secondary">
                                        Hoàn thành
                                    </button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped tableOrder">
                            <thead>
                                <tr>
                                    <th scope="col" width="75">
                                        <div class="form-check">
                                            <input class="form-check-input form-check-all" type="checkbox">
                                        </div>
                                    </th>
                                    <th scope="col" width="200">Customer</th>
                                    <th scope="col" width="150">Phone number</th>
                                    <th scope="col" width="500">Order detail</th>
                                    <th scope="col" width="150">Payment method</th>
                                    <th scope="col" width="150">Create At</th>
                                    <th scope="col" width="100">Status</th>
                                    <th scope="col" class="text-center" width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>
                                            <div class="form-check form-checkbox-order">
                                                <input class="form-check-input" type="checkbox" name="bulk[]"
                                                    value="{{ $order->id }}" id="checkbox_order_{{ $order->id }}">
                                            </div>
                                        </td>
                                        <td>{{ $order->user_name }}</td>
                                        <td>{{ $order->phone_number }}</td>
                                        <td>
                                            @if ($order->order_detail->isNotEmpty())
                                                <ul>
                                                    @foreach ($order->order_detail as $order_detail)
                                                        <li>
                                                            <div>
                                                                Product Name: {{ $order_detail->name }}
                                                            </div>
                                                            @if ($order_detail->price > 0)
                                                                <div>
                                                                    Qty: {{ $order_detail->quantity }}
                                                                </div>
                                                                <div class="product-image">
                                                                    <img src=" {{ $order_detail->image && $order_detail->image != '' ? asset('/uploads/product/' . $order_detail->image) : asset('/image/no-image.gif') }}"
                                                                        alt="{{ $order_detail->name }}">
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>{{ $order->payment->name }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @php
                                                $class = 'bg-danger';
                                                switch ($order->order_status->id) {
                                                    case 2:
                                                        $class = 'bg-warning';
                                                        break;
                                                    case 3:
                                                        $class = 'bg-primary';
                                                        break;
                                                    case 4:
                                                        $class = 'bg-success';
                                                        break;
                                                    case 5:
                                                        $class = 'bg-secondary';
                                                        break;
                                                    default:
                                                        break;
                                                }
                                            @endphp
                                            <span
                                                class="badge pt-2 pb-2 {{ $class }}">{{ $order->order_status->name }}</span>
                                        </td>
                                        <td>
                                            <div class="order-action">
                                                <button class="btn-remove-order"
                                                    data-action={{ route('admin.order.delete', ['id' => $order->id]) }}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                        <path
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalDeleteOrder" tabindex="-1" aria-labelledby="modalDeleteOrder" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteOrder">Delete order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" role="form" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        Are you sure delete it !!!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
