@extends('layouts.app')

@section('content')

    <script>
        var searchUrl   = "{{route('tasks.search')}}";
    </script>
    
    <div class="card">
        @can('add-task')
        <div class="card-header">
            <div class="card-title">
                <a class="btn btn-success float-end" data-bs-toggle="modal" id="mediumButton" data-bs-target="#addModal">Add Task</a>
            </div>
        </div>
        @endcan

        @include('alerts.errors')
        @include('alerts.success')

        
        <div class="card-body">
            
            @include('components.search-bar')

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Employee</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    @can('view-edit-task', $task)
                        <tr>
                            <td>{{$task->title}}</td>
                            <td>{{$task->description}}</td>
                            <td>{{$task->employee->first_name}} {{$task->employee->last_name}}</td>
                            <td>{{$task->status}}</td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-success edit" data-bs-toggle="modal" data-bs-target="#editModal" data-task="{{$task}}">Edit</a>
                                @can('delete-task', $task)
                                    <a href="javascript:void(0);" class="btn btn-danger delete" data-id="{{$task->id}}">Delete</a>
                                @endcan
                            </td>
                        </tr>
                    @endcan
                    @endforeach
                </tbody>
            </table>
            {{ $tasks->links() }}

        </div>
    </div>

    @include('modals.add-task')
    @include('modals.edit-task')
@endsection
@section('scripts')
    <script>
        let delBtns = document.querySelectorAll('.delete');
        delBtns.forEach(btn => {
            btn.addEventListener('click', delModel);
        });

        function delModel(e){
            if(confirm('are you sure you want to delete ?')){
                let id  = e.target.getAttribute('data-id');
                let url = "{{route('tasks.destroy',':id')}}";
                url = url.replace(':id', id);
                let _token = document.querySelector('input[name="_token"]').value;
                // console.log(_token);
                fetch(url, {
                    method:'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': _token
                    }
                }).then(resp => location.reload());
            }
        }
    </script>
    <script>
        let editBtns = document.querySelectorAll('.edit');
        editBtns.forEach(btn => {
            btn.addEventListener('click', editModel);
        });

        function editModel(e){
            let task  = e.target.getAttribute('data-task');
            task  = JSON.parse(task);
            let url = "{{route('tasks.update',':id')}}";
            url = url.replace(':id', task.id);
            document.querySelector('#edit-form').setAttribute('action', url);
            document.querySelector('#title').value          = task.title;
            document.querySelector('#description').value    = task.description;
            
            statusOpts = document.querySelector('#status').options;
            for(let i=0; i<statusOpts.length; i++){
                if(statusOpts[i].value == task.status){
                    statusOpts[i].selected = true;
                    break;
                }
            }
        }
    </script>
@endsection