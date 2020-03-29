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
        </div>
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
        
        @if($users->hasMorePages())
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