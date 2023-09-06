<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .form-control:focus{
            box-shadow: none;
        }

        ;
    </style>
</head>

<body>
    <div class="container py-5" style="background: #f5f5f5;">
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-6 text-info"><i>Payment</i></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card border-info">
                    <div class="card-header">
                        <!-- credit card info-->
                        <div class="form-group ">
                            <label for="selecttype">
                                <h6><i>Select your Payment</i></h6>
                            </label>
                            <select class="form-control border border-info" id="selecttype">
                                <option value="" class="text-secondary" selected disabled hidden>--Select Your Payment--</option>
                                <option>Wave Money</option>
                                <option>Kpay</option>
                                <option>Ok Dollor</option>
                            </select>
                        </div>
                        <form role="form">

                            <div class="form-group">
                                <label for="username">
                                    <h6><i>Owner</i></h6>
                                </label>
                                <input type="text" name="username" id="username" placeholder="Account Name" required class="form-control border border-info" spellcheck="true">
                            </div>

                            <div class="form-group">
                                <label for="accnumber">
                                    <h6><i>Account number</i></h6>
                                </label>
                                <div class="input-group">
                                    <input type="tel" name="accnumber" id="accnumber" placeholder="Account number" class="form-control border border-info" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-block btn-primary"> Confirm Payment </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>