<?php
    session_start();
    require_once('dbConfig/auth.php');
   
    $db =  new Auth();
    //redirect logged in user to confirm
    if(isset($_SESSION['token'])){
        header("Location:confirm.php");
        die;
    }
  $msg="";
  $msgClass="";
    if(isset($_POST['submit'])){
        // validation
        if(empty($_POST['token'])){
            $msg="Field cannot be empty";
            $msgClass="warning";
        }else {
            // clean space, slashes,html entities
            $token = $db->cleanInput($_POST['token']);
            if($db->checkToken($token)){
                // check if the token is available and if user already completes its application
               $msg='You have not complete your application visit <a href="login.php">Login</a>';
               $msgClass= "warning";
               
            }else{
                // check if the token is available and confirm all application fields have been submited
               if($db->tokenConfirm($token)){
                   $_SESSION['token'] = $token;
                   header('Location:confirm.php');
               }else{
                   $msg = "Token does not match";
                   $msgClass ="warning";
               }
            }
        }

        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php-mini-application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
        <?php if($msg !=""): ?>
        <div class="alert alert-<?php echo $msgClass; ?>"><?php echo $msg; ?> </div>

        <?php endif; ?>
        <div class="card-body bg-light">
            <form action="" method="POST">
                <h2>Enter Token</h2>
                    <div class="form-group">
                        <input type="text" placeholder="Enter Token" name="token" class="form-control">
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-info">Submit</button>
                    <div class="mt-2 p-2">
                        <p class="float-left">No Token yet?</p>
                        <a href="index.php">Click here</a>
                    </div>
                </form>
        </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>  
</body>
</html>