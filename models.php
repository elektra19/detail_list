<?php
include_once __DIR__ . '/layouts/header.php';
include_once __DIR__ . '/controller/modelsController.php';
include_once __DIR__ . '/controller/brandsController.php';

$id = $_GET['id'];

$_SESSION['brand_id'] = $id;
$brand_id =  $_SESSION[ 'brand_id'];

// if(isset($brand_id == ))

$models_controller = new modelsController();
$models = $models_controller->showModels($id);

// $dir = $models_controller->dir($id);

$brands_controller = new brandsController();
$brands = $brands_controller->getAllBrands();


?>
<link rel="stylesheet" href="assets/css/dir.css">
<section>
    <div class="container">
        <div class="path col-12">
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
            </ul>
        </div>
    </div>
    <div class="container-fluid" style="background-color: whitesmoke;">
        <div class="container py-5 ">
            <div class="row">
                <?php
                foreach ($models as $model) {

                ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 newgrid text-center models shadow">
                        <?php
                        echo '<a href="firm_list_model.php?id=' . $model['id'] . '">';
                        ?>
                        <img src="uploads/<?php echo $model['image']; ?>" alt="" class="img-fluid w-100" style="width: 200px; height: 180px">

                        </a>
                        <h5 class=""><?php echo $model['name'] ?></h5>
                        <!-- <hr> -->
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

</section>

<?php
include_once __DIR__ . '/layouts/footer.php';
?>