@extends('layouts.app')

@section('content')
    
    <script>
        var searchUrl   = "{{route('departments.search')}}";
    </script>

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <a class="btn btn-success float-end" data-bs-toggle="modal" id="mediumButton" data-bs-target="#addModal">Add Department</a>
            </div>
        </div>

        @include('alerts.errors')
        @include('alerts.success')

        
        <div class="card-body">

            @include('components.search-bar')

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Total Employees</th>
                        <th>Total Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $dept)
                    <tr>
                        <td>{{$dept->title}}</td>
                        <td>{{$dept->description}}</td>
                        <td>{{$dept->employees_count}}</td>
                        <td>{{$dept->employees_sum_salary}}</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-success edit" data-bs-toggle="modal" data-bs-target="#editModal" data-dept="{{$dept}}">Edit</a>
                            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="{{$dept->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $departments->links() }}

        </div>
    </div>

    @include('modals.add-department')
    @include('modals.edit-department')
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
                let url = "{{route('departments.destroy',':id')}}";
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
            let dept  = e.target.getAttribute('data-dept');
            dept  = JSON.parse(dept);
            let url = "{{route('departments.update',':id')}}";
            url = url.replace(':id', dept.id);
            document.querySelector('#edit-form').setAttribute('action', url)
            document.querySelector('#title').value          = dept.title
            document.querySelector('#description').value    = dept.description
        }
    </script>
@endsection