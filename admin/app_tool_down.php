<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/toolDownController.php';
include_once __DIR__ . '/../controller/toolsController.php';

$toolsController = new toolsController();
$tool_categories = $toolsController->getAllTools();

$tool_Down_Controller = new toolDownController();
$tools = $tool_Down_Controller->getAllTollDown();

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $tools_id = $_POST['toolcat'];
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

    $create_tool = $tool_Down_Controller->createTool($name, $downlink, $image, $tools_id, $post);

    if ($create_tool) {
        echo '<script>location.href = \'app_tool_down.php\';</script>';
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
                                <h3 class="modal-title fs-5">Create Tool</h3>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                                    aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <label for="tool" class="text-dark">Name</label>
                                <input type="text" name="name" class="form-control bg-secondary text-dark" id="tool" required>

                                <label for="image" class="text-dark">Image</label>
                                <input type="file" name="image" class="form-control bg-secondary text-dark" id="image" required>

                                <label for="options" class="text-dark">Brand</label>
                                <select id="options" name="toolcat" class="form-control mb-3 bg-secondary border" required>
                                    <option value="" disabled selected hidden>Choose Your Brand</option>
                                    <?php
                                    foreach ($tool_categories as $item) {
                                        echo ' <option value=' . $item['id'] . '>' . $item['name'] . '</option>';
                                    }
                                    ?>
                                </select>

                                <label for="link" class="text-dark">Download Link</label>
                                <input type="text" name="down_link" class="form-control bg-secondary text-dark" id="link" required>

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

            <h4 class="card-title my-2">Tools</h4>
            <p class="card-description"> Admin<code>/tools</code></p>

            <button class="btn btn-outline-success my-3" data-bs-toggle="modal" data-bs-target="#create_brand">Add New
                Tools +</button>

            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th></th>
                            <th> No</th>
                            <th> Name</th>
                            <th> Image</th>
                            <th> Category</th>
                            <th> Post</th>
                            <th> Download Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($tools as $tool) {
                            echo '<tr>';
                            echo '<td id=' .
                                $tool['id'] .
                                '>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <a class="btn btn-sm btn-outline-primary mx-3" href="tool_down_edit.php?id=' .
                                $tool['id'] .
                                '"><i class="ri-pencil-line"></i></a>
                                                                                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                                                                                                                                <a class="btn btn-sm btn-outline-danger delete_btn_ajax" href="javascript:void(0)"><i class="ri-delete-bin-2-line"></i></a> </td>';
                        
                            echo '<td>' . $count++ . '</td>';
                            echo '<td>' . $tool['name'] . '</td>';
                            echo '<td><img src="../uploads/' . $tool['image'] . '"style="width: 150px;height:80px;"class="rounded-0"></td>';
                            echo '<td>' . $tool['tools_id'] . '</td>';
                            echo '<td>' . substr($tool['post'], 0, 35) . ' More...' . '</td>';
                            echo '<td>' . $tool['download_link'] . '</td>';
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
