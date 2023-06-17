<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title">Add New Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="POST" action="{{route('employees.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group my-2">
                    <label class="my-1" for="">First Name</label>
                    <input type="text" name="first_name" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Last Name</label>
                    <input type="text" name="last_name" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Salary</label>
                    <input type="number" name="salary" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Role</label>
                    <select type="text" name="role" class="form-select">
                        <option value="0" selected>Choose Role:</option>
                        <option value="manager">Manager</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Department</label>
                    <select type="text" name="department_id" class="form-select">
                        <option value="0" selected>Choose Department:</option>
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->title}}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Manager</label>
                    <select type="text" name="manager_id" class="form-select">
                        <option value="0" selected>Choose Manager:</option>
                        @foreach ($managers as $manager)
                            <option value="{{$manager->id}}">{{$manager->first_name}} {{$manager->last_name}}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class=" my-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary mx-3" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

      </div>
    </div>
</div>