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
        <td>{{$emp->department->title}}</td>
        <td>{{$emp->manager?->first_name}} {{$emp->manager?->last_name}}</td>
        <td>
            <a href="javascript:void(0);" class="btn btn-success edit" data-bs-toggle="modal" data-bs-target="#editModal" data-emp="{{$emp}}">Edit</a>
            <a href="javascript:void(0);" class="btn btn-danger delete" data-id="{{$emp->id}}">Delete</a>
        </td>
    </tr>
    @endforeach
</tbody>