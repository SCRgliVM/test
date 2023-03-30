<div class="container">
    <h1>Create new genre:</h1>
    <form method="post" action="/genres/add">
        <div class="form-group">
            <label for="name">Genre Name:</label>
            <input type="text" class="
                form-control 
                <?= $genreModel->hasError('name') ? ' is-invalid' : '' ?>
            "
            value ="<?= $genreModel->name ?>"
             id="name" name="name">
            <div class="invalid-feedback">
                <?= $genreModel->getFirstError('name') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-2">Create</button>
        <a href="/" class="btn btn-danger mt-2">Cancel</a>
    </form>
</div>