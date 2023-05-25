<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Customer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="col-12 col-md-12 mt-2 container">
        <div class="card">
            <div class="card-header">
                <h5>Create new customer</h5>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <form method="post" id="frmCreateCustomer">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                            <?php if (isset($errors['name'])) : ?>
                                <p class="text-danger"><?= $errors['name'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                            <?php if (isset($errors['email'])) : ?>
                                <p class="text-danger"><?= $errors['email'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address">
                            <?php if (isset($errors['address'])) : ?>
                                <p class="text-danger"><?= $errors['address'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="gender">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                                <option value="OTHER">OTHER</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button type="button" id="btnClear" class="btn btn-warning ms-2">Clear</button>
                            <a type="button" href="index.php" class="btn btn-secondary ms-2">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script>
        $('#btnClear').click(() => {
            $("#frmCreateCustomer")[0].reset();
        })
    </script>
</body>

</html>