<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/brandsController.php';
include_once __DIR__ . '/../controller/firmwaresController.php';


$brands_controller = new brandsController();
$brands = $brands_controller->getAllBrands();

$firmware_controller = new firmwaresController();


if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $miui = trim($_POST['miui']);
    $android = trim($_POST['android']);
    $size = trim($_POST['size']);
    $type = trim($_POST['type']);
    $down_link = trim($_POST['down_link']);
    $down_link_1 = trim($_POST['down_link_1']);
    $details = trim($_POST['details']);
    $model_id = trim($_POST['new_model']);

    if (empty($name) || empty($miui) || empty($android) || empty($size) || empty($type) || empty($down_link) || empty($details)) {
        echo 'Please fill in all the required fields.';
    } else {
        $addFirm = $firmware_controller->createFirmware($name, $miui, $android, $size, $type, $down_link, $down_link_1, $details, $model_id);
        if ($addFirm) {
            // echo 'Firmware added successfully!';
            echo '<script>
            alert("Firmware added successfully!");
            location.href = \'app_firmware.php\';
            </script>';
        } else {
            echo 'Error adding firmware. Please try again.';
        }
    }
}
// echo '<script>location.href="app_brands.php";</script>';
// echo '<script>location.href = \'brands.php\';</script>';


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('#brands').on('change', function() {
            var brandid = $(this).val();
            // alert(brandid);
            $.ajax({
                url: "mloader.php",
                type: "POST",
                data: {
                    bid: brandid
                },
                success: function(bdata) {
                    $('#models').html(bdata);
                    // console.log(brandid);
                }
            });

        });

        

    });

</script>

<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Firmwares</h4>
            <p class="card-description"> Admin<code>/firmwares/add new firmwares</code></p>

            <div class="table-responsive">
                <form action="" class="p-3" method="post">

                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control mb-3" id="name" autocomplete="off" required>

                    <label for="miui">MIUI Version</label>
                    <input type="text" name="miui" class="form-control mb-3" id="miui" autocomplete="off" required>

                    <label for="android">Android Version</label>
                    <input type="text" name="android" class="form-control mb-3" id="android" autocomplete="off" required>

                    <label for="size">File Size</label>
                    <input type="text" name="size" class="form-control mb-3" id="size" autocomplete="off" required>

                    <label for="type">Type</label>
                    <input type="text" name="type" class="form-control mb-3" id="type" autocomplete="off" required>

                    <label for="">Write Post Content</label>
                    <textarea name="details" id="summernote" cols="30" rows="10" class="form-control mb-3"></textarea>

                    <label for="down_link" class="mt-4">GoogleDrive Download Link</label>
                    <input type="link" name="down_link" class="form-control mb-3" id="down_link" autocomplete="off" required>

                    <label for="down_link">Mediafire Download Link</label>
                    <input type="link" name="down_link_1" class="form-control mb-3" id="down_link" autocomplete="off" required>



                    <!-- <label for="date">Date</label>
                        <input type="date" class="form-control mb-3" name="date" id="date" autocomplete="off"> -->

                    <label for="models">Select Your Models</label>
                    <div class="row justify-content-around">
                        <select name="brands" id="brands" class="form-control mb-3 text-white col-5">
                            <option value="" disabled selected hidden>-- Select a brands --</option>
                            <?php
                            foreach ($brands as $brand) {

                                echo '<option value=' . $brand['id'] . '>' . $brand['name'] . '</option>';
                            }
                            ?>
                        </select>

                        <select name="new_model" id="models" class="form-control mb-3 text-white col-5">
                            <option value="" disabled selected hidden>-- Select a models --</option>
                            <!-- <?php
                                    // foreach ($models as $model) {

                                    //     echo '<option value=' . $model['id'] . '>' . $model['name'] . '</option>';
                                    // }
                                    ?> -->
                        </select>

                    </div>

                    <button type="submit" name="add" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../layouts/admin_footer.php';
?>