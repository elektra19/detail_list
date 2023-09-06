<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/boxDownController.php';
include_once __DIR__ . '/../controller/boxController.php';

$box_down_controller = new boxDownController();
$boxs = $box_down_controller->getAllBoxdown();

$box_controller = new boxController();
$box_cats = $box_controller->getAllBox();

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $box_id = $_POST['boxcat'];
    $downlink = $_POST['down_link'];
    $post = $_POST['post'];
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        $file_name = $image['name'];
        $file_size = $image['size'];
        $tmp_name = $image['tmp_name'];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_types = ['jpg', 'png', 'svg'];
        $new_file_name = time() . '_' . $file_name;

        if (in_array(strtolower($extension), $allowed_types) && $file_size < 2000000) {
            $upload_path = '../uploads/' . $new_file_name;
            if (move_uploaded_file($tmp_name, $upload_path)) {
                $image = $new_file_name;
            } else {
                echo 'Image upload failed.';
            }
        }
    }

    $create_box = $box_down_controller->createBoxdown($name, $downlink, $image, $box_id, $post);

    if ($create_box) {
        echo '<script>location.href = \'app_box_down.php\';</script>';
    } else {
        echo 'Creation failed.';
    }
}

?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
</script>

<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">

            <!-- modal start -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="create_brand" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-secondary">
                            <div class="modal-header text-dark">
                                <h3 class="modal-title fs-5">Create Box</h3>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                                    aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <label for="tool" class="text-dark">Name</label>
                                <input type="text" name="name" class="form-control bg-secondary text-dark"
                                    id="tool" required>

                                <label for="image" class="text-dark">Image</label>
                                <input type="file" name="image" class="form-control bg-secondary text-dark"
                                    id="image" required>

                                <label for="options" class="text-dark">Brand</label>
                                <select id="options" name="boxcat" class="form-control mb-3 bg-secondary border text-dark"
                                    required>
                                    <option value="" disabled selected hidden>Choose Your Box</option>
                                    <?php
                                    foreach ($box_cats as $item) {
                                        echo ' <option value=' . $item['id'] . '>' . $item['name'] . '</option>';
                                    }
                                    ?>
                                </select>

                                <label for="link" class="text-dark">Download Link</label>
                                <input type="text" name="down_link" class="form-control bg-secondary text-dark"
                                    id="link" required>

                                <label for="summernote" class="text-dark">Content</label>
                                <div class="bg-dark">
                                    <textarea name="post" class="text-dark" id="summernote" cols="30" rows="10" required></textarea>
                                </div>
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
                            <th></th>
                            <th> No</th>
                            <th> Name</th>
                            <th> Category</th>
                            <th> Image</th>
                            <th> Post</th>
                            <th> Download Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($boxs as $box) {
                            echo '<tr>';
                            echo '<td id=' . $box['id'] . '>
                                    <a class="btn btn-sm btn-outline-primary mx-3" href="boxdown_edit.php?id=' . $box['id'] . '">
                                        <i class="ri-pencil-line"></i> </a>

                                    <a class="btn btn-sm btn-outline-danger delete_btn_ajax" href="">
                                        <i class="ri-delete-bin-2-line"></i> </a>
                                </td>';
                            echo '<td>'.$count++.'</td>';
                            echo '<td>'.$box['name'].'</td>';
                            echo '<td>'.$box['bname'].'</td>';
                            echo '<td><img src="../uploads/' . $box['image'] . '"style="width: 150px;height:80px;"class="rounded-0"></td>';

                            echo '<td>'.substr($box['post'],0,35).'&nbsp;more...</td>';
                            echo '<td>'.$box['download_link'].'</td>';
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
