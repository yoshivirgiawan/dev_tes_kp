@extends('layouts.app')

@section('optional-css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.alert-message')

            <div class="card">
                <div class="card-header px-5 py-4">{{ __('Task Lists') }}</div>

                <form action="{{ route('create') }}" method="POST">
                    @csrf
                    <div class="add-items row px-5 py-4">
                        <div class="col-lg-5 pr-0 mb-2">
                            <input type="text" id="input-name" name="name" class="form-control todo-list-input" placeholder="Add new ...">
                            @error('name')
                                <span class="d-block invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-5 pr-0 mb-2">
                            <input type="datetime-local" id="input-execution-time" name="execution_time" class="form-control todo-list-input" value="{{ date('Y-m-d\TH:i', strtotime('now')) }}">
                            @error('execution_time')
                                <span class="d-block invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-2 pr-0 mb-2">
                            <button type="submit" class="add btn btn-primary font-weight-bold todo-list-add-btn m-0 w-100 h-100">Add</button>
                        </div>
                    </div>
                </form>

                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($tasks as $task)
                            <li class="list-group-item px-5 py-4 d-flex">
                                <div class="todo-indicator bg-warning"></div>
                                <div class="widget-content w-100 p-0">
                                    <div class="widget-content-wrapper d-flex justify-content-between">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">{{ $task->name }}</div>
                                            <div class="widget-subheading">
                                                <i class="text-capitalize">By {{ $task->user->name }} - {{ \Illuminate\Support\Carbon::parse($task->execution_time)->format('d F Y H:i:s') }}</i>
                                            </div>
                                        </div>
                                        <div class="widget-content-right">
                                            <button class="edit-button border-0 btn-transition btn btn-outline-success" data-id="{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <button class="delete-button border-0 btn-transition btn btn-outline-danger" data-id="{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
                                            
<!-- Delete Modal -->
<div id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="icon-box d-flex justify-content-center align-items-center">
                    <i class="bi bi-x m-0"></i>
                </div>
                <h4 class="modal-title w-100">Are you sure?</h4>	
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this task? This process cannot be undone.</p>
            </div>
            <div class="modal-footer modal-footer-delete justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-confirm w-500">
        <div class="modal-content text-start">
            <div class="modal-header flex-column">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
                <h4 class="modal-title text-start w-100">Edit Task</h4>
            </div>
            
            <form method="post">
                @method('patch')
                @csrf
                <div class="modal-body">
                    <div class="my-4">
                        <input type="text" id="edit-name" name="name" class="form-control todo-list-input" required>
                    </div>
                    <div class="my-4">
                        <input type="datetime-local" id="edit-execution-time" name="execution_time" class="form-control todo-list-input" required>
                    </div>
                </div>
                <div class="modal-footer modal-footer-delete justify-content-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('optional-js')
    <script>
        $('.delete-button').on("click",function() {
            let id = $(this).attr('data-id');
            console.log(id);
            $('#deleteModal').find('form').attr('action', `/${id}/delete`);
            $('#deleteModal').modal('show');
        });

        $('.edit-button').on("click",function() {
            let id = $(this).attr('data-id');
            $.ajax({
                url : `/${id}/edit`,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('#edit-name').val(data.name);
                    $('#edit-execution-time').val(data.execution_time);
                    $('#editModal').find('form').attr('action', `/${id}/update`);
                    $('#editModal').modal('show');
                }
            });
        });
    </script>
@endsection