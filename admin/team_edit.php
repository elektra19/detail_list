<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/teamController.php';

$id = $_GET['id'];
$team_controller = new teamController();
$showmember = $team_controller->getMemberById($id);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $discription = $_POST['desc'];
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

            $file_upload = move_uploaded_file($temp_name, '../uploads/team/' . $file_name);
        }
    } else {
        // No new image uploaded, set $file_name to the existing image name
        $file_name = $showmember['image'];
    }

    $update = $team_controller->updateTeamMember($id, $name, $role, $discription, $file_name);

    if ($update) {
        echo '<script>location.href = \'app_team.php\';</script>';
    }
}
?>


<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Teams</h4>
            <p class="card-description"> Admin<code>/members/add_new_member</code></p>
            <div class="table-responsive">

                <form action="" class="p-3" method="post" enctype="multipart/form-data">
                    <div class="img-fluid text-center">
                        <img src="../uploads/team/<?php echo $showmember['image'] ?>" class="img-fluid rounded-circle mx-auto d-block" style="width: 200px; height: 200px;" id="img">

                        <label class="btn btn-secondary my-2">
                            <i class="ri-camera-line">&nbsp;Choose</i>
                            <input type="file" name="image" id="fileimg" hidden>
                        </label>
                    </div>

                    <label for="name">Name</label>
                    <input type="text" class="form-control mb-3 text-white" name="name" id="name" autocomplete="off" value="<?php echo $showmember['name']; ?>">

                    <label for="role">Role</label>
                    <input type="text" class="form-control mb-3 text-white" name="role" id="role" autocomplete="off" value="<?php echo $showmember['role']; ?>">

                    <label for="name">Description</label>
                    <textarea name="desc" id="summernote" cols="30" rows="10"><?php echo $showmember['discription']; ?></textarea>
                    <br>

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
    var file = document.getElementById('fileimg');
    var img = document.getElementById('img');

    file.addEventListener('change', (e) => {
        img.src = URL.createObjectURL(e.target.files[0]);
    });
</script>