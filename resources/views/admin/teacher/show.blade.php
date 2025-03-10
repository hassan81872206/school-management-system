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
   <h1 class="text-center">Teacher</h1>
   <table class="table table-striped">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Father</th>
            <th>Mother</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Birthdate</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Nationality</th>
            {{-- <th>Classe</th> --}}
            {{-- <th>
                Actions
            </th> --}}
        </tr>
        <tr>
            <td>{{$student->fName}}</td>
            <td>{{$student->lName}}</td>
            <td>{{$student->father}}</td>
            <td>{{$student->mother}}</td>
            <td>{{$student->address}}</td>
            <td>{{$student->phone}}</td>
            <td>{{$student->birthdate}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->gender->genderName}}</td>
            <td>{{$student->nationality->nationalityName}}</td>
            {{-- <td>{{$student->classeID}}</td> --}}
            {{-- <td>
                <a href="{{route('students.show' , $student->userID)}}"><button type="button" class="btn btn-info">Show</button></a>
            </td> --}}
        </tr>
        
            
        
   </table> 
   <h1>Classes</h1>
   <table class="table table-striped">
        <tr>
            <th>Name</th>
        </tr>
        @foreach ($classes as $classe)
            <tr>
                <td>{{$classe->roomNbr}}</td>
            </tr>
        @endforeach
   </table> 
   <h1>Subjects</h1>
   <table class="table table-striped">
        <tr>
            <th>Name</th>
        </tr>
        @foreach ($subjects as $subject)
            <tr>
                <td>{{$subject->subjectName}}</td>
            </tr>
        @endforeach
   </table>
 
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>
