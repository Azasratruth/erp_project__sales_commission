@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form method="POST" action="{{ url('/assign_roles')}}">
                @csrf

                <div class="card">
                    <div class="card-header">{{ __('Assign Roles Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="container-sm">

                            @foreach($users as $user)
                            <div class="mb-3 row">
                                <label for="user" class="form-label">User Name</label>
                                
                                <div class="col-sm-10">
                                    <td>{{ $user->name }}</td>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="roles" class="form-label">Select Role</label>
                                
                                <div class="col-sm-10">
                                    <select class=" form-control form-select-lg mb-3"
                                        aria-label="Select Role" name="roles" id="roles">
                                        <option selected>Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role}}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endforeach

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