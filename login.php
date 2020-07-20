<?php
    session_start();
    require_once('dbConfig/auth.php');
    if(!isset($_SESSION['email'])){
        header("Location:index.php");
        die;
    }
    print_r($_SESSION);
    $db =  new Auth();
   $email=$_SESSION['email'];
    //echo $email;
    if(isset($_POST['submit'])){
        $token = $db->cleanInput($_POST['token']);
        if($db->checkToken($token,$email)){
            $token =$_SESSION['token'];
           header('Location:apply.php');
        }else{
            echo "Token does not match";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
        <?php if(isset($_SESSION['msg'])): ?>

            <div class="alert alert-<?php echo $_SESSION['msgClass']; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong class="text-center"><?php echo $_SESSION['msg']; ?> </strong>
        
                </div>
            
        <?php endif; ?>
            <form action="" method="POST">
            <h2>Enter Token Received in your E-mail</h2>
                <div class="form-group">
                    <input type="text" placeholder="Enter Token" name="token" class="form-control">
                </div>
                
                <button type="submit" name="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>  
</body>
</html>