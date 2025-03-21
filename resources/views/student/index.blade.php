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
    <h1>{{$student->fName}}</h1>
    <table class="table table-striped">
        <tr>
            <th>Subject</th>
            <th>Semester One</th>
            <th>Semester Two</th>
            <th>Semester Three</th>
        </tr>
        @foreach ($subjects as $subject)
            <tr>
                <td>{{$subject->subjectName}}</td>
                <td>
                    @foreach ($gradeSubjectTerms as $gradeSubjectTerm)
                        @if ($subject->subjectID === $gradeSubjectTerm[1] && $gradeSubjectTerm[2] === 1)
                            {{$gradeSubjectTerm[0]}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($gradeSubjectTerms as $gradeSubjectTerm)
                        @if ($subject->subjectID === $gradeSubjectTerm[1] && $gradeSubjectTerm[2] === 2)
                            {{$gradeSubjectTerm[0]}}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($gradeSubjectTerms as $gradeSubjectTerm)
                        @if ($subject->subjectID === $gradeSubjectTerm[1] && $gradeSubjectTerm[2] === 3)
                            {{$gradeSubjectTerm[0]}}
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>