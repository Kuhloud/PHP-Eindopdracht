<?php include ('./header.php') ?>
<title>Post thread - Inholland Forum</title>
<script src="../../../javascript/thread.js"></script>
<section class="container d-flex justify-content-center align-items-center">
    <article class="card shadow p-3 mb-5 bg-body rounded" style="width: 800px;">
        <header class="card-header">
            Post a New Thread - <?= $currentboard ?>
        </header>
        <section class="card-body">
            <form id="createThread" onsubmit="event.preventDefault()">
                <section class="mb-3">
                    <label for="threadTitle" class="form-label">Thread Title:</label>
                    <input type="text" class="form-control" id="threadTitle" placeholder="Enter thread title">
                </section>
                <section class="mb-3">
                    <label for="firstPost" class="form-label">First Post:</label>
                    <textarea class="form-control" id="firstPost" rows="6"></textarea>
                </section>
                <section class="mb-3">
                    <label for="tags" class="form-label">Tags:</label>
                    <input type="text" class="form-control" id="tags" placeholder="Enter tags (separated by commas)">
                </section>
                <button type="submit" onclick="createThread(<?= $userId ?>, <?= $boardId ?>)" class="btn btn-primary">Create Thread</button>
            </form>
        </section>
    </article>
</section>
<?php include ('./footer.php') ?>