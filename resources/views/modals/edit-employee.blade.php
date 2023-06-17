<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title">Edit Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="POST" id="edit-form" action="" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group my-2">
                    <label class="my-1" for="">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Salary</label>
                    <input type="number" id="salary" name="salary" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Role</label>
                    <select type="text" id="role" name="role" class="form-select">
                        <option value="0"  selected>Employee Role:</option>
                        <option value="manager">Manager</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Department</label>
                    <select type="text" name="department_id" class="form-select">
                        <option value="0" id="department_id" selected>Choose Department:</option>
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->title}}</option>                            
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Manager</label>
                    <select type="text" id="manager_id" name="manager_id" class="form-select">
                        <option value="0" selected>Manager:</option>
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