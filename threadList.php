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

    <?php include 'partials/_dbConnection.php' ?>
    <?php include 'partials/_header.php'; ?>
   

    <!-- Getting data from index.php -->
    <?php
    $id = $_GET['categoryid'];

    $sql = 'SELECT * FROM `categories` WHERE category_id = ' . $id . ' ';
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $category_name = $row['category_title'];
        $category_desc = $row['category_description'];
    }
    ?>


    <!-- Record / Question insertion to the databse -->
    <?php
    $showAlert = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $sno = $_POST['user_id'];

        // Securing website from XSS attack by replacing tags <>
        $title = str_replace("<", "&lt", $title);
        $title = str_replace(">", "&gt", $title);

        $desc = str_replace("<", "&lt", $desc);
        $desc = str_replace(">", "&gt", $desc);

        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
                VALUES ('$title', '$desc', '$id', '$sno', current_timestamp());
            ";

        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert shadow-sm rounded-0 text-white alert-dismissible fade show" role="alert" style="background-color: green">
                        <strong>Success!</strong> Your problem has been added wait for the community to respond.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }


    ?>
    <!-- Jumbotron for welcoming-->
    <div class="container">
        <div class="jumbotron jumbotron-fluid bg-white">
            <div class="container">
                <h1 class="display-4">Welcome to <?php echo $category_name; ?> Forum</h1>
                <p class="lead"><?php echo $category_desc; ?></p>
                <hr class="my-4">

                <p class="lead">Some rules of the forum are listed below</p>

                <ol class="text-secondary">
                    <li>Spam / Advertising / Self-promote in the forums.</li>
                    <li>Do not post copyright-infringing material.</li>
                    <li>Do not cross post questions.</li>
                    <li>Remain respectful of other members at all times.</li>
                </ol>
            </div>
        </div>
    </div>


    <!-- Ask question Form -->
    <div class="container">
        <h3 class="pb-1">Start Discussion</h3>
        <div class="line mb-4" style="margin: 0"></div>

        <!-- Following request method will submit form to itself -->
        <!-- Checking the user is logged in or not for discussion with php-->

        <?php

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==  true) {

                echo '<form action=" '.$_SERVER['REQUEST_URI'].' " method = "post">
                    <div class="form-group">
                        <input type="hidden" name="user_id" value="'. $_SESSION['user_id'].'">
                        <input type="text" class="form-control rounded-0 border-dark" id="title" name="title" placeholder="Ask your question">
                        <small class="form-text text-muted">Keep your title precise and to the topic.</small>
                    </div>
        
                    <div class="form-group">
                        <textarea class="form-control rounded-0 border-dark" id="desc" name="desc" rows="3" placeholder="Describe your problem"></textarea>
                    </div>
        
                    <button class="btn rounded-0 text-white" type="submit" style="background-color: #FF5678;">Submit Question</button>
                </form>';
            }
            else{
                echo '<p class="lead">You are not logged in. Login to start discussion.</p>';
            }
        ?>


        <!-- <form action="php echo  $_SERVER['REQUEST_URI'] ?>" method='post'>
            <div class="form-group">
                <input type="text" class="form-control rounded-0 border-dark" id="title" name="title" placeholder="Ask your question">
                <small class="form-text text-muted">Keep your title precise and to the topic.</small>
            </div>

            <div class="form-group">
                <textarea class="form-control rounded-0 border-dark" id="desc" name="desc" rows="3" placeholder="Describe your problem"></textarea>
            </div>

            <button class="btn rounded-0 text-white" type="submit" style="background-color: #FF5678;">Submit Question</button>
        </form> -->
    </div>



    <!-- Questions  -->
    <div class="container-fluid bg-light my-5 p-2">
        <div class="container">
            <h3 class="mb-2">Browse Questions.</h3>
            <div class="line" style="margin: 0"></div>


            <!-- Questions Dynamically from the database -->
            <?php
            $id = $_GET['categoryid'];
            $sql = 'SELECT * FROM `threads` WHERE thread_cat_id = ' . $id . ' ';
            $result = mysqli_query($conn, $sql);
            $noResult = true;

            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['thread_id'];
                $thread_title = $row['thread_title'];
                $thread_desc = $row['thread_desc'];
                $thread_time = $row['timestamp'];
                $thread_user_id = $row['thread_user_id'];

                // Getting the useremail from users table
                $user_sql = 'SELECT * FROM `users` WHERE user_id = '.$thread_user_id.'';
                $user_result = mysqli_query($conn, $user_sql);
                $user_row = mysqli_fetch_assoc($user_result); 

                echo '<div class="media bg-white my-4 shadow-sm p-2">
                            <img src="images/user.svg" class="mr-3" alt="random user">
                             <div class="media-body">
                                <p class="mt-0 text-secondary"><b>'.$user_row['user_email'].' </b>' . $thread_time . '</p>
                                <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $id . '">' . $thread_title . '</a></h5>
                                ' . $thread_desc . '
                            </div>
                        </div>';
            }

            // If no Question found then
            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid bg-light">
                            <div class="container">
                            <h1 class="display-4">No results found! :(</h1>
                            <p class="lead">Be the first person to start the discussion.</p>
                        </div>
                        </div>';
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