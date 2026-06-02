<div>
    <h1>Login</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" class="">

        <label for="password">Enter Password:</label>
        <input type="password" name="password" class="">

        <input type="submit" value="Login">
    </form>

    <div class="">
        @if($errors->any())
            <ul>
                {{ implode('', $errors->all(':message')) }}
            </ul>
        @endif
    </div>
</div>
