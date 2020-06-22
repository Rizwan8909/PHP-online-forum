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
            
            // Getting user id from db to display in (posted by)
            $thread_user_id = $row['thread_user_id'];
            $sql_useremail = "SELECT user_email FROM `users` WHERE user_id = '$thread_user_id'";
            $email_result = mysqli_query($conn, $sql_useremail);
            $email_row = mysqli_fetch_assoc($email_result);
            $posted_by = $email_row['user_email'];
        }
    ?>


     <!-- Comments insertion to the databse -->
    <?php
        $showAlert = false;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $comment = $_POST['comment'];

            // Securing website from XSS attack by replacing tags <>
            $comment = str_replace("<", "&lt", $comment);
            $comment = str_replace(">", "&gt", $comment);

            // Inserting user_id , For explanation check the code below of form
            $sno = $_POST['user_id'];

            $sql = "INSERT INTO `comments` (`comment_content`, `comment_by`, `thread_id`, `comment_time`) 
                VALUES ('$comment', '$sno', '$id', current_timestamp());
            ";

            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert shadow-sm rounded-0 text-white alert-dismissible fade show" role="alert" style="background-color: green">
                        <strong>Sucess!</strong> Your comment is sucessfully added.
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
                <h1 class="display-4"><?php echo $thread_title;?></h1>
                <p class="lead"><?php echo $thread_desc;?></p>
                <hr class="my-4">
                <!-- Prinitng user_email of the user 'Go up for code' -->
                <p>posted by: <b><?php echo $posted_by;?></b></p>    
            </div>
        </div>
    </div>


    <!-- Comment Form similar to ask question -->
    <div class="container">
        <h3 class="pb-1">Comment</h3>
        <div class="line mb-4" style="margin: 0"></div>

        <!-- Following request action in form tag will submit form to itself -->
        <!-- Enabling logged in user to comment with php -->
       
        <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

                echo '<form action="' . $_SERVER["REQUEST_URI"] . '" method = "post">
                        <div class="form-group">
                            <textarea class="form-control rounded-0 border-dark" id="comment" name="comment" rows="3" placeholder="Type your comment"></textarea>
                            <input type="hidden" name="user_id" value="'. $_SESSION['user_id'].'">
                            </div>
                        <button class="btn rounded-0 text-white" type="submit" style="background-color: #FF5678;">Post Comment</button>
                    </form>';
            }
            else{
                echo '<p class="lead">You are not logged in. Login to comment.</p>';
            }
        ?>
       
       
       
       <!-- <form action="?php echo ' . $_SERVER["REQUEST_URI"] . ' ?>" method = 'post'>
            <div class="form-group">
                <textarea class="form-control rounded-0 border-dark" id="comment" name="comment" rows="3" placeholder="Type your comment"></textarea>
            </div>
            <button class="btn rounded-0 text-white" type="submit" style="background-color: #FF5678;">Post Comment</button>
        </form> -->
    </div>


    <!-- Comments -->
    <div class="container-fluid bg-light my-5">
        <div class="container">
            <h3 class="mb-2">Discussions.</h3>
            <div class="line" style="margin: 0"></div>
  
            <!-- Fetching the Comments Dynamically from Database -->
            <?php
            $id = $_GET['threadid'];
            $sql = 'SELECT * FROM `comments` WHERE thread_id = ' . $id . ' ';
            $result = mysqli_query($conn, $sql);
            $noResult = true;

            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['comment_id'];
                $comment_content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $comment_by = $row['comment_by'];

                // Getting emails for comments from users table
                $user_sql = 'SELECT * FROM `users` WHERE user_id = '.$comment_by.'';
                $user_result = mysqli_query($conn, $user_sql);
                $user_row = mysqli_fetch_assoc($user_result);

                echo '<div class="media bg-white my-4 shadow-sm p-2">
                            <img src="images/user.svg" class="mr-3" alt="random user">
                             <div class="media-body">
                                <h6 class="mt-0 my-0">'.$user_row['user_email'].' at ' . $comment_time . '</h6>
                                <p class="my-0">' . $comment_content . '</a></p>
                            </div>
                        </div>';
            }

            // If no Question found then
            if ($noResult) {
                echo '<div class="jumbotron jumbotron-fluid bg-light">
                            <div class="container">
                            <h1 class="display-4">No results found! :(</h1>
                            <p class="lead">Be the first person to comment.</p>
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