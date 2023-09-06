<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/tutorialsController.php';

$tuto_controller = new tutorialsController();
$all_tutos = $tuto_controller->getAllTuto();

?>


<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Tutorials</h4>
            <p class="card-description"> Admin<code>/tutorials</code></p>
            <a href="tutorial_add.php" class="btn btn-outline-success my-3">Add New Tutorial +</a>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Title</th>
                            <th> Description</th>
                            <th> Video</th>
                            <th> Package</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($all_tutos as $tuto) {
                            $package = $tuto['package_id'];
                            $title = $tuto['title'];
                            $description = $tuto['description'];
                            $video_url = $tuto['video_url'];
                        
                            echo '<tr>';
                            echo '<td>' . $count++ . '</td>';
                            echo '<td>' . $title . '</td>';
                            echo '<td>' . substr($description, 0, 35) . ' more...</td>';
                            echo '<td>' . $video_url . '</td>';
                            if ($package == null) {
                                echo '<td> Free</td>';
                            } else {
                                echo '<td>' . $tuto['name'] . '</td>';
                            }
                            echo '<td id=' .
                                $tuto['id'] .
                                '>
                                                                                <a class="btn btn-outline-primary mx-3" href="tutorial_edit.php?id=' .
                                $tuto['id'] .
                                '"><i class="ri-pencil-line"></i>Edit</a>
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
