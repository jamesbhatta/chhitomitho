@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4">
                    <h5 class="page-title align-self-center">Users</h5>
                    <div class="ml-auto">
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-sm z-depth-0">Add New</a>
                    </div>
                </div>
                @include('partials.alerts')
            </div>
            <div class="col-md-12">
                <div class="d-flex">
                    <div class="mr-auto">
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-primary btn-md m-0 px-3 py-2 z-depth-0 rounded-0 dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-filter pr-2"></i> Admin</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('users.index') }}">All</a>
                                <div role="separator" class="dropdown-divider"></div>
                                @foreach(config('constants.ROLES') as $key => $role)
                                <a class="dropdown-item" href="{{ route('users.index') }}?role={{ $key}}">{{ $role }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <form action="{{ route('users.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="search_term" class="form-control rounded-0" value="{{ $searchTerm }}" placeholder="Search. . . " aria-label="Search. . ."
                                aria-describedby="product-search-btn">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-md btn-primary rounded-0 m-0 px-3 py-2 z-depth-0 waves-effect" id="product-search-btn"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="my-3"></div>
    <table class="table custom-table white card-shadow">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Mobile</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if( count($users) )
            @foreach ($users as $user)
            <tr>
                <td>
                    <img src="{{ $user->gravatar }}" alt="" style="height: 40px; width: 40px;">
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-capitalize">{{ $user->role }}</td>
                <td>{{ $user->mobile }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="edit-link" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a> | 
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="form d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="del-user-btn del-btn" data-toggle="tooltip" title="Delete"><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5">
                    <div class="text-center font-italic">No Users found.</div>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    
    @if($users->hasPages())
    <div class="d-flex">
        <div class="ml-auto">
            {{ $users->links() }}
        </div>
    </div>
    @endif
    
</div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('.del-user-btn').click(function () {
            var ch = confirm ('Are you absolutely sure you want to delete?');
            if(ch == true) {
                return true;
            }
            return false;
        });
    });
</script>
@endpush