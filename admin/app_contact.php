<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/contactController.php';

$contact_controller = new contactController();
$data = $contact_controller->getcontact();
?>

<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Contact</h4>
            <p class="card-description"> Admin<code>/contact</code></p>
            <div class="table-responsive">
                <a class="btn btn-success mx-3" href="#"><i class="mdi mdi-upload btn-icon-prepend"></i>Add New</a>

                <a class="btn btn-primary mx-3" href="#">
                    <i class="ri-pencil-line"></i>Edit</a>

                <a class="btn btn-danger delete_btn_ajax">
                    <i class="ri-delete-bin-2-line"></i>Delete</a>

                <form action="" class="p-3">
                    <table class="table table-dark text-white">
                        <thead>
                            <tr>
                                <th> Email</th>
                                <th> Phone Number</th>
                                <th> Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $item) {

                            ?>

                                <tr>
                                    <td><?php echo $item['email'] ?></td>
                                    <td><?php echo $item['phone_number'] ?></td>
                                    <td><?php echo $item['address'] ?></td>
                                </tr>

                                <tr>
                                    <th>Youtube</th>
                                    <th>Youtube</th>
                                    <th>Youtube</th>
                                </tr>
                                <tr>
                                <td><?php echo $item['youtube'] ?></td>
                                    <td><?php echo $item['facebook'] ?></td>
                                    <td><?php echo $item['twitter'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../layouts/admin_footer.php';
?>
