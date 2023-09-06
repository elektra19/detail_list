<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/modelsController.php';
include_once __DIR__ . '/../controller/brandsController.php';
include_once __DIR__ . '/../controller/firmwaresController.php';

$models_controller = new modelsController();
$models = $models_controller->getAllModels();

$brands_controller = new brandsController();
$brands = $brands_controller->getAllBrands();

$id = $_GET['id'];
$firmware_controller = new firmwaresController();
$showfirms = $firmware_controller->showFirm($id);

if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $miui = trim($_POST['miui']);
    $android = trim($_POST['android']);
    $size = trim($_POST['size']);
    $type = trim($_POST['type']);
    $down_link = trim($_POST['down_link']);
    $down_link_1 = trim($_POST['down_link_1']);
    $details = trim($_POST['details']);
    $model_id = trim($_POST['new_model']);

    if (empty($name) || empty($miui) || empty($android) || empty($size) || empty($type) || empty($down_link)|| empty($details)) {
        echo 'Please fill in all the required fields.';
    } else {
        $updateFirms = $firmware_controller->updateFirm($id, $name, $miui, $android, $size, $type, $down_link,$down_link_1,$details, $model_id);

        if ($updateFirms) {
            // echo 'Firmware added successfully!';
            echo '<script>
            location.href = \'app_firmware.php\';
            </script>';
        } else {
            echo 'Error adding firmware. Please try again.';
        }
    }
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
        placeholder: 'Your content is here',
        tabsize: 2,
      });

    });
</script>

<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Firmwares</h4>
            <p class="card-description"> Admin<code>/firmwares/update your firmwares</code></p>

            <div class="table-responsive">
                <form action="" class="p-3" method="post">

                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control mb-3" id="name" autocomplete="off" required value="<?php echo $showfirms['name']; ?>">




                    <label for="miui">MIUI Version</label>
                    <input type="text" name="miui" class="form-control mb-3" id="miui" autocomplete="off" required value="<?php echo $showfirms['miui_version']; ?>">

                    <label for="android">Android Version</label>
                    <input type="text" name="android" class="form-control mb-3" id="android" autocomplete="off" required value="<?php echo $showfirms['android_version']; ?>">

                    <label for="size">File Size</label>
                    <input type="text" name="size" class="form-control mb-3" id="size" autocomplete="off" required value="<?php echo $showfirms['size']; ?>">

                    <label for="type">Type</label>
                    <input type="text" name="type" class="form-control mb-3" id="type" autocomplete="off" required value="<?php echo $showfirms['type']; ?>">

                    <label for="">Write Post Content</label>
                    <textarea name="details" id="summernote" cols="30" rows="10" class="form-control mb-3"><?php echo $showfirms['details']; ?></textarea>

                    <label for="down_link" class="mt-4">OneDrive Link</label>
                    <input type="link" name="down_link" class="form-control mb-3" id="down_link" autocomplete="off" required value="<?php echo $showfirms['download_link']; ?>">

                    <label for="down_link_1" class="mt-4">Mediafire Link</label>
                    <input type="link" name="down_link_1" class="form-control mb-3" id="down_link" autocomplete="off" required value="<?php echo $showfirms['download_link_1']; ?>">

                    <!-- <label for="date">Date</label>
                        <input type="date" class="form-control mb-3" name="date" id="date" autocomplete="off"> -->

                    <label for="models">Select Your Models</label>
                    <div class="row justify-content-around">
                        <!-- <select name="brands" id="brands" class="form-control mb-3 text-white col-5">
                            <?php
                            // foreach ($brands as $brand) {

                            //     echo '<option value=' . $brand['id'] . '>' . $brand['name'] . '</option> ';
                            // }
                            ?>
                        </select> -->

                        <select name="new_model" id="models" class="form-control mb-3 text-white col-5">
                            <option value="" disabled selected hidden>-- Select a model --</option>
                            <?php
                            foreach ($models as $model) {
                                if ($model['id'] == $showfirms['models_id']) {

                                    echo '<option value="' . $model['id'] . '" selected class="bg-success">' . $model['name'] . '</option>';
                                } else {
                                    echo '<option value="' . $model['id'] . '">' . $model['name'] . '</option>';
                                }
                            }
                            ?>
                        </select>

                    </div>

                    <button type="submit" name="update" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../layouts/admin_footer.php';
?>