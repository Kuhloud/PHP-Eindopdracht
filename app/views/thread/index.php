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
<section id="posts" class="card">
</section>
<?php if (isset($_SESSION['user_id'])) : ?>
<section class="card-body">
    <form id="createPost" onsubmit="event.preventDefault()">
        <section class="mb-3">
            <label for="postMessage" class="form-label">Enter Message: <?= $_SESSION['user_id'] ?></label>
            <textarea id="postMessage" class="form-control" id="firstPost" rows="6"></textarea>
        </section>
        <button type="submit" onclick="createPost(<?= $_SESSION['thread_id'] ?>, <?= $_SESSION['user_id'] ?>)" class="btn btn-primary">Post</button>
    </form>
</section>
<?php endif; ?>
<?php include ('./footer.php') ?>