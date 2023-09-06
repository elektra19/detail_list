<?php
include_once __DIR__ . '/layouts/header.php';
include_once __DIR__ . '/controller/tutorialsController.php';
include_once __DIR__ . '/controller/registerController.php';
include_once __DIR__ . '/controller/saleController.php';

$tuto_controller = new tutorialsController();
$freetutorials = $tuto_controller->getFreeTuto();

$reg_controller = new RegisterController();
$sale_controller = new saleController();
?>

<div class="container bg-white shadow py-4">
    <form class="row mb-4">
        <div class="col-md-4 d-flex">
            <input class="form-control me-2 shadow-none" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary rounded-1" type="submit">Search</button>
        </div>
        <div class="col-md-7 mx-auto d-flex justify-content-between ms-4">
            <!-- Your sorting dropdown will be moved here -->
            <div></div> <!-- This empty div will push the dropdown to the end -->
            <div class="dropdown">
                <button class="btn  rounded-1 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort By
                </button>
                <ul class="dropdown-menu w-25 bg-white">
                    <li><a class="dropdown-item text-dark" href="#">Date</a></li>
                    <li><a class="dropdown-item text-dark" href="#">Name</a></li>
                    <li><a class="dropdown-item text-dark" href="#">Package</a></li>
                </ul>
            </div>
        </div>
    </form>



    <?php
    if (isset($acc_id)) {
        $user = $reg_controller->getUser($email);
        $id = $user['id'];
        $sid = $sale_controller->getSaleUser($id);
        // var_dump($sid);
        if ($id == $sid['user_id']) {
            // echo $sid['packages_id'];
            $ptutos = $tuto_controller->getTutoByPack($sid['packages_id']);
            foreach ($ptutos as $ptuto) {


    ?>

                <div class="card-body row mb-2 main_card">
                    <div class="col-lg-5 d-flex flex-column align-items-center p-2">
                        <div class="position-relative">
                            <video id="myVideo2" src="uploads/videos/<?php echo $ptuto['video_url']; ?>" class="shadow rounded-1" width="100%" height="100%" controls></video>
                            <!-- <span class="position-absolute top-0 start-0 text-center px-2 text-white" style="letter-spacing: 2px;background-color: #00b300;">
                            hehe
                            </span> -->

                            <?php
                            if ($ptuto['package_id'] == "")
                                echo '<span class="position-absolute top-0 start-0 text-center px-2 text-white" style="letter-spacing: 2px;background-color: #00b300;">
                            Free
                            </span>';
                            else
                                echo '<span class="position-absolute top-0 start-0 text-center px-2 text-white" style="letter-spacing: 2px;background-color: #ff0000;">
                            ' . $ptuto['name'] . '
                            </span>';
                            // echo $ptuto['package_id'] ;
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-7 p-4">
                        <h4 class="col-10 d-block"><?php echo $ptuto['title']; ?></h4>
                        <?php echo $ptuto['description']; ?>



                        <a href="https://matix.li/1a47ca03e5e1" class="btn btn-sm rounded-1 justify-content-between mt-3" id="down_btn">Download Video&nbsp;&nbsp;<i class="ri-download-2-fill"></i></a>
                    </div>
                </div>
            <?php
            }
        }
    } else {
        foreach ($freetutorials as $freetuto) {
            ?>

            <div class="card-body row mb-2 main_card">
                <div class="col-lg-5 d-flex flex-column align-items-center p-2">
                    <div class="position-relative">
                        <video id="myVideo2" src="uploads/videos/<?php echo $freetuto['video_url']; ?>" class="shadow rounded-1" width="100%" height="100%" controls></video>
                        <span class="position-absolute top-0 start-0 text-center px-2 text-white" style="letter-spacing: 2px;background-color: #00b300;">Free</span>
                    </div>
                </div>

                <div class="col-lg-7 p-4">
                    <h4 class="col-10 d-block"><?php echo $freetuto['title']; ?></h4>
                    <?php echo $freetuto['description']; ?>

                    <a href="https://matix.li/1a47ca03e5e1" class="btn btn-sm rounded-1 justify-content-between mt-3" id="down_btn">Download Video&nbsp;&nbsp;<i class="ri-download-2-fill"></i></a>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <div class="d-flex justify-content-center ">
        <button class="btn btn-primary border-0 my-5 rounded-1">Load more ...</button>
    </div>
</div>
</div>
<?php
include_once __DIR__ . '/layouts/footer.php';
?>