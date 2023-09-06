<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/packageController.php';
include_once __DIR__ . '/../controller/tutorialsController.php';

$id = $_GET['id'];
$package_controller = new PackageController();
$packages = $package_controller->getPackage();

$tuto_controller = new tutorialsController();
$show_tuto = $tuto_controller->showTuto($id);

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $package = $_POST['package'];
    // $vid_name = $show_tuto['video_url'];

    if ($_FILES['video']['error'] == 0) {
        $uploadDir = '../uploads/videos/';
        $vid_name = $_FILES['video']['name'];
        $vid_tmp_name = $_FILES['video']['tmp_name'];
        $vidFileType = strtolower(pathinfo($vid_name, PATHINFO_EXTENSION));

        if (in_array($vidFileType, ['mp4', 'avi', 'mov'])) {
            $vid_name = uniqid() . '_' . $vid_name;
            $video = move_uploaded_file($vid_tmp_name, $uploadDir . $vid_name);
        }
    } else {
        $vid_name = $show_tuto['video_url'];
    }

    if ($package === '') {
        $package = null;
    }
    $upload = $tuto_controller->updateTuto($id, $title, $vid_name, $desc, $package);
    if ($upload) {
        echo '<script>location.href = \'app_tutorials.php\';</script>';
    }
}
?>
<section class="col-md-10 mx-auto mb-5">

    <h4 class="card-title my-2">Tutorials</h4>
    <p class="card-description"> Admin<code>/tutorials/update tutorial</code></p>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control text-white" required
            value="<?php echo $show_tuto['title']; ?>"><br>

        <label for="summernote">Description:</label>
        <textarea name="description" id="summernote" class="form-control text-white"><?php echo $show_tuto['description']; ?></textarea><br>

        <label for="">Choose a video file:</label><br>
        <video src="../uploads/videos/<?php echo $show_tuto['video_url']; ?>" class="object-fit-cover" controls style="width: 500px;"
            id="vid"></video><br>
        <!-- <p><?php echo $show_tuto['video_url']; ?></p> -->
        <label class="btn btn-secondary my-2">
            <i class="ri-video-line text-primary">&nbsp;Choose Video</i>
            <input type="file" name="video" id="file_vid" accept="video/*" hidden>
        </label>

        <br><br>

        <label for="package">Choose Package</label>
        <select name="package" id="package" class="form-control text-white">
            <?php
            if ($show_tuto['package_id'] === null) {
                echo '<option value="" selected class="text-success">Free</option>';
                foreach ($packages as $package) {
                    echo '<option value="' . $package['id'] . '">' . $package['name'] . '</option>';
                }
            } else {
                echo '<option value="">Free</option>';
                foreach ($packages as $package) {
                    if ($package['id'] === $show_tuto['package_id']) {
                        echo '<option value="' . $package['id'] . '" selected class="text-success">' . $package['name'] . '</option>';
                    } else {
                        echo '<option value="' . $package['id'] . '">' . $package['name'] . '</option>';
                    }
                }
            }
            ?>
        </select><br>

        <button type="submit" class="btn btn-success" name="update">Update</button>

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
    });
</script>
