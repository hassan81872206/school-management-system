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
    <h1>Create Student</h1>
    <div style="padding: 10px" class="w-50">
        <form action="{{route('students.store')}}" method="POST">
            @csrf
            <div class="mb-3" >
              <label for="exampleInputEmail1" class="form-label">First Name</label>
              @error('fName')
                  <span style="color: red">{{$message}}</span>
              @enderror
              <input value="{{old('fName')}}" type="text" name="fName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                @error('lName')
                  <span style="color: red">{{$message}}</span>
                @enderror
                <input value="{{old('lName')}}" type="text" name="lName" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Father</label>
                @error('father')
                  <span style="color: red">{{$message}}</span>
                @enderror
                <input value="{{old('father')}}" type="text" name="father" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mother</label>
                @error('mother')
                  <span style="color: red">{{$message}}</span>
              @enderror
                <input value="{{old('mother')}}" type="text" name="mother" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Address</label>
                @error('address')
                  <span style="color: red">{{$message}}</span>
              @enderror
                <input value="{{old('address')}}" type="text" name="address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone</label>
                @error('phone')
                  <span style="color: red">{{$message}}</span>
              @enderror
                <input value="{{old('phone')}}" type="tel" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Birthdate</label>
                @error('birthdate')
                  <span style="color: red">{{$message}}</span>
              @enderror
                <input value="{{old('birthdate')}}" type="date" name="birthdate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                @error('email')
                  <span style="color: red">{{$message}}</span>
              @enderror
                <input value="{{old('email')}}" type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              @error('password')
                  <span style="color: red">{{$message}}</span>
              @enderror
              <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <label for="exampleInputPassword1" class="form-label">Gender</label>
            @error('genderID')
                  <span style="color: red">{{$message}}</span>
              @enderror
            <select name="genderID" class="form-select" aria-label="Default select example">
                @foreach ($genders as $gender)
                    <option value="{{$gender->genderID}}">{{$gender->genderName}}</option>
                @endforeach
            </select>
            <label for="exampleInputPassword1" class="form-label">Nationality</label>
            @error('nationalityID')
                  <span style="color: red">{{$message}}</span>
              @enderror
            <select name="nationalityID" class="form-select" aria-label="Default select example">
                @foreach ($nationalities as $nationalitie)
                    <option value="{{$nationalitie->nationalityID}}">{{$nationalitie->nationalityName}}</option>
                @endforeach
            </select>
            <label for="exampleInputPassword1" class="form-label">Classe</label>
            @error('classeID')
                  <span style="color: red">{{$message}}</span>
            @enderror
            <select name="classeID" class="form-select" aria-label="Default select example">
                @foreach ($classes as $classe)
                    <option value="{{$classe->classeID}}">{{$classe->roomNbr}}</option>
                @endforeach
            </select>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            @if (session('error'))
                <p style="color: red">{{session("error")}}</p>                
            @endif
          </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>