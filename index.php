<?php
session_start();
    require_once('dbConfig/emailController.php');
    require_once('dbConfig/auth.php');
    if(isset($_SESSION['token'])){
        header("Location:confirm.php");
        die;
    }
    $db = new Auth();

    $msg ='';
    $msgClass = '';

    if(isset($_POST['submit'])){
       
        $email = $db->cleanInput($_POST['email']);
        $token = rand(0,999999);
       if ($db->checkUser($email)) {
        $msg="This email is already registered";
       $msgClass='warning';
       }else{
           $db->saveUserEmail($email,$token);
                 $_SESSION['msg']="Please Check your Email for the token";
                $_SESSION['msgClass']= 'success';
               
                sendToken($email,$token);
                
                header('Location:login.php');
           
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
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <?php if($msg !=""): ?>
        <div class="alert alert-<?php echo $msgClass; ?>"><?php echo $msg; ?> </div>

    <?php endif; ?>
            <h1>Submit Your Email</h1>
            <form action="" method="POST">
                <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Enter Your E-mail" required class="form-control">
                </div> 
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
            
        </div>
    </div>
        
    </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>  
</body>
</html>