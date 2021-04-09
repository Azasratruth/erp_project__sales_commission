@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form method="POST" action="{{ url('/add_sale')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Add Sales') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="container-sm">

                            <div class="mb-3">
                                <label for="user_id" class="form-label">User</label>

                                <select class="form-select form-control form-select-lg mb-3"
                                    aria-label="Select User" name="user_id" id="user_id" required>
                                    <option selected>Select User</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="product_id" class="form-label">Product</label>

                                <select class="form-select form-control form-select-lg mb-3"
                                    aria-label="Select Product" name="product_id" id="product_id" required>
                                    <option selected>Select Product</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" min="0" max="18446744073709551615" class="form-control" id="quantity" name="quantity" placeholder="000" required>
                            </div>


                            <br>

                            {{-- Submit --}}
                            <div class="mb-3 row">
                                <button type="submit" class="form-control btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection