@extends('layouts.admin')

@section('content')
<div class="p-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4">
                    <h5 class="page-title">Users</h5>
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
                        {{-- <a href="{{ route('product.edit', $product) }}" class="text-muted"><i class="far fa-edit"></i> Edit</a> | 
                        <form action="{{ route('product.destroy', $product) }}" method="POST" class="form d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="del-user-btn btn bg-transparent text-muted z-depth-0 p-0 my-0"><i class="far fa-trash-alt"></i> Delete</button>
                        </form> --}}
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