<?php include ('./header.php') ?>
<title><?= $board->getBoardName()?> - Inholland Forum</title>
<section class="container">
    <article class="row">
        <header class="col-12">
            <h2><?= $board->getBoardName()?></h2>
            <p><?= $board->getBoardDescription()?></p>
            <a class="btn btn-primary" href="/board/<?php echo urlencode($board->getBoardName()); ?>/thread" role="button">Create Thread</a>
        </header>
    </article>
</section>
<?php include ('./footer.php') ?>