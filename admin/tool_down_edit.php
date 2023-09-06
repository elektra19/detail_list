<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/toolDownController.php';
include_once __DIR__ . '/../controller/toolsController.php';

$id = $_GET['id'];
$tool_Down_Controller = new toolDownController();
$show_tool = $tool_Down_Controller->showAllTollDown($id);

$tools_controller = new toolsController();
$cat_tools = $tools_controller->getAllTools();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $tools_id = $_POST['toolcat'];
    $downlink = $_POST['down_link'];
    $post = $_POST['post'];
    $image = $_FILES['image'];

    if ($image['error'] == 0) {
        $file_name = $image['name'];
        $extension = explode('.', $file_name);
        $file_type = end($extension);
        $file_size = $image['size'];
        $allowed_types = ['jpg', 'JPG', 'png', 'PNG', 'svg'];
        $temp_name = $image['tmp_name'];

        if (in_array($file_type, $allowed_types) && $file_size <= 2000000) {
            $time = time();
            $file_name = $time .'_'. $file_name;

            $file_upload = move_uploaded_file($temp_name, '../uploads/' . $file_name);
        }
    } else {
        $file_name = $show_tool['image'];
    }

    $create_tool = $tool_Down_Controller->updateTool($id,$name, $downlink, $file_name, $tools_id, $post);

    if ($create_tool) {
        echo '<script>location.href = \'app_tool_down.php\';</script>';
    } else {
        echo 'Creation failed.';
    }
}

?>


<div class="col-12 grid-margin stretch-card mt-5">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Tools</h4>
            <p class="card-description"> Admin<code>/tools/update_tool</code></p>
            <div class="table-responsive">

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="img-fluid text-center">
                        <img src="../uploads/<?php echo $show_tool['image']; ?>" class="img-fluid rounded mx-auto d-block"
                            style="width: 500px; height: 300px;" id="img">
                        <label class="btn btn-secondary my-2">
                            <i class="ri-camera-line">&nbsp;Choose</i>
                            <input type="file" name="image" id="file_img" hidden>
                        </label>
                    </div>

                    <label for="tool">Name</label>
                    <input type="text" name="name" class="form-control text-white" id="tool"
                        value="<?php echo $show_tool['name']; ?>" required>

                    <label for="options">Brand</label>
                    <select id="options" name="toolcat" class="form-control mb-3 border text-white" required>
                        <!-- <option value="<?php echo $show_tool['tools_id']; ?>" selected><?php echo $show_tool['tools_id']; ?></option> -->
                        <?php
                        foreach ($cat_tools as $cat_tool) {
                            echo $cat_tool['id'];
                            echo $cat_tool['name'];
                            echo '<br>';
                            if ($cat_tool['id'] == $show_tool['tools_id']) {
                                echo '<option value="' . $cat_tool['id'] . '" class="bg-success" selected>' . $cat_tool['name'] . '</option>';
                            } else {
                                echo '<option value="' . $cat_tool['id'] . '">' . $cat_tool['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <label for="link">Download Link</label>
                    <input type="text" name="down_link" class="form-control text-white" id="link"
                        value="<?php echo $show_tool['download_link']; ?>" required>

                    <label for="summernote">Content</label>
                    <div class="bg-dark">
                        <textarea name="post" id="summernote" cols="30" rows="10" required><?php echo $show_tool['post']; ?></textarea>
                    </div>

                    <div class="py-3">
                        <button type="submit" name="update" class="btn btn-success">Update</button>
                    </div>


                </form>
            </div>
        </div>
    </div>


    <?php
    include_once __DIR__ . '/../layouts/admin_footer.php';
    ?>
    <script type="text/javascript">
        var file = document.getElementById('file_img');
        var img = document.getElementById('img');

        file.addEventListener('change', (e) => {
            img.src = URL.createObjectURL(e.target.files[0]);
        });
    </script>
