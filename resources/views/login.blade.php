

<div style="display:flex; align-items: center; justify-content:center;" >
    <h2> User Login </h2>
    <br>
    
</div>


<div style="display:flex; align-items: center; justify-content:center;" >
    <form action='user_login' method='POST'>
        @csrf
        <label for="email">Email: &emsp;</label>
        <input size="50" type="email" name='email' placeholder="example@abc.com"> <br><br>
        <label for="password">Password:</label>
        <input  size="50" type="password" name='password' placeholder="password"> <br><br>
        <button type="submit"> Login </button>  
    </form>
</div>


