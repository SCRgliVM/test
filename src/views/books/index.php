<div class="container">
    <div class="row">
        <h1 class="text-center">Books List</h1>
        <div>
            <a href="/books/add" class="btn btn-success mb-3  d-inline-block">Add new book</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Release year</th>
                    <th scope="col">Genre</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book) : ?>
                    <tr>
                        <td><?= $book['title']; ?></td>
                        <td><?= $book['author']; ?></td>
                        <td><?= $book['release_year']; ?></td>
                        <td><?= $book['genre']; ?></td>
                        <td>
                            <a class='btn btn-success' href='/books/edit/<?= $book['id'];?>'>Edit</a>
                            <a class='btn btn-danger'  href='/books/delete/<?= $book['id'];?>'>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>