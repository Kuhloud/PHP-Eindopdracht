<?php include ('./header.php') ?>
<title>Post thread - Inholland Forum</title>

<section class="container">
        <h1 class="mt-5"></h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add item
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="todoText" class="form-label">Description:</label>
                                <textarea class="form-control" placeholder="Enter your TODO item here"
                                    id="todoText"></textarea>
                                    <span id="passwordHelpInline" class="form-text">
                                        Must be 8-20 characters long.
                                    </span> 
                            </div>
                            <button type="button" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php include ('./footer.php') ?>