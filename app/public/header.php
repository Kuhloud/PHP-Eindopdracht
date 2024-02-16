<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Forum_Logo.png" sizes="16x16" type="image/png">
    <script src="/app.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body class="text-center">
<header>
    <nav class="navbar navbar-expand-lg sticky-top navbar-dark" style="background-color: #E30380;">
        <section>
        <a class="navbar-brand" href="/">
            <img id="logo" src="/img/Forum_Logo.png" title="Inholland University of Applied Sciences" alt="Inholland Logo">
            InHolland Forum
        </a>
        </section>
        <section class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="navigationBar">
            <li class="nav-item active">
                <a class="nav-link active" aria-current="page" href="/">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/board">
                    Boards
                </a>
            </li>
        </ul>
            <?php
        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            echo '<li class="nav-item">
            <span class="nav-link">Welcome, ' . $_SESSION['username'] . '</span>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    Log out
                </a>
            </li>';
        } else {
            echo '<ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/login">
                    Login
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user">
                    Sign in
                </a>
            </li>
        </ul>';
        }
        ?>
        </section>
    </nav>
</header>