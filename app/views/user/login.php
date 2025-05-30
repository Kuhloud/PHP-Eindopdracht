<?php include ('./header.php') ?>
<title>Login - Inholland Forum</title>
<section>
    <form method="POST" class="form-signin"> 
        <h1 class="h3 mb-3 font-weight-normal">Login</h1>
        <?php if(isset($errorMessage) && !empty($errorMessage)): ?>
            <p class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($errorMessage); ?>
            </p>
        <?php endif; ?>
        <label for="username" class="sr-only">Enter Username/Email address</label>
        <input type="username" name="UserInput" id="username" class="form-control" placeholder="Enter Username/Email address">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="UserPassword" id="password" class="form-control" placeholder="Enter Password" >
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
</section>
<?php include ('./footer.php') ?>