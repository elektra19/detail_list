<?php
include_once __DIR__ . '/layouts/header.php';
include_once __DIR__ . '/controller/boxController.php';

$box_controller = new boxController();
$boxs = $box_controller->boxlist();

$id = isset($_GET['id']) ? $_GET['id'] : null;

?>
<link rel="stylesheet" href="assets/css/dir.css">

<div class="container bg-white mb-5">
    <div class="container g-0">
        <div class="path col-12 ">
            <ul>
                <li>
                    <a href="box.php" unlink><i class="ri-folder-2-line">&nbsp;</i>Box</a>
                </li>

                <?php
                    $dir = $box_controller->showBox($id);
                    $_SESSION['box_cat'] = $dir;
                if ($id != null) {
                    // $boxt_cat = $_SESSION['box_cat'];
                    echo '<li>
                                    <a href=""><i class="ri-folder-2-line">&nbsp;</i>' .
                        $dir['name'] .
                        '</a>
                                </li>';
                } elseif ($id == null) {
                    echo '<li>
                                    <a href=""><i class="ri-folder-2-line">&nbsp;</i>Lasted Update</a>
                                </li>';
                }
                ?>

            </ul>
        </div>
    </div>
    <div class="row">
        <h2 class="border-bottom p-3 d-flex align-items-center justify-content-center tool_header">MSST Free Crack Box
        </h2>
        <aside class="col-lg-4 siderbar bg-white p-0 side_area">
            <ul>
                <li class="box_header justify-content-center d-flex border ">𝓑𝓸𝔁 𝓒𝓪𝓽𝓮𝓰𝓸𝓻𝓲𝓮𝓼</li>

                <?php
                foreach ($boxs as $box) {
                    echo '<li><a href="box.php?id=' . $box['tid'] . '">' . $box['bname'] . '&nbsp;&nbsp;&nbsp;(' . $box['total'] . ')</a></li>';
                }
                ?>

            </ul>
        </aside>
        <article class="col-lg-8 content bg-white pt-4 ">

            <?php

            if ($id !== null) {
                $box_by_cat = $box_controller->showByCat($id);

                foreach ($box_by_cat as $item) {
            ?>
            <a href="box_download.php?id=<?php echo $item['id']; ?>">
                <div class="card-body row g-0 tool_area">
                    <div class="col-lg-5 d-flex flex-column align-items-center justify-content-center p-2">
                        <img id="myVideo2" src="uploads/<?php echo $item['image']; ?>" class="shadow rounded-0" width="300px"
                            height="150px" controls></img>

                    </div>
                    <div class="col-lg-7 p-3 pt-4">
                        <h4><?php echo $item['name']; ?></h4>
                        <p>
                            <?php echo substr($item['post'], 0, 80); ?>
                            <span></span>
                            <span class="text-primary">&nbsp;more details...</span>
                        </p>
                    </div>
                </div>
            </a>
            <?php
                }
            } else {
                $lasteds = $box_controller->latestPost($id);
                echo '<h4 class="text-dark text-center">🅻🅰🆂🆃🅴🅳 🅿🅾🆂🆃</h4><hr>';
                foreach ($lasteds as $lasted) {
                ?>

            <a href="box_download.php?id=<?php echo $lasted['id']; ?>">
                <div class="card-body row g-0 tool_area">
                    <div class="col-lg-5 d-flex flex-column align-items-center justify-content-center p-2">
                        <img id="myVideo2" src="uploads/<?php echo $lasted['image']; ?>" class="shadow rounded-0" width="300px"
                            height="150px" controls></img>

                    </div>
                    <div class="col-lg-7 p-3 pt-4">
                        <h4><?php echo $lasted['name']; ?></h4>
                        <p>
                            <?php echo substr($lasted['post'], 0, 80); ?>
                            <span></span>
                            <span class="text-primary">&nbsp;more details...</span>
                        </p>
                    </div>
                </div>
            </a>
            <?php
                }
            }
            ?>
        </article>
    </div>
</div>

<?php
include_once __DIR__ . '/layouts/footer.php';
?>
