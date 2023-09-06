<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/teamController.php';

$team_controller = new teamController();

if (isset($_POST['add'])) {
    // Check if a file was uploaded
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $name = $_POST['name'];
        $role = $_POST['role'];
        $description = $_POST['desc'];

        $uploadDirectory = '../uploads/team/';

        $uniqueFileName = uniqid() . '_' . $_FILES['image']['name'];
        $targetFilePath = $uploadDirectory . $uniqueFileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $add = $team_controller->insertTeamMember($name, $role, $description, $uniqueFileName);
            if ($add) {
                echo '<script>location.href = \'app_team.php\';</script>';
            } else {
                echo 'You Cant\'t create new member';
            }
        } else {
            echo 'File upload failed.';
        }
    } else {
        echo 'Please choose an image to upload.';
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
                        <img src="../assets/images/" class="img-fluid rounded-circle mx-auto"
                            style="width: 200px; height: 200px;display:none;" id="img">

                        <label class="btn btn-secondary my-2">
                            <i class="ri-camera-line">&nbsp;Choose</i>
                            <input type="file" name="image" id="fileimg" hidden>
                        </label>
                    </div>

                    <label for="name">Name</label>
                    <input type="text" class="form-control mb-3" name="name" id="name" autocomplete="off">

                    <label for="role">Role</label>
                    <input type="text" class="form-control mb-3" name="role" id="role" autocomplete="off">

                    <label for="name">Description</label>
                    <textarea name="desc" id="summernote" cols="30" rows="10"></textarea>
                    <br>

                    <button type="submit" class="btn btn-success" name="add">Add</button>
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
        img.style.display = 'block';
    });
</script>
