<div class="container">
    <h1>Edit book:</h1>
    <form method="post" action="/books/edit/<?= $bookModel->id ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="
                form-control 
                <?= $bookModel->hasError('title') ? ' is-invalid' : '' ?>
            "
            value ="<?= $bookModel->title ?>"
             id="title" name="title">
            <div class="invalid-feedback">
                <?= $bookModel->getFirstError('title') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" class="
                form-control 
                <?= $bookModel->hasError('author') ? ' is-invalid' : '' ?>            
            "
            value ="<?= $bookModel->author ?>"
             id="author" name="author">
            <div class="invalid-feedback">
                <?= $bookModel->getFirstError('author') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="genre">Genre:</label>
            <input type="text" class="
            form-control 
            <?= $bookModel->hasError('genre') ? ' is-invalid' : '' ?>
            "
            value ="<?= $bookModel->genre ?>"
             id="genre" name="genre">
            <div class="invalid-feedback">
                <?= $bookModel->getFirstError('genre') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="release_year">Release year:</label>
            <input type="text" class="
            form-control 
            <?= $bookModel->hasError('release_year') ? ' is-invalid' : '' ?>
            "
            value ="<?= $bookModel->release_year ?>"
             id="release_year" name="release_year">
            <div class="invalid-feedback">
                <?= $bookModel->getFirstError('release_year') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-2">Edit</button>
        <a href="/books" class="btn btn-danger mt-2">Cancel</a>
    </form>
</div>