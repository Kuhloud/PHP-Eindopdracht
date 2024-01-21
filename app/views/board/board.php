<?php include ('./header.php'); ?>
<title><?= $board->getBoardName()?> - Inholland Forum</title>
<section class="container">
    <article class="row">
        <header class="col-12">
            <h2><?= $board->getBoardName()?></h2>
            <p><?= $board->getBoardDescription()?></p>
            <button type="button" class="btn btn-primary" onclick="ProcessThread(<?= $board->getId()?>)">Create Thread</button>
        </header>
    </article>
</section>
<?php include ('./footer.php'); ?>