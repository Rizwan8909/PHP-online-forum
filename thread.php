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
    <?php include 'partials/_dbConnection.php' ?>

  
    <?php

        // Fetching discussions from db with the help of loop
        $id = $_GET['threadid'];
        $sql = 'SELECT * FROM `threads` WHERE thread_id = '.$id .' ';
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while($row=mysqli_fetch_assoc($result)){
            $noResult = false;
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];           
        }

        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid bg-light">
                        <div class="container">
                        <h1 class="display-4">No results found! :(</h1>
                        <p class="lead">Be the first person to start the discussion.</p>
                    </div>
                    </div>';
        }
    ?>
    <!-- Jumbotron -->

    <div class="container">
        <div class="jumbotron jumbotron-fluid bg-white">
            <div class="container">
                <h1 class="display-4"><?php echo $thread_title;?></h1>
                <p class="lead"><?php echo $thread_desc;?></p>
                <hr class="my-4">
                <p class="font-weight-bold">posted by: rizwan</p>    
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light">
        <div class="container">
            <h3 class="mb-2">Discussions.</h3>
            <div class="line" style="margin: 0"></div>



            <!-- Questions Dynamically from the database -->

        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>