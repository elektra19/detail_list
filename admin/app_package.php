<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/packageController.php';

$package_controller = new PackageController();
$packages = $package_controller->getPackage();

?>

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title my-2">List of Packages</h4>

            <a class="btn btn-outline-success my-3" href="add_package.php">Add New Package +</a>

            <div class="table-responsive">
                <table class="table table-dark" id="mytable">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Name</th>
                            <th> Image</th>
                            <th> Amount</th>
                            <th> Details</th>
                            <th> Buying Link</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $count = 1;
                        foreach ($packages as $package) {
                        ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $package['name']; ?></td>
                                <td><img src="../uploads/<?php echo $package['image']; ?>" alt="" style="width: 60px;height:80px;" class="rounded-0"></td>
                                <td><?php echo $package['amount']; ?></td>
                                <td><?php echo $package['details']; ?></td>
                                <td><?php echo $package['buying_link']; ?></td>
                                <td id='<?php echo $package['id']; ?>'><a class="btn btn-outline-primary mx-3" href="edit_package.php?id=<?php echo $package['id']; ?>"><i class="ri-pencil-line"></i>Edit</a>
                                    <a class="btn btn-outline-danger delete_btn_ajax" href="javascript:void(0)"><i class="ri-delete-bin-2-line"></i>Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../layouts/admin_footer.php';
?>