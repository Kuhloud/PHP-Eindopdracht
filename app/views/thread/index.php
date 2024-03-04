<?php include ('./header.php') ?>
<title>Post thread - Inholland Forum</title>
<section class="container d-flex justify-content-center align-items-center">
    <article class="card shadow p-3 mb-5 bg-body rounded" style="width: 800px;">
        <header class="card-header">
            Post a New Thread - <?php $_SESSION['board']->getBoardName ?>
        </header>
        <section class="card-body">
            <form>
                <div class="mb-3">
                    <label for="threadTitle" class="form-label">Thread Title:</label>
                    <input type="text" class="form-control" id="threadTitle" placeholder="Enter thread title">
                </div>
                <div class="mb-3">
                    <label for="threadContent" class="form-label">Thread Content:</label>
                    <textarea class="form-control" id="threadContent" placeholder="Enter thread content" rows="6"></textarea>
                    <span id="passwordHelpInline" class="form-text">
                        Must be 8-20 characters long.
                    </span>
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags:</label>
                    <input type="text" class="form-control" id="tags" placeholder="Enter tags (separated by commas)">
                </div>
                <button type="submit" class="btn btn-primary">Create Thread</button>
            </form>
        </section>
    </article>
</section>

<?php include ('./footer.php') ?>