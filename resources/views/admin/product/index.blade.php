@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('List Product') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex justify-content-start align-items-center">
                                <form action="" id="form-search">
                                    <div class="input-search">
                                        <input type="text" class="form-control" name="keyword"
                                            placeholder="Tìm kiếm sản phẩm" id="keyword">
                                    </div>
                                    <button type="submit" class="btn-search">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.product.allStatus') }}" role="form" class="ms-2"
                                    role="form" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="show" class="btn btn-danger">
                                        Hiện tất cả
                                    </button>
                                    <button type="submit" name="action" value="hide" class="btn btn-warning">
                                        Ẩn tất cả
                                    </button>
                                </form>
                            </div>
                            <div class="add-new">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreateProduct">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                        </svg>
                                        Add Product
                                    </span>
                                </button>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" width="75">#No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" width="200">Image</th>
                                    <th scope="col" width="200">Price</th>
                                    <th scope="col" width="200">Status</th>
                                    <th scope="col" class="text-center" width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            <h3 class="product_name"> {{ $product->name }}</h3>
                                        </td>
                                        <td>
                                            <div class="product-image">
                                                <img src="{{ $product->image && $product->image != '' ? asset('/uploads/product/' . $product->image) : asset('/image/no-image.gif') }}"
                                                    alt="{{ $product->name }}" />
                                            </div>
                                        </td>
                                        <td>{{ formatPrice($product->price) }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input input-product-status"
                                                    data-status={{ $product->status }}
                                                    data-route="{{ route('admin.product.status', ['id' => $product->id]) }}"
                                                    type="checkbox" id="product_status_{{ $product->id }}"
                                                    @if (!empty($product->status) && $product->status === 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-action">
                                                <button class="btn-edit"
                                                    data-action="{{ route('admin.product.update', ['id' => $product->id]) }}"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                    data-desc="{{ $product->desc }}" data-image="{{ $product->image }}"
                                                    data-image_path={{ $product->image && $product->image != '' ? asset('/uploads/product/' . $product->image) : asset('/image/no-image.gif') }}
                                                    data-price="{{ $product->price }}" data-status={{ $product->status }}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </button>
                                                <button class="btn-remove"
                                                    data-action="{{ route('admin.product.delete', ['id' => $product->id]) }}">
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
    <!-- Modal  Create -->
    <div class="modal fade" id="modalCreateProduct" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.product.create') }}" role="form" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Name</label>
                            <input type="text" class="form-control product_name" name="product[name]" />
                        </div>
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Image</label>
                            <div class="product_image_input">
                                <input type="file" accept="image/*" name="image">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="product_desc" class="form-label">Description</label>
                            <textarea id="product_desc" class="form-control" name="product[desc]" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="product[price]" value="25000"
                                id="product_price">
                        </div>
                        <div class="form-check form-switch status mb-3">
                            <label for="product_status" class="form-label">Status</label>
                            <div class="status_input">
                                <input class="form-check-input" type="checkbox" value="1" id="product_status"
                                    name="product[status]" checked />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal  Create -->
    <div class="modal fade" id="modalUpdateProduct" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" role="form" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Name</label>
                            <input type="text" class="form-control product_name" name="product[name]" />
                        </div>
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Image</label>
                            <div class="product_image_input">
                                <input type="file" accept="image/*" name="image" />
                            </div>
                            <div class="product_image_view mt-2">
                                <div class="main-view">
                                    <img src="" alt="image" />
                                </div>
                            </div>
                            <input type="hidden" name="product[image]" class="product_image" />
                        </div>
                        <div class="mb-3">
                            <label for="product_desc" class="form-label">Description</label>
                            <textarea class="form-control product_desc" name="product[desc]" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Price</label>
                            <input type="number" class="form-control product_price" name="product[price]"
                                value="25000" />
                        </div>
                        <div class="form-check form-switch status mb-3">
                            <label for="product_status" class="form-label">Status</label>
                            <div class="status_input">
                                <input class="form-check-input product_status" type="checkbox" value="1"
                                    name="product[status]" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form action="" id="form-remove-product" role="fomr" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
