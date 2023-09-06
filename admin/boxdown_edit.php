<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/boxDownController.php';
include_once __DIR__ . '/../controller/boxController.php';

$id = $_GET['id'];
$box_down_controller = new boxDownController();
$show_box = $box_down_controller->showBoxdown($id);

$box_controller = new boxController();
$box_cats = $box_controller->getAllBox();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $box_id = $_POST['boxcat'];
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
            $file_name = $time . '_' . $file_name;

            $file_upload = move_uploaded_file($temp_name, '../uploads/' . $file_name);
        }
    } else {
        $file_name = $show_box['image'];
    }

    $update_box = $box_down_controller->updateBoxdown($id, $name, $downlink, $file_name, $box_id, $post);

    if ($update_box) {
        echo '<script>location.href = \'app_box_down.php\';</script>';
    } else {
        echo 'Creation failed.';
    }
}

?>


<div class="col-12 grid-margin stretch-card mt-5">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Box</h4>
            <p class="card-description"> Admin<code>/box/update_box</code></p>
            <div class="table-responsive">

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="img-fluid text-center">
                        <img src="../uploads/<?php echo $show_box['image']; ?>" class="img-fluid rounded mx-auto d-block"
                            style="width: 500px; height: 300px;" id="img">
                        <label class="btn btn-secondary my-2">
                            <i class="ri-camera-line">&nbsp;Choose</i>
                            <input type="file" name="image" id="file_img" hidden>
                        </label>
                    </div>

                    <label for="tool">Name</label>
                    <input type="text" name="name" class="form-control text-white" id="tool"
                        value="<?php echo $show_box['name']; ?>" required>

                    <label for="options">Category</label>
                    <select id="options" name="boxcat" class="form-control mb-3 border text-white" required>

                        <?php
                        foreach ($box_cats as $box_cat) {
                            echo $box_cat['id'];
                            echo $box_cat['name'];
                            echo '<br>';
                            if ($box_cat['id'] == $show_box['box_id']) {
                                echo '<option value="' . $box_cat['id'] . '" class="bg-success" selected>' . $box_cat['name'] . '</option>';
                            } else {
                                echo '<option value="' . $box_cat['id'] . '">' . $box_cat['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <label for="link">Download Link</label>
                    <input type="text" name="down_link" class="form-control text-white" id="link"
                        value="<?php echo $show_box['download_link']; ?>" required>

                    <label for="summernote">Content</label>
                    <div class="bg-dark">
                        <textarea name="post" id="summernote" cols="30" rows="10" required><?php echo $show_box['post']; ?></textarea>
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
