@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Sales Commissions Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{-- Table --}}
                    <table class="table table-bordered table-hover">
                        <caption>Sales Commissions</caption>
                        <thead class="thead-dark">
                            <th scope="col">Sales Quota</th>
                            <th scope="col">Percentage</th>
                            <th scope="col">Confirm / Delete</th>
                        </thead>
                        <tbody class="table-striped">
                            @foreach($sales_comms as $sales_comm)
                            <tr scope="row">
                                <td>{{ $sales_comms }}</td>
                                <td>
                                  
                                </td>
                                <td>
                                    <a type="button" class="form-control btn btn-primary"
                                        {{-- href="/assign_roles/{{$user->id}}/" --}}
                                        onclick="location.href=this.href+role;return false;">Confirm</a>
                                </td>
                            </tr>
                            @endforeach
                            <tr scope="row">
                                <td>
                                    <input id="sales_amount" type="number" min="0" max="1000000" placeholder="0000"
                                    class="form-control @error('sales_amount') is-invalid @enderror" name="sales_amount"
                                    value="{{ old('sales_amount')}}">
                                    
                                    @error('sales_amount')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                <td>
                                    <input id="percentage" type="number" min="0" max="100" placeholder="00"
                                    class="form-control @error('percentage') is-invalid @enderror" name="percentage"
                                    value="{{ old('percentage')}}">
                                    
                                    @error('percentage')
                                    <span class="invalid-feeback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                <td>
                                    <a type="button" class="form-control btn btn-primary"
                                        {{-- href="/assign_roles/{{$user->id}}/" --}}
                                        onclick="location.href=this.href+role;return false;">Confirm</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var role = '';

    function role_function(e) {
        role = e;
    }
</script>

@endsection