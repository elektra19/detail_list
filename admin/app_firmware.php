<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/firmwaresController.php';

$firmware_controller = new firmwaresController();
$firmwares = $firmware_controller->getAllFirmware();

?>


<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Firmwares</h4>
            <p class="card-description"> Admin<code>/firmwares</code></p>
            <a href="firmware_add.php" class="btn btn-outline-success my-3">Add New firmwares +</a>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th> </th>
                            <th> No</th>
                            <th> Name</th>
                            <th> Download Link</th>
                            <th> MIUI</th>
                            <th> Android Version</th>
                            <th> Size</th>
                            <th> Type</th>
                            <th> Content</th>
                            <th> Model</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($firmwares as $firmware) {

                            echo '<tr>';
                            echo '<td id='.$firmware['id'].'>
                                    <a class="btn btn-sm btn-outline-primary mx-2 text-center" href="firmware_edit.php?id='.$firmware['id'].'">
                                        <i class="ri-pencil-line"></i>
                                    </a>

                                    <a class="btn btn-sm btn-outline-danger delete_btn_ajax" href="">
                                        <i class="ri-delete-bin-2-line"></i>
                                    </a>
                                </td>';

                            echo '<td>' . $count++ . '</td>';
                            echo '<td>' . $firmware['name'] . '</td>';
                            echo '<td>' . substr($firmware['download_link'],0,40) . '</td>';
                            echo '<td>' . $firmware['miui_version'] . '</td>';
                            echo '<td>' . $firmware['android_version'] . '</td>';
                            echo '<td>' . $firmware['size'] . '</td>';
                            echo '<td>' . $firmware['type'] . '</td>';
                            echo '<td>' . substr($firmware['details'],0,70) . '&nbsp;more...</td>';
                            echo '<td>' . $firmware['model'] . '</td>';
                            // echo '<td id='.$firmware['id'].'>
                            //         <a class="btn btn-outline-primary mx-3" href="firmware_edit.php?id='.$firmware['id'].'">
                            //             <i class="ri-pencil-line"></i>Edit
                            //         </a>

                            //         <a class="btn btn-outline-danger delete_btn_ajax" href="">
                            //             <i class="ri-delete-bin-2-line"></i>Delete
                            //         </a>
                            //     </td>';


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