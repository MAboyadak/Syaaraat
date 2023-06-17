@extends('layouts.app')

@section('content')

    <script>
        var searchUrl   = "{{route('employees.search')}}";
    </script>

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <a class="btn btn-success float-end" data-bs-toggle="modal" id="mediumButton" data-bs-target="#addModal">Add Employee</a>
            </div>
        </div>

        @include('alerts.errors')
        @include('alerts.success')

        
        <div class="card-body">
    
            @include('components.search-bar')

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Department</th>
                        <th>Manager</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $emp)
                    <tr>
                        <td>{{$emp->first_name}} {{$emp->last_name}}</td>
                        <td>{{$emp->email}}</td>
                        {{-- <td><img src="{{asset('uploads/{{$emp->Image}}')}}" alt=""></td> --}}
                        <td>
                            @if($emp->image)
                                <img class="td-img" src="{{asset('uploads/' . $emp->image)}}" alt="#">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{$emp->phone}}</td>
                        <td>{{$emp->salary}}</td>
                        <td>{{$emp->department?->title}}</td>
                        <td>{{$emp->manager?->first_name}} {{$emp->manager?->last_name}}</td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-success edit" data-bs-toggle="modal" data-bs-target="#editModal" data-emp="{{$emp}}">Edit</a>
                            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="{{$emp->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $employees->links() }}

        </div>
    </div>

    @include('modals.add-employee')
    @include('modals.edit-employee')
@endsection
@section('scripts')
    <script>
        let delBtns = document.querySelectorAll('.delete');
        delBtns.forEach(btn => {
            btn.addEventListener('click', delEmp);
        });

        function delEmp(e){
            if(confirm('are you sure you want to delete ?')){
                let id  = e.target.getAttribute('data-id');
                let url = "{{route('employees.destroy',':id')}}";
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
            btn.addEventListener('click', editEmp);
        });

        function editEmp(e){
            let emp  = e.target.getAttribute('data-emp');
            emp  = JSON.parse(emp);
            let url = "{{route('employees.update',':id')}}";
            url = url.replace(':id', emp.id);
            document.querySelector('#edit-form').setAttribute('action', url)
            document.querySelector('#first_name').value     = emp.first_name
            document.querySelector('#last_name').value      = emp.last_name
            document.querySelector('#email').value          = emp.email
            document.querySelector('#phone').value          = emp.phone
            document.querySelector('#password').value       = emp.password
            document.querySelector('#salary').value         = emp.salary
            roleOpts = document.querySelector('#role').options;
            for(let i=0; i<roleOpts.length; i++){
                if(roleOpts[i].value == emp.role){
                    roleOpts[i].selected = true;
                    break;
                }
            }

            depsOpts = document.querySelector('#department_id').options;
            for(let i=0; i<depsOpts.length; i++){
                if(depsOpts[i].value == emp.department_id){
                    depsOpts[i].selected = true;
                    break;
                }
            }
            
            managerOpts = document.querySelector('#manager_id').options;
            for(let i=0; i<managerOpts.length; i++){
                if(managerOpts[i].value == emp.manager_id){
                    managerOpts[i].selected = true;
                    break;
                }
            }
        }
    </script>
@endsection