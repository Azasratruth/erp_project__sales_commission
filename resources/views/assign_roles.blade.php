@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Assign Roles Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{-- Table --}}
                    <table class="table table-bordered table-hover">
                        <caption>Users Without Roles</caption>
                        <thead class="thead-dark">
                            <th scope="col">Username</th>
                            <th scope="col">Assign Role</th>
                            <th scope="col">Confirm</th>
                        </thead>
                        <tbody class="table-striped">
                            @foreach($users as $user)
                            <tr scope="row">
                                <td>{{ $user->name }}</td>
                                <td>
                                    <select class="form-select form-control form-select-lg mb-3"
                                        aria-label="Select Role" name="roles" id="roles"
                                        onchange="role_function(this.value)">
                                        <option selected>Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role}}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <a type="button" class="form-control btn btn-primary"
                                        href="/assign_roles/{{$user->id}}/"
                                        onclick="location.href=this.href+role;return false;">Confirm</a>
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

<script>
    var role = '';

    function role_function(e) {
        role = e;
    }
</script>

@endsection