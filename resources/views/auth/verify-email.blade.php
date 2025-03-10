<h1>Please verify email through the email we've sent you.</h1>
<p>Didn't get the email?</p>
<form action="{{ route('verification.send') }}" method="POST">
    @csrf
    <button type="submit">Send again</button>
</form>