<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center">Classe : {{$classe->roomNbr}}</h1>
    <h3 class="text-center">Subject : {{$subject->subjectName}}</h3>
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th>Grade</th>
            <th>Term</th>
            <th>Submit</th>
        </tr>
        @error('grade')
            <span style="color: red">{{$message}}</span>
        @enderror
        @foreach ($students as $student)
            <tr>
                <td>{{$student->fName}}</td>
                <form action="/addGrade/{{$student->userID}}/{{$classe->classeID}}/{{$subject->subjectID}}" method="POST">
                    @csrf
                    <td><input type="text" 
                    @foreach ($gradeStudents as $stud)
                        @if ($student->userID === $stud[1] && $stud[2] === $terms[0]->termID)
                            value = {{$stud[0]}}
                            @disabled(true)
                        @endif
                    @endforeach    
                    name="grade" id=""></td>
                    <td><select name="termID" class="form-select" aria-label="Default select example">
                        <option value="{{$terms[0]->termID}}">{{$terms[0]->termName}}</option>  
                    </select></td>
                    <td><input class="btn btn-warning" @foreach ($gradeStudents as $stud)
                        @if ($student->userID === $stud[1]  && $stud[2] === $terms[0]->termID)
                            @disabled(true)
                        @endif
                    @endforeach  type="submit" name="" id=""></td>
                </form>
            </tr>
        @endforeach
    </table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>