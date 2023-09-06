<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/serviceController.php';

$service_controller = new serviceController();
$faqs = $service_controller->getAllfaq();


?>


<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">FAQ</h4>
            <p class="card-description"> Admin<code>/faq</code></p>
            <a href="service_add.php" class="btn btn-outline-success my-3">Add New F&Q</a>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Title</th>
                            <th> Content</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($faqs as $faq) {
                            echo '<tr>';
                            echo '<td>' . $count++ . '</td>';
                            echo '<td>' . $faq['title'] . '</td>';
                            echo '<td>' . substr($faq['content'],0,60) . ' more..</td>';
                            echo '<td id=' . $faq['id'] . '>
                                <a class="btn btn-outline-primary mx-3" href="service_edit.php?id=' . $faq['id'] . '"><i class="ri-pencil-line"></i>Edit</a>
                                <a class="btn btn-outline-danger delete_btn_ajax" href="javascript:void(0)"><i class="ri-delete-bin-2-line"></i>Delete</a>
                            </td>';
                            echo '</tr>';
                        }

                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once __DIR__ . '/../layouts/admin_footer.php';
?>