<?php include ('./header.php'); ?>
<body>
    
</body>
</html>

<?php
foreach($model as $article) {
    ?>
    <h4><?= ucfirst($article->getTitle())?></h4>
    <small>By: <?= $article->getAuthor()?> at <?=$article->getPostedAt()?></small>
    <p><?= $article->getContent()?></p>
    <?php
}
?>

