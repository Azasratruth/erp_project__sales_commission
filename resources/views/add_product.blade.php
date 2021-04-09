@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form method="POST" action="{{ url('/add_product')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Add Product') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="container-sm">

                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" minlength="0" maxlength="40" class="form-control" id="name" name="name" placeholder="xyz" required>
                            </div>

                            <div class="mb-3">
                                <label for="cost" class="form-label">Product Cost</label>
                                <input type="number" min="0" max="18446744073709551615" class="form-control" id="cost" name="cost" placeholder="000" required>
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