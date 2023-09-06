<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/modelsController.php';
include_once __DIR__ . '/../controller/brandsController.php';

$id = $_GET['id'];
$models_controller = new modelsController();
$brands_controller = new brandsController();
$brands = $brands_controller->getAllBrands();
$show_model = $models_controller->showModel($id);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $brand_id = $_POST['brand'];
    $image = $_FILES['image'];

    // Check if a new image was uploaded
    if ($image['error'] == 0) {
        $file_name = $image['name'];
        $extension = explode('.', $file_name);
        $file_type = end($extension);
        $file_size = $image['size'];
        $allowed_types = ['jpg', 'JPG', 'png', 'PNG', 'svg'];
        $temp_name = $image['tmp_name'];

        if (in_array($file_type, $allowed_types) && $file_size <= 2000000) {
            $time = time();
            $file_name = $time . $file_name;

            $file_upload = move_uploaded_file($temp_name, '../uploads/' . $file_name);
        }
    } else {
        // No new image uploaded, set $file_name to the existing image name
        $file_name = $show_model['image'];
    }

    $update = $models_controller->updateModel($id, $name, $file_name, $brand_id);

    if ($update) {
        echo '<script>location.href = \'app_models.php\';</script>';
    }
}

?>

<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Models</h4>
            <p class="card-description"> Admin<code>/models/update_model</code></p>
            <div class="table-responsive">

                <form action="" class="p-3" method="post" enctype="multipart/form-data">

                    <div class="img-fluid text-center">
                        <img src="../uploads/<?php echo $show_model['image']; ?>" class="img-fluid rounded mx-auto d-block" style="width: 200px; height: 250px;" id="img">
                        <label class="btn btn-secondary my-2">
                            <i class="ri-camera-line">&nbsp;Choose</i>
                            <input type="file" name="image" id="file_img" hidden>
                        </label>
                    </div>

                    <label for="name">Model Name</label>
                    <input type="text" class="form-control mb-3" name="name" id="name" autocomplete="off" value="<?php echo $show_model['name'] ?>">

                    <label for="options">Brand</label>
                    <select id="options" name="brand" class="form-control mb-3 text-secondary">
                        <?php
                        foreach ($brands as $brand) {
                            if ($brand['id'] == $show_model['brands_id']) {
                                echo ' <option value=' . $brand['id'] . ' selected>' . $brand['name'] . '</option>';
                            } else {
                                echo ' <option value=' . $brand['id'] . '>' . $brand['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <button type="submit" class="btn btn-success" name="update">Update</button>


                </form>
            </div>
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