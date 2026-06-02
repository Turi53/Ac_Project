<div>
    <h1>Register</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" class="">

        <label for="email">Email:</label>
        <input type="email" name="email" class="">

        <label for="password">Enter Password:</label>
        <input type="password" name="password" class="">

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" class="">

        <input type="submit" value="Register">
    </form>

    <div class="">
        @if($errors->any())
            <ul>
                {{ implode('', $errors->all(':message')) }}
            </ul>
        @endif
    </div>
</div>
