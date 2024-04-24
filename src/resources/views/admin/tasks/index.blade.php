@extends('admin.layouts.app')

@section('title')
    List of Tasks
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">

                <div class="card">
                    <div class="card-header">
                        <h3>List of tasks</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list_tasks" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Departement Name</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Publish Date</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ \App\Models\Department::find($task->dep_id)->name
                                         }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->content }}</td>
                                        <td>{{ $task->date }}</td>
                                        <td>{{ $task->due_date }}</td>
                                        <td>{{ $task->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td><button class="btn btn-danger" id="delete-task"
                                                data-id='{{ $task->id }}'>Delete</button>
                                            <a href="{{ route('admin.task.edit', ['id' => $task->id]) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#list_tasks').DataTable();
        });

        $(document).on('click', '#delete-task', function(e) {
            e.preventDefault();

            const id = $(this).data('id');
            if (id != "") {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.task.delete') }}",
                    data: {
                        id,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: (data) => {
                        if (data.success == true) {
                            Swal.fire({
						title: 'Success',
						text: data.message,
						icon: 'success',
						confirmButtonText: 'Ok'
					}).then(() => {
						window.location.href = "{{ route('admin.task.list') }}"
					})
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    }
                })
            }
        })
    </script>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#list_tasks').DataTable();
        });

        $(document).on('click', '#delete-task', function(e) {
            e.preventDefault();

            const id = $(this).data('id');
            if (id != "") {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.task.delete') }}",
                    data: {
                        id,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: (data) => {
                        if (data.success == true) {
                            Swal.fire({
						title: 'Success',
						text: data.message,
						icon: 'success',
						confirmButtonText: 'Ok'
					}).then(() => {
						window.location.href = "{{ route('admin.dashboard') }}"
					})
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }
                    }
                })
            }
        })
    </script>
@endsection

