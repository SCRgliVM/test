<div class="container">
    <div class="row">
        <h1 class="text-center">Genres List</h1>
        <div>
            <a href="/genres/add" class="btn btn-success mb-3  d-inline-block">Add new genre</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($genres as $genre) : ?>
                    <tr>
                        <td><?= $genre['name']; ?></td>
                        <td class="text-end">
                            <a class='btn btn-success' href='/genres/edit/<?= $genre['id'];?>'>Edit</a>
                            <a class='btn btn-danger'  href='/genres/delete/<?= $genre['id'];?>'>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>