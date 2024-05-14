@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/accountCreation.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'accountCreation' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')
<style>

.btn-danger {
    background-color: black; 
    color: white;
    border: gray;
}

.btn-complete {
    background-color: red; 
    color: white;
    border: gray;
} 

.btn-warning {
    background-color: orange; 
    color: white;
    border: gray;
} 

.btn-success {
    color: white;
} 
.btn-success:hover {
    background-color: white;
    color: black;
}



</style>
<div class="pt-18vh">
    <section class="container mt-5 mt-md-0 pt-5 pt-md-0">
        <div class="row d-flex justify-content-center" id="top-bar">
            <div class="col-md-2" id="title">
                <label>Manage Accounts</label>
            </div>
        </div>

        <div class="container">
            <h2 class="mb-4">Accounts</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact No.</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $users)
                    <tr>
                        <th scope="row">{{ $users->id }}</th>
                        <td>{{ $users->role }}</td>
                        <td></td>
                        <td>{{ $users->name }}</td>
                        <td>{{ $users->email }}</td>
                        <td>{{ $users->contactnum }}</td>
                        <td>
                            <a href="{{ route('user.update', ['id' => $users->id]) }}" class="btn btn-success btn-{{ $users->status ? 'success' : 'danger' }}">
                                {{ $users->status ? 'Enable' : 'Disable' }}
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $users->id }}">Edit</button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $users->id }}">Delete</button>
                        </td>
                    </tr>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $users->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $users->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $users->id }}">Edit Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('user.saveChanges', ['id' => $users->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="contactnum" class="form-label">Contact Number</label>
                                            <input type="text" class="form-control" id="contactnum" name="contactnum" value="{{ $users->contactnum }}">
                                        </div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-complete">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Edit Modal -->


                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $users->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $users->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $users->id }}">Delete Account</h5>
                                   
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this account?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('user.delete', ['id' => $users->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Delete Modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>


@endsection