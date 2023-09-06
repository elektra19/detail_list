<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/toolsController.php';


$id = $_GET['id'];
$toolsController = new toolsController();
$show_tool = $toolsController->showTool($id);

if (isset($_POST['update'])) {
    $name = $_POST['name'];

    $update_tool = $toolsController->updateTool($id, $name);
    if ($update_tool) {
        echo '<script>location.href=\'app_tools.php\'</script>';
    }else{
        echo 'error';
    }
}
?>


<div class="col-12 grid-margin stretch-card mt-5" f>
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Tools</h4>
            <p class="card-description"> Admin<code>/category/update_your_name</code></p>
            <div class="table-responsive">
                <form action="" class="p-3" method="post">

                    <label for="name">Name</label>
                    <input type="text" class="form-control text-white mb-3" name="name" id="name"
                        autocomplete="off" value="<?php echo $show_tool['name']; ?>">

                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../layouts/admin_footer.php';
?>
