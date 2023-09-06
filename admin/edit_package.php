<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/packageController.php';

// convert illegal input value to ligal value formate
function text_input($value)
{
    $value = trim($value);
    return $value;
}
$id = $_GET['id'];
$nameErr = $amountErr = $detailErr = $image = $imageErr = $filename = "";
$package_controller = new PackageController();
$package = $package_controller->getPackageById($id);


//input fields are Validated with regular expression
$validName = "/^[a-zA-Z\/ ]*$/";
$pattern = "/^\d+(\.\d{2})?$/";
if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $nameErr = "Name is required!";
    } else {
        $name = text_input($_POST['name']);
    }
    if (!preg_match($pattern, $_POST['amount'])) {
        $amountErr = "Amount must be interger!";
    } else {
        $amount = text_input($_POST['amount']);
    }

    if (empty($_POST['details'])) {
        $detailErr = "Details is required!";
    } else {
        $detail = text_input($_POST['details']);
    }
    $buy_name = $_POST['buy_link'];

    $image = $_FILES['image'];
    $filename = $package['image'];
    if (!empty($image['name'])) {
        if ($image['error'] == 0) {
            $filename = $image['name'];
            $extension = explode('.', $filename);
            $filetype = end($extension);
            $filesize = $image['size'];

            $allowed_types = ['jpg', 'jpeg', 'png', 'svg'];
            $temp_file = $image['tmp_name'];
            if (in_array($filetype, $allowed_types)) {
                if ($filesize <= 2000000) {
                    $timestamp = time();
                    $filename = $timestamp . $filename;
                    if (move_uploaded_file($temp_file, '../uploads/' . $filename)) {
                    }
                } else {
                    $imageErr = "Image is large";
                }
            } else {
                $imageErr = "File type should be jpg, jpeg, png and svg";
            }
        } else {
            $imageErr = "Invalid Image";
        }
    }
    if (empty($nameErr) && empty($amountErr) && empty($detailErr) && empty($imageErr)) {
        $status = $package_controller->updatePackage($id, $name, $amount, $filename, $detail,$buy_name);
        if ($status) {
            echo "<script>location.href='app_package.php'</script>";
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
    <div class="card">
        <div class="card-body">
            <h4 class="card-title my-3">Create New Package</h4>
            <form class="forms-sample" method="post" action="" enctype="multipart/form-data">
                <div class="img-fluid text-center">
                    <img src="../uploads/<?php echo $package['image']; ?>" class="img-fluid rounded mx-auto d-block" style="width: 200px; height: 250px;" id="img">
                    <label class="btn btn-secondary my-2">
                        <i class="ri-camera-line">&nbsp;Choose</i>
                        <input type="file" name="image" id="file_img" hidden>
                    </label>
                    <span class="text-danger"><?php echo $imageErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Package Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName1" value="<?php echo $package['name']; ?>" required>
                    <span class="text-danger"><?php echo $nameErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Amount</label>
                    <input type="text" name="amount" class="form-control" id="exampleInputEmail3" value="<?php echo $package['amount']; ?>" required>
                    <span class="text-danger fs-5"><?php echo $amountErr; ?></span>
                </div>
                <div class="form-group">
                    <label for="">Details</label>
                    <textarea name="details" id="summernote" cols="30" rows="10" class="form-control mb-3"> <?php echo $package['details']; ?> </textarea>
                    <span class="text-danger fs-5"><?php echo $detailErr; ?></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Buying Link</label>
                    <input type="text" name="buy_link" class="form-control" id="exampleInputName1" value="<?php echo $package['buying_link']; ?>" required>
                </div>

                <div class="form-group">

                    <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="cancel" class="btn btn-dark">Cancel</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var file = document.getElementById('file_img');
    var img = document.getElementById('img');

    file.addEventListener('change', (e) => {
        img.src = URL.createObjectURL(e.target.files[0]);
    });
</script>
<?php
include_once __DIR__ . '/../layouts/admin_footer.php';
?>