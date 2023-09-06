<?php
include_once __DIR__ . '/../controller/contactController.php';

$contact_controller = new contactController();
$data = $contact_controller->getcontact();

?>
<!--footer section start-->
<section class="container-fluid bg-dark  g-0 p-0 " id="about">
    <div class="container g-0 ">
        <div class="row py-1">
            <span class="display-6 justify-content-center d-flex text-white py-5">Address...&nbsp;<img src="assets/images/logo_white.png" class="mt-2" alt="Bootstrap" style="width: 30px; height: 24px"></span>
            <div class="col-md-6">
                <div class="row footer p-3 address">
                    <div class="col-md-5 d-flex flex-column">
                        <span><i class="ri-mail-send-line">&nbsp;&nbsp;</i>Mail&nbsp;&nbsp;:</span>

                        <span><i class="ri-phone-line">&nbsp;&nbsp;</i>Phone Number&nbsp;&nbsp;&nbsp;:</a></span>

                        <span><i class="ri-map-pin-2-line">&nbsp;&nbsp;</i>Address&nbsp;&nbsp;:</a></span>
                    </div>
                    <div class="col-md-7 d-flex flex-column">
                        <?php
                        foreach ($data as $item) {
                            echo '<a href="#" id="email">' . $item['email'] . '</a>';
                            echo '<a href="#">+95' . $item['phone_number'] . '</a>';
                            echo '<a href="#">' . $item['address'] . '</a>';

                        ?>

                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="row footer p-3">
                    <div class="col-md-6 d-flex social_link">

                        <a href="<?php echo $item['facebook'] ?>" target="_blank" id="facebook" class="px-3" target="_blank"><i class="ri-facebook-box-line">&nbsp;</i>Facebook</a>

                        <a href="<?php echo $item['youtube'] ?>" class="px-3" id="youtube" target="_blank"><i class="ri-youtube-line">&nbsp;</i>Youtube</a>

                        <a href="<?php echo $item['twitter'] ?>" class="px-3" id="twitter" target="_blank"><i class="ri-twitter-line">&nbsp;</i>Twitter</a>
                    </div>
                <?php } ?>
                </div>

            </div>
        </div>
    </div>
</section>

<section class=" container-fluid mb-0 pb-0 text-center footer_copy">
    <span class="p-1 d-block">MSST @copyright | 2023</span>
</section>


<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/tether.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="assets/js/myscript.js"></script>
<script type="text/javascript" src="assets/js/log_myscript.js"></script>


</body>
<script>
    new WOW().init();
</script>

</html>