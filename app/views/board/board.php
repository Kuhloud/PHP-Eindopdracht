<?php include ('./header.php') ?>
<script src="../javascript/board.js"></script>
<title><?= $board->getBoardName()?> - Inholland Forum</title>
<section class="container">
    <article class="row">
        <header class="col-12">
            <h2><?= $board->getBoardName()?></h2>
            <p><?= $board->getBoardDescription()?></p>
            <?php if (isset($_SESSION['username'])) : ?>
             <a href="/board/<?php echo urlencode($board->getBoardId());?>/thread" class="btn btn-primary" role="button">Create Thread</a>
            <?php endif; ?>
        </header>
    </article>
    <?php
            if (session_status() == PHP_SESSION_NONE) {
                echo "session not started";
            } 
        ?>
</section>
<?php include ('./footer.php') ?>