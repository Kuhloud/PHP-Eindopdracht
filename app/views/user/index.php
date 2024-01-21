<?php include ('./header.php'); ?>
<title>Login - Inholland Forum</title>
<section id="login">
    <form action="index.php" method="POST" class="form-signin"> 
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="input" class="sr-only">Enter Username or Email address</label>
        <input type="username" id="input" class="form-control" placeholder="Enter Username/Email address" required="" autofocus="" wfd-id="id0">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Enter Password" required="" wfd-id="id1">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
</section>
<?php include ('./footer.php'); ?>