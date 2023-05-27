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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
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
                },
                lengthMenu: [
                    [5, 10, 20],
                    ["5", "10", "20"]
                ],
                columnDefs: [{
                    targets: 5,
                    render: function(data, type, row, meta) {
                        return `<div class="d-flex justify-content-around">
                                        <button class="btn btn-danger btn-sm btnDeleteCustomer" type="button" value=${row[0]}>
                                            Delete
                                        </button>
                                        <a href="./index.php?page=edit&id=${row[0]}" class="btn btn-primary btn-sm">
                                            Update
                                        </a>
                                    </div>`
                    }
                }, ],
                drawCallback: () => {
                    deleteCustomer();
                }
            })
        });

        function deleteCustomer() {
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
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'This customer has been deleted!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        setTimeout(() => {
                            location.href = `./index.php?page=delete&id=${id}`;
                        }, 3000)
                    }
                })
            })
        }
    </script>
</body>

</html>