@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ url('/sales_commission')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Sales Commissions Plan Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        @if(empty($commissions))
                        <p>No Draft of Commission Plan found For this Quarter.</p>
                        <br>
                        @endif

                        {{-- Table --}}
                        <table class="table table-bordered table-hover">
                            <caption>Sales Commissions</caption>
                            <thead class="thead-dark">
                                <th scope="col">Sales Quota</th>
                                <th scope="col">Percentage</th>
                                @if(!is_null($plan) && !$plan->approved)
                                <th scope="col">Add / Remove</th>
                                @endif
                            </thead>
                            <tbody class="table-striped">

                                {{-- Rows --}}
                                @foreach($commissions as $commission)
                                <tr scope="row">
                                    <td>{{ $commission->sales_quota }}</td>
                                    <td>{{ $commission->commission_percentage }}</td>

                                    @if(!is_null($plan) && !$plan->approved)
                                    <td>
                                        <a type="button" class="form-control btn btn-danger"
                                            href="/sales_commission/{{$commission->id}}/">Remove</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach

                                @if(!is_null($plan) && !$plan->approved)
                                {{-- Insert --}}
                                <tr scope="row">
                                    <td>
                                        <input id="sales_amount" type="number" min="0" max="1000000" placeholder="0000"
                                            class="form-control @error('sales_amount') is-invalid @enderror"
                                            name="sales_amount" value="{{ old('sales_amount')}}" required>

                                        @error('sales_amount')
                                        <span class="invalid-feeback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input id="percentage" type="number" min="0" max="100" placeholder="00"
                                            class="form-control @error('percentage') is-invalid @enderror"
                                            name="percentage" value="{{ old('percentage')}}" required>

                                        @error('percentage')
                                        <span class="invalid-feeback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <button type="submit" class="form-control btn btn-success">Add</button>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>


                        @if(!is_null($plan) && !$plan->approved)
                        <br>

                        {{-- Submit --}}
                        <div class="mb-3 row">
                            <button type="button" class="form-control btn btn-primary" onclick="location.href = '/sales_commission_approve/{{$plan->id}}';">Confirm Plan</button>
                        </div>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection