<?php include ('./header.php') ?>
<title>Sign up - Inholland Forum</title>
<section id="signup">
    <form action="index.php" method="POST" class="form-signin"> 
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="username" class="sr-only">Enter Username</label>
        <input type="username" name="inputUsername" id="username" class="form-control" placeholder="Enter Username" required="" autofocus="" wfd-id="id0">
        <label for="email" class="sr-only">Enter Email address</label>
        <input type="email" name="inputEmail" id="email" class="form-control" placeholder="Enter Email address" required="" autofocus="" wfd-id="id0">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="inputPassword" id="password" class="form-control" placeholder="Enter Password" required="" wfd-id="id1">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
        <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
</section>
<?php include ('./footer.php') ?>