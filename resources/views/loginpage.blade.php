<h1>Login Page </h1>

<form method="POST">
    @csrf
    <input type="text" name="username" placeholder="Enter Username"><br><br>
    <input type="password" name="password" placeholder="Enter Password"><br><br>
    <button type="submit" formaction="login">Login</button>
</form>
<a href="search">
    <button>Search Vehicle</button>
</a>
