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
                                @if(!is_null($plan) && $plan->approved && strcmp($role_of_approver, "sales_manager") == 0)
                                <th scope="col">Approve</th>
                                <th scope="col">Reject</th>
                                @endif
                            </thead>
                            <tbody class="table-striped">

                                {{-- Rows --}}
                                @foreach($users_commissions as $commission)
                                <tr scope="row">
                                    <td>{{ $commission['user_name'] }}</td>
                                    <td>{{ $commission['total_sales'] }}</td>
                                    <td>{{ $commission['commission'] }}</td>

                                    @if(!is_null($plan) && $plan->approved && strcmp($role_of_approver, "sales_manager") == 0)
                                    <td>
                                        <a type="button" class="form-control btn btn-success"
                                            href="/sales_commissions_execute/{{ $plan->id }}/{{ count($users_commissions) }}/{{ $commission['user_id'] }}/{{ $commission['commission_id'] }}/{{ $commission['commission'] }}/1">Approve</a>
                                    </td>
                                    <td>
                                        <a type="button" class="form-control btn btn-danger"
                                            href="/sales_commissions_execute/{{ $plan->id }}/{{ count($users_commissions) }}/{{ $commission['user_id'] }}/{{ $commission['commission_id'] }}/{{ $commission['commission'] }}/0">Reject</a>
                                    </td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br>
                        
                        <div class="mb-3">
                            @if(!is_null($plan) && $plan->approved)
                            <p>Approved by {{$approver->name}} ({{$role_of_approver}}).</p>
                            @else
                            <p>Rejected by {{$approver->name}} ({{$role_of_approver}}).</p>
                            @endif
                        </div>
                        <br>

                        {{-- @if($to_be_approved)
                        <div class="mb-3 btn-grouped">
                            @if($plan->approved_by_id == request()->user()->id)
                            <div class="inner-group">
                                <button type="button" class="form-control btn btn-outline-success" onclick="location.href = '/commission_amount/{{$plan->id}}/1';">Approve Plan</button>
                            </div>
                            
                            <div class="inner-group">
                                <button type="button" class="form-control btn btn-outline-danger" onclick="location.href = '/commission_amount/{{$plan->id}}/0';">Reject Plan</button>
                            </div>
                            @else
                            <div class="inner-group">
                                <button type="button" class="form-control btn btn-success" onclick="location.href = '/commission_amount/{{$plan->id}}/1';">Approve Plan</button>
                            </div>
                            
                            <div class="inner-group">
                                <button type="button" class="form-control btn btn-danger" onclick="location.href = '/commission_amount/{{$plan->id}}/0';">Reject Plan</button>
                            </div>
                            @endif
                        </div>
                        @endif --}}

                    </div>
                </div>
        </div>
    </div>
</div>
@endsection