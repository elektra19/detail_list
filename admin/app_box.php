<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/boxController.php';

$box_controller = new boxController();
$boxs = $box_controller->getAllBox();

if (isset($_POST['create'])) {
    $name = $_POST['name'];

    $create_box = $box_controller->createBox($name);
    if ($create_box) {
        echo '<script>location.href = \'app_box.php\';</script>';
    } else {
        echo 'Tool creation failed.';
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
</script>

<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">

            <!-- modal start -->
            <form action="" method="post">
                <div class="modal fade" id="create_brand" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header text-dark">
                                <h3 class="modal-title fs-5">Create Box Category</h3>
                                <button type="button" class="btn btn-sm btn-danger
                            " data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <label for="box" class="text-dark">Name</label>
                                <input type="text" name="name" class="form-control bg-secondary text-dark" id="box">
                            </div>
                            <div class="modal-footer border-0">
                                <button type="submit" name="create" class="btn btn-success">Create</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <!-- modal end -->

            <h4 class="card-title my-2">Box</h4>
            <p class="card-description"> Admin<code>/box</code></p>

            <button class="btn btn-outline-success my-3" data-bs-toggle="modal" data-bs-target="#create_brand">Add New
                Box +</button>

            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($boxs as $box) {
                            echo '<tr>';
                            echo '<td>' . $count++ . '</td>';
                            echo '<td>' . $box['name'] . '</td>';

                            echo '<td id=' .
                            $box['id'] .
                                '>
                                                                                                                                <a class="btn btn-sm btn-outline-primary mx-3" href="box_edit.php?id=' .
                            $box['id'] .
                                '"><i class="ri-pencil-line"></i>Edit</a>
                                
                                        <a class="btn btn-sm btn-outline-danger delete_btn_ajax" href="javascript:void(0)"><i class="ri-delete-bin-2-line"></i>Delete</a> </td>';
                            echo '</tr>';
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