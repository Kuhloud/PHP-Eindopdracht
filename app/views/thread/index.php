<?php include ('./header.php') ?>
<title><?= $_SESSION['currentthread']->getTitle()?> - Inholland Forum</title>
<script src="../../javascript/boardthread.js"></script>
<section class="container">
    <article class="row">
        <header class="col-12">
            <h2><?= $_SESSION['currentthread']->getTitle()?></h2>
        </header>
    </article>
</section>
<section id="posts">
</section>
<section class="card-body">
    <form id="createThread" onsubmit="event.preventDefault()">
        <section class="mb-3">
            <label for="postMessage" class="form-label">Enter Message:</label>
            <textarea name="postMessage" class="form-control" id="post" rows="6"></textarea>
        </section>
        <button type="submit" onclick="createPost(<?= $_SESSION['idForController'] ?>, <?= $_SESSION['user'] ?>)" class="btn btn-primary">Post</button>
    </form>
</section>
<?php include ('./footer.php') ?>