<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    

    <?php include "partials/_header.php"?>
    <div class="card mb-3 border-0 shadow" style="max-width: 1000px; margin:0 auto; margin-top: 150px">
        <div class="card-header text-white" style="background-color: #FF5678;">
            <h5>Contact Us<h5>
        </div>
        <div class="row no-gutters">

            <div class="col-md-6 p-5 my-5">
                <img src="images/side.svg" class="card-img img-fluid" alt="side image">
            </div>

            <div class="col-md-6 p-3">
                <div class="card-body">
                    <h5 class="card-title">Contact us</h5>
                    <form action="/index.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control rounded-0 border-dark" id="name" name="name" placeholder="Name e.g Rizwan">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control rounded-0 border-dark" id="email" name="email" placeholder="name@example.com">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control rounded-0 border-dark" id="subject" name="subject" placeholder="Subject e.g Query">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control rounded-0 border-dark" id="message" name="message" rows="3" placeholder="Message"></textarea>
                        </div>

                        <button type="submit" class="btn rounded-0 btn-block text-white" style="background-color: #FF5678;">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>