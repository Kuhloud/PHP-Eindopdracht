<?php include ('./header.php') ?>
<title><?= $board->getBoardName()?> - Inholland Forum</title>
<section class="container">
    <article class="row">
        <header class="col-12">
            <h2><?= $board->getBoardName()?></h2>
            <p><?= $board->getBoardDescription()?></p>
            <?php if (isset($_SESSION['username'])) : ?>
             <a href="/board/<?php echo urlencode($board->getBoardName());?>/thread" class="btn btn-primary" role="button">Create Thread</a>
            <?php endif; ?>
        </header>
    </article>
</section>
<?php include ('./footer.php') ?>