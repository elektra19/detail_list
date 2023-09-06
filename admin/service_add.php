<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/serviceController.php';

$service_controller = new serviceController();

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $addfaq = $service_controller->createfaq($title, $content);
    if ($addfaq) {
        echo '<script>location.href = \'app_service.php\';</script>';
    } else {
        echo 'You Cant\'t create new brand';
    }
}

?>

<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">FAQ</h4>
            <p class="card-description"> Admin<code>/FAQ/add new faq</code></p>
            <div class="table-responsive">
                <form action="" class="p-3" method="post">
                    <label for="title">Title</label>
                    <input type="text" class="form-control mb-3" name="title" id="title" autocomplete="off" required>

                    <label for="summernote">Content</label>
                    <div class="bg-dark">
                        <textarea name="content" class="text-dark" id="summernote" cols="30" rows="10" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success mt-2" name="add">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../layouts/admin_footer.php';
?>