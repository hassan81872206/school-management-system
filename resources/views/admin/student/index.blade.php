<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
   <h1 class="text-center">Students</h1>
   <h3>Create Student</h3>
   <a href="{{route("students.create")}}"><button type="button" class="btn btn-primary">Create</button></a>
   <table class="table table-striped">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            {{-- <th>Father</th> --}}
            {{-- <th>Mother</th> --}}
            {{-- <th>Address</th> --}}
            <th>Phone</th>
            {{-- <th>Birthdate</th> --}}
            <th>Email</th>
            {{-- <th>Gender</th> --}}
            {{-- <th>Nationality</th> --}}
            <th>Classe</th>
            <th>
                Actions
            </th>
        </tr>
        @forelse ($students as $student)
            <tr meta-data = "tr_{{$student->userID}}">
                <td>{{$student->fName}}</td>
                <td>{{$student->lName}}</td>
                {{-- <td>{{$student->father}}</td> --}}
                {{-- <td>{{$student->mother}}</td> --}}
                {{-- <td>{{$student->address}}</td> --}}
                <td>{{$student->phone}}</td>
                {{-- <td>{{$student->birthdate}}</td> --}}
                <td>{{$student->email}}</td>
                {{-- <td>{{$student->gender->genderName}}</td> --}}
                {{-- <td>{{$student->nationality->nationalityName}}</td> --}}
                <td>{{$student->classeID}}</td>
                <td>
                    <a href="{{route('students.show' , $student->userID)}}"><button type="button" class="btn btn-info">Show</button></a>
                    {{-- <form style="display: inline" action="{{route('students.destroy' , $student->userID)}}" method="POST"> --}}
                        {{-- @csrf --}}
                         {{-- @method("DELETE") --}}
                        <button onclick="deleteStudent({{$student->userID}})" type="button" class="btn btn-danger">Delete</button>
                    {{-- </form> --}}
                </td>
            </tr>
        @empty
            
        @endforelse
   </table> 
   @if (session('success'))
    <div class="alert alert-primary" role="alert">
        {{session('success')}}
    </div>
   @endif
   {{-- @if (session('delete'))
    <div class="alert alert-primary" role="alert">
        {{session('delete')}}
    </div>
   @endif --}}
   <div id="delete" class="alert alert-primary" role="alert">
        
    </div>
   <div>
    {{$students -> links()}}
</div>

</body>
<script>
    function deleteStudent(userID){
        const myHeaders = new Headers();
        myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");

        // const urlencoded = new URLSearchParams();

        const requestOptions = {
        method: "DELETE",
        headers: myHeaders,
        // body: urlencoded,
        // redirect: "follow"
        };
        // console.log(userID);
        fetch(`/students/${userID}`, requestOptions)
        .then((response) => response.json())
        .then((result) => getResponse(result , userID))
        .catch((error) => console.error(error));
    }
    function getResponse(result , userID){
        // console.log(result);
        if(result[0] === 'delete'){
            // console.log("hello");
            let row = document.querySelector(`tr[meta-data='tr_${userID}']`);
            row.remove();
            let deletee = document.getElementById("delete");
            deletee.innerHTML = "Delete Successfuly" ;
            
        }
        
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>

