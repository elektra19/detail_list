<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/packageController.php';
include_once __DIR__ . '/../controller/tutorialsController.php';

$package_controller = new PackageController();
$packages = $package_controller->getPackage();

$tuto_controller = new tutorialsController();

?>

<section class="col-md-10 mx-auto">

    <?php
if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $package = $_POST['package'];
    $uploadDir = '../uploads/videos/';
    $vid_name = $_FILES['video']['name'];
    $vid_tmp_name = $_FILES['video']['tmp_name'];
    $videoUniqueName = uniqid() . '_' . $vid_name;
    $vidFileType = strtolower(pathinfo($vid_name, PATHINFO_EXTENSION));

    if (in_array($vidFileType, ['mp4', 'avi', 'mov'])) {
        $video = move_uploaded_file($vid_tmp_name, $uploadDir . $videoUniqueName);

        if (empty($package)) {
            $package = null;
        }

        $upload = $tuto_controller->uploadTuto($title, $videoUniqueName, $desc, $package);

        if ($upload) {
            echo '<script>location.href = \'app_tutorials.php\';</script>';
        } else {
            echo 'Upload error';
        }
    } else {
        echo 'Invalid video file format. Please upload an mp4, avi, or mov file.';
    }
}

    ?>
    <h4 class="card-title my-2">Tutorials</h4>
    <p class="card-description"> Admin<code>/tutorials/upload tutorial</code></p>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control" required><br>

        <label for="summernote">Description:</label>
        <textarea name="description" id="summernote" class="form-control"></textarea><br>

        <!-- <label for="video">Choose a video file:</label> -->
        <!-- <input type="file" name="video" id="video" accept="video/*" class="form-control text-white" required><br> -->

        <label for="">Choose a video file:</label><br>
        <video src="../uploads/videos/<?php echo $show_tuto['video_url']; ?>" class="object-fit-cover" controls style="width: 500px;display:none;" id="vid"></video>
        <label class="btn btn-secondary my-2">
            <i class="ri-video-line text-primary">&nbsp;Choose Video</i>
            <input type="file" name="video" id="file_vid" accept="video/*" required hidden>
        </label><br><br>

        <label for="package">Choose Package</label>
        <select name="package" id="package" class="form-control text-white">
            <option selected hidden disabled>--choose your packaget--</option>
            <option value="">Free</option>
            <?php
            foreach ($packages as $package) {
                echo '<option value="' . $package['id'] . '">' . $package['name'] . '</option>';
            }
            ?>
        </select><br>

        <button type="submit" class="btn btn-success" name="upload">Upload</button>
    </form>
</section>

<?php
include_once __DIR__ . '/../layouts/admin_footer.php';
?>
<script type="text/javascript">
    var file = document.getElementById('file_vid');
    var vid = document.getElementById('vid');

    file.addEventListener('change', (e) => {
        vid.src = URL.createObjectURL(e.target.files[0]);
        vid.style.display = 'block';
    });
</script>