<form action="/image" method="POST" enctype="multipart/form-data">
    @csrf
    @error('image')
        <span style="color: red">{{$message}}</span>
    @enderror
    <input type="file" name="image" id="">
    <input type="submit" name="" id="">
</form>
<img src="{{asset('storage/images/{{$images->image}}')}}" alt="">
<link rel="stylesheet" href="{{asset('css/app.css')}}">