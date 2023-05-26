<?php

declare(strict_types=1);

include_once 'model/DBConnection.php';
include_once 'model/CustomerDB.php';

use Model\CustomerDB;

$connection = new DBConnection();

$customerDB = new CustomerDB($connection->connect());

$customers = $customerDB->getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>

    <!-- <link rel="style/css" href="../assets/datatables/v1.13.4/css/jquery.dataTables.min.css" /> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" crossorigin />
</head>

<body>
    <div class="col-12 col-md-12 mt-2 container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>List of Customers</h5>
                <a class="btn btn-success btn-sm" href="./index.php?page=add">Create new customer</a>
            </div>
            <div class="card-body">
                <div class="col-12">
                    <table class="table table-bordered" id="tbCustomers">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <?php
                                    if (empty($customers)) {
                                    ?>
                                <tr>
                                    <td colspan="5" class="text-center">No record found!</td>
                                </tr>
                            <?php
                                    }
                            ?>
                            <?php foreach ($customers as $customer) : ?>
                                <tr>
                                    <td><?= $customer->getId() ?></td>
                                    <td><?= $customer->getName() ?></td>
                                    <td><?= $customer->getEmail() ?></td>
                                    <td><?= $customer->getAddress() ?></td>
                                    <td><?= $customer->getGender() ?></td>
                                    <td class="d-flex justify-content-around">
                                        <button class="btn btn-danger btn-sm btnDeleteCustomer" type="button" value="<?= $customer->getId(); ?>">
                                            Delete
                                        </button>
                                        <a href="./index.php?page=edit&id=<?= $customer->getId(); ?>" class="btn btn-primary btn-sm">
                                            Update
                                        </a>
                                    </td>
                                <?php endforeach; ?> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- <script src="../assets/datatables/v1.13.4/js/jquery.dataTables.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(() => {
            $('#tbCustomers').DataTable({
                'serverSide': 'true',
                'processing': 'true',
                'paging': 'true',
                'searching': false,
                'ordering': false,
                'ajax': {
                    'url': 'model/server_processing.php',
                    'type': 'POST',
                    // "dataSrc": "data"
                },
                lengthMenu: [
                    [5, 10, 20],
                    ["5", "10", "20"]
                ],
            })
        });

        $('.btnDeleteCustomer').click(function() {
            let id = $(this).val();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(id);
                    location.href = `./index.php?page=delete&id=${id}`;
                    Swal.fire(
                        'Deleted!',
                        'This customer has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
</body>

</html>