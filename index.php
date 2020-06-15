<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>F4Forum</title>
</head>

<body style="overflow-x: hidden;">


    <?php include 'partials/_header.php'; ?>
   
    <?php include 'partials/_dbConnection.php'?>

    <!-- Main slider -->
    <div class="jumbotron row bg-white container m-auto">

        <div class="col-md-7 my-5 textSlide">
            <h1 class="display-4">Welcome User</h1>
            <p class="lead">This is an online for developers to help them. Solutions of thousand of problems with 1k+ developers team.</p>
            <hr class="my-4">
            <p>Browser the catergories from the dropdown. Or some of them are available below</p>
            <a class="btn btn-lg rounded-0 m-1 text-white" href="#" role="button" style="background-color: #FF5678;">Get Started</a>
            <a class="btn btn-lg rounded-0 m-1" href="#" role="button" style="border: 2px solid #FF5678;">Learn More</a>
        </div>

        <div class="col-md-5 m-auto fadeImage">
            <img class="img-fluid" src="images/reading.svg" alt="">
        </div>
    </div>


    <!-- Cards -->

    <div class="bg-light p-5 col-md-12">
        <h2 class="text-center">Browse from categories</h2>
        <div class="line" style=" margin: 0 auto; margin-bottom: 30px;"></div>


        <div class="row container m-auto">
            
            <!-- Fetch all categories in card using loop -->
            <?php
                $sql = 'SELECT * FROM `categories`';
                $result = mysqli_query($conn, $sql);

                // Loop do display all categories
                while($row = mysqli_fetch_assoc($result)){
                    
                    $id = $row['category_id'];
                    $category = $row['category_title'];
                    $description = $row['category_description'];

                    echo '<div class="card border-0 m-4 hover" style="width: 20rem;">
                            <img src="https://source.unsplash.com/1600x1200/?code,'. $category .'" class="card-img-top rounded-0" alt="...">
                             <div class="card-body p-3">
                                <h5 class="card-title">'. $category .'</h5>
                                <p class="card-text">'. substr($description, 0, 90) .'...</p>
                                <a href="/Forum/threadList.php?categoryid= '. $id .'" class="btn btn-block rounded-0 text-white" style="background-color: #FF5678;">View threats</a>
                            </div>
                        </div>';

                        // Question mark in href is used to pass id

                }
            ?>
           

        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>