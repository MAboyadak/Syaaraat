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