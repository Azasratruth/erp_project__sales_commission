@extends('layouts.app')
<style>
    .btn-grouped{
        justify-content: center;
    }
    .inner-group{
        display: inline-block;
        padding: 10px;
        width:47%;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Employee Sales Commissions Plan Dashboard') }}</div>

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
                                <th scope="col">User Name</th>
                                <th scope="col">Total Sales</th>
                                <th scope="col">Commission Amount</th>
                            </thead>
                            <tbody class="table-striped">

                                {{-- Rows --}}
                                @foreach($users_commissions as $commission)
                                <tr scope="row">
                                    <td>{{ $commission['user_name'] }}</td>
                                    <td>{{ $commission['total_sales'] }}</td>
                                    <td>{{ $commission['commission'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br>
                        
                        <div class="mb-3">
                            @if($plan->approved)
                            <p>Approved by {{$approver->name}} ({{$role_of_approver}}).</p>
                            @else
                            <p>Rejected by {{$approver->name}} ({{$role_of_approver}}).</p>
                            @endif
                        </div>
                        <br>

                        @if($to_be_approved)
                        <div class="mb-3 btn-grouped">
                            <div class="inner-group">
                                <button type="button" class="form-control btn btn-success" onclick="location.href = '/commission_amount/{{$plan->id}}/1';">Approve Plan</button>
                            </div>
                            
                            <div class="inner-group">
                                <button type="button" class="form-control btn btn-danger" onclick="location.href = '/commission_amount/{{$plan->id}}/0';">Reject Plan</button>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection