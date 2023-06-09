<div class="container">
    <div class="row">
        <h1 class="text-center">Visitors List</h1>
        <div>
            <a href="/visitors/add" class="btn btn-success mb-3  d-inline-block">Add new visitor</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Last name</th>
                    <th scope="col">First name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone number</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visitors as $visitor) : ?>
                    <tr>
                        <td><?= $visitor['firstname']; ?></td>
                        <td><?= $visitor['lastname']; ?></td>
                        <td><?= $visitor['email']; ?></td>
                        <td><?= $visitor['phone']; ?></td>
                        <td class="text-end">
                            <a class='btn btn-success' href='/visitors/edit/<?= $visitor['id'];?>'>Edit</a>
                            <a class='btn btn-danger'  href='/visitors/delete/<?= $visitor['id'];?>'>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>