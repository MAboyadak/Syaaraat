<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title">Add New Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="POST" action="{{route('tasks.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group my-2">
                    <label class="my-1" for="">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group my-2">
                    <label class="my-1" for="">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <div class="form-group my-2">
                  <label class="my-1" for="">Employee</label>
                  <select type="text" name="employee_id" class="form-select">
                      <option value="0" selected>Choose Employee:</option>
                    
                      @foreach ($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->first_name}} {{$employee->last_name}} ({{$employee->phone}})</option>                        
                      @endforeach

                  </select>
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