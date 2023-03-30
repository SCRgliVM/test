<div class="container">
    <h1>Edit visitor:</h1>
    <form method="post" action="/visitors/edit/<?= $visitorModel->id ?>">
        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" class="
                form-control 
                <?= $visitorModel->hasError('firstName') ? ' is-invalid' : '' ?>
            "
            value ="<?= $visitorModel->firstName ?>"
             id="firstName" name="firstName">
            <div class="invalid-feedback">
                <?= $visitorModel->getFirstError('firstName') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" class="
                form-control 
                <?= $visitorModel->hasError('lastName') ? ' is-invalid' : '' ?>            
            "
            value ="<?= $visitorModel->lastName ?>"
             id="lastName" name="lastName">
            <div class="invalid-feedback">
                <?= $visitorModel->getFirstError('lastName') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="
            form-control 
            <?= $visitorModel->hasError('email') ? ' is-invalid' : '' ?>
            "
            value ="<?= $visitorModel->email ?>"
             id="email" name="email">
            <div class="invalid-feedback">
                <?= $visitorModel->getFirstError('email') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Phone number:</label>
            <input type="text" class="
            form-control
            <?= $visitorModel->hasError('phone') ? ' is-invalid' : '' ?>
            "
            value ="<?= $visitorModel->phone ?>"
             id="phone" name="phone">
            <div class="invalid-feedback">
                <?= $visitorModel->getFirstError('phone') ?>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-2">Change</button>
        <a href="/" class="btn btn-danger mt-2">Cancel</a>
    </form>
</div>