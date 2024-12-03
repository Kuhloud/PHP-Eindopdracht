<?php include ('./header.php') ?>
<title><?= $_SESSION['currentthread']->getTitle()?> - Inholland Forum</title>
<script src="../../javascript/thread.js"></script>
<section class="container">
    <article class="row">
        <header class="col-12">
            <h2><?= $_SESSION['currentthread']->getTitle()?></h2>
        </header>
    </article>
</section>
<?php
foreach($model as $board) {
    ?>
    <section class="card">
        <article class="card-body">
            <h4 class="card-title"><?= ucfirst($board->getBoardName())?></h4>
            <p class="card-text"><?= $board->getBoardDescription()?></p>
            <small  class="card-subtitle mb-2 text-muted">Threads in totaal: <?= $board->getTotalThreads()?></small>
            <small  class="card-subtitle mb-2 text-muted">Berichten in totaal: <?= $board->getTotalMessages()?></small>
        </article>
    </section>
    <?php
}
?>
<section class="card-body">
    <form id="createThread" onsubmit="event.preventDefault()">
        <section class="mb-3">
            <label for="postMessage" class="form-label">Enter Message:</label>
            <textarea name=postMessage" class="form-control" id="firstPost" rows="6"></textarea>
        </section>
        <button type="submit" onclick="createPost()" class="btn btn-primary">Post</button>
    </form>
</section>
<?php include ('./footer.php') ?>