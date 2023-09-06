<?php
include_once __DIR__ . '/../layouts/admin_sidebar.php';
include_once __DIR__ . '/../controller/teamController.php';

$team_controller = new teamController();
$teams = $team_controller->getAllMember();




?>

<div class="col-12 grid-margin stretch-card">
    <div class="card p-5">
        <div class="card-body">
            <h4 class="card-title my-2">Team Members</h4>
            <p class="card-description"> Admin<code>/members</code></p>

            <a class="btn btn-outline-success my-3" href="team_add.php">Add New Member +</a>

            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Name</th>
                            <th> Profile</th>
                            <th> Role</th>
                            <th> Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($teams as $team) {
                            echo '<tr>';
                            echo '<td>' . $count++ . '</td>';
                            echo '<td>' . $team['name'] . '</td>';
                            // echo '<td>' . $get_model['image'] . '</td>';
                            echo '<td><img src="../uploads/team/'     . $team['image'] .  '"style="width: 60px;height:60px;"class="rounded-0"></td>';

                            echo '<td>' . $team['role'] . '</td>';
                            echo '<td>' . substr($team['discription'],0,40) . ' More...</td>';
                            echo '<td id=' . $team['id'] . '>
                                    <a class="btn btn-outline-primary mx-3" href="team_edit.php?id=' . $team['id'] . '">
                                        <i class="ri-pencil-line"></i>Edit
                                    </a>

                                    <a class="btn btn-outline-danger delete_btn_ajax" href="">
                                        <i class="ri-delete-bin-2-line"></i>Delete
                                    </a>
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