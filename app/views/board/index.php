<?php include ('./header.php'); ?>
<title>Boards - Inholland Forum</title>
<section class="container">
    <article class="row">
        <header class="col-12">
            <h2>Boards</h2>
            <p>Discussies hier</p>
        </header>
    </article>
</section>
<?php
foreach($model as $board) {
    ?>
    <a href="/board/<?php echo urlencode($board->getBoardName()); ?>" class="clickable-card" >
    <section class="card">
        <article class="card-body">
            <h4 class="card-title"><?= ucfirst($board->getBoardName())?></h4>
            <p class="card-text"><?= $board->getBoardDescription()?></p>
            <small  class="card-subtitle mb-2 text-muted">Threads in totaal: <?= $board->getTotalThreads()?></small>
            <small  class="card-subtitle mb-2 text-muted">Berichten in totaal: <?= $board->getTotalMessages()?></small>
        </article>
    </section>
    </a>
    <?php
}
?>
<?php include ('./footer.php'); ?>

