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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" width="75">#No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" width="200">Order Detail</th>
                                    <th scope="col" width="200">Payment Method</th>
                                    <th scope="col" width="200">Status</th>
                                    <th scope="col" class="text-center" width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
