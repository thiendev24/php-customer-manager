<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
</head>

<body>
    <div class="col-12 col-md-12 mt-2 container">
        <div class="card">
            <div class="card-header">
                <h5>Edit customer</h5>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <form method="post" action="./index.php?page=edit&id=<?= $customer->id ?>">
                        <input type="hidden" name="id" value="<?= $customer->id; ?>" />
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" value="<?= $customer->name; ?>" name="name" id="name" class="form-control">
                            <?php if (isset($errors['name'])) : ?>
                                <p class="text-danger"><?= $errors['name'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" value="<?= $customer->email; ?>" class="form-control" name="email" id="email">
                            <?php if (isset($errors['email'])) : ?>
                                <p class="text-danger"><?= $errors['email'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" value="<?= $customer->address; ?>" class="form-control" name="address" id="address">
                            <?php if (isset($errors['address'])) : ?>
                                <p class="text-danger"><?= $errors['address'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="gender">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="MALE" <?= $customer->gender === "MALE" ? "selected" : "" ?>>MALE</option>
                                <option value="FEMALE" <?= $customer->gender === "FEMALE" ? "selected" : "" ?>>FEMALE</option>
                                <option value="OTHER" <?= $customer->gender === "OTHER" ? "selected" : "" ?>>OTHER</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a type="button" href="index.php" class="btn btn-secondary ms-2">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>