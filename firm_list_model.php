<?php
include_once __DIR__ . '/layouts/header.php';
include_once __DIR__ . '/controller/firmwaresController.php';
// include_once __DIR__ . '/controller/firmsController.php';
include_once __DIR__ . '/controller/modelsController.php';
include_once __DIR__ . '/controller/brandsController.php';
$id = $_GET['id'];

$_SESSION['model_id'] = $id;
$brand_id = $_SESSION['brand_id'];
$model_id = $_SESSION['model_id'];

// $id = $_GET['id'];
$firmware_controller = new firmwaresController();
$fim_list_by_model = $firmware_controller->fimByModels($id);
// var_dump($fim_list_by_model);

// $firms_controller = new firmsController();
// $firminfo = $firms_controller->firms($id);
// var_dump($firminfo);
// echo "<br>";
// foreach($firminfo as $item){
//     echo $item['brand_name'];
//     echo $item['model_name'];
// }
$brands_controller = new brandsController();
$brands = $brands_controller->getAllBrands();

$models_controller = new modelsController();
$models = $models_controller->getAllModels();
?>
<link rel="stylesheet" href="assets/css/dir.css">

<section class="container-fluid g-0">
    <div class="container g-0">
        <div class="path col-12 ">
            <ul>
                <li>
                    <a href=""><i class="ri-folder-2-line">&nbsp;</i>firmwares</a>
                </li>
                <li>
                    <a href="models.php?id=<?php echo $brand_id ?>"><i class="ri-folder-2-line">&nbsp;</i>
                        <?php

                        foreach ($brands as $brand) {
                            if ($brand_id == $brand['id']) {
                                echo $brand['name'];
                            }
                        }

                        ?>
                    </a>
                </li>
                <li>
                    <a href="firm_list_model.php?id=<?php echo $model_id ?>"><i class="ri-folder-2-line">&nbsp;</i>
                        <?php

                        foreach ($models as $model) {
                            if ($model_id == $model['id']) {
                                echo $model['name'];
                            }
                        }

                        ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid g-0 py-5" style="background-color: whitesmoke;">

        <div class="container g-0">

            <table class="table shadow">
                <thead>
                    <tr class="models_header">
                        <th scope="col">Name</th>
                        <!-- <th scope="col">MIUI Version</th> -->
                        <th scope="col">Android Version</th>
                        <th scope="col">File Size</th>
                        <!-- <th scope="col">Type</th> -->
                        <th scope="col">Date</th>
                        <th scope="col">Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (empty($fim_list_by_model)) {
                        echo '<tr>';
                        echo '<td colspan="7">No firmware available!</td>';
                        echo '</tr>';
                    } else {
                        foreach ($fim_list_by_model as $item) {
                            echo '<tr>';

                            echo '<td>' . $item['name'] . '</td>';
                            // echo '<td>' . $item['miui_version'] . '</td>';
                            echo '<td>' . $item['android_version'] . '</td>';
                            echo '<td>' . $item['size'] . '</td>';
                            // echo '<td>' . $item['type'] . '</td>';
                            echo '<td>' . date('Y-m-d', strtotime($item['created_at'])) . '</td>';
                            echo '<td><a href="firmware_download.php?id=' . $item['id'] . '" class="btn btn-sm modeldown"><i class="ri-file-download-line">&nbsp;</i>Download</a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>

                </tbody>
            </table>
            <!-- <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link bg-secondary-subtle" href="#">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link bg-secondary-subtle" href="#">Next</a>
            </li>
        </ul> -->
        </div>
    </div>
</section>

<?php
include_once __DIR__ . '/layouts/footer.php';
?>