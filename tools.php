<?php
include_once __DIR__ . '/layouts/header.php';
include_once __DIR__ . '/controller/toolsController.php';

$toolsController = new toolsController();
$tools = $toolsController->toollist();
$id = isset($_GET['id']) ? $_GET['id'] : null;

?>
<link rel="stylesheet" href="assets/css/dir.css">

<div class="container bg-white mb-4">
    <div class="container g-0">
        <div class="path col-12 ">
            <ul>
                <li>
                    <a href="tools.php" unlink><i class="ri-folder-2-line">&nbsp;</i>Tools</a>
                </li>

                <?php
                // $_SESSION['toolcat'] = $id;
                // $dir = $toolsController->showTool($id);
                // $_SESSION['tool_cat'] = $dir;

                if ($id != null) {
                    $_SESSION['toolcat'] = $id;
                    $dir = $toolsController->showTool($id);
                    $_SESSION['tool_cat'] = $dir;
                
                    echo '<li>
                                                                                                    <a href=""><i class="ri-folder-2-line">&nbsp;</i>' .
                        $dir['name'] .
                        '</a>
                                                                                                </li>';
                } else {
                    echo '<li>
                                                                                    <a href=""><i class="ri-folder-2-line">&nbsp;</i>Lasted Update</a>
                                                                                </li>';
                }
                
                ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <h2 class="border-bottom p-3 d-flex align-items-center justify-content-center tool_header">MSST Free Tools</h2>
        <aside class="col-lg-4 siderbar bg-white p-0 side_area">
            <ul>
                <li class="box_header justify-content-center d-flex border text-dark">𝓣𝓸𝓸𝓵𝓼 𝓒𝓪𝓽𝓮𝓰𝓸𝓻𝓲𝓮𝓼
                </li>
                <?php
                foreach ($tools as $tool) {
                    echo '<li><a href="tools.php?id=' . $tool['tid'] . '" >' . $tool['tname'] . '<i>&nbsp;(' . $tool['total'] . ')</i></a></li>';
                }
                ?>
            </ul>
        </aside>
        <article class="col-lg-8 content bg-white pt-4" id="show_all_tool_list">
            <?php
            if ($id !== null) {

                $tool_by_cat = $toolsController->gettAllToolByCat($id);
                foreach ($tool_by_cat as $item) {

            ?>

            <a href="tool_download.php?id=<?php echo $item['id']; ?>">
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
                $lasteds = $toolsController->latestPost();
                echo '<h4 class="text-center text-dark">🅻🅰🆂🆃🅴🅳 🅿🅾🆂🆃</h4><hr>';
                foreach ($lasteds as $lasted) {

                ?>
            <a href="tool_download.php?id=<?php echo $lasted['id']; ?>">
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
