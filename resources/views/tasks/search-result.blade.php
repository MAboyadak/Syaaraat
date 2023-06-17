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