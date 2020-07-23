<?php
    session_start();
    require_once('dbConfig/auth.php');
    if(!isset($_SESSION['token'])){
        header("Location:login.php");
        die;
    }
    
    $db = new Auth();
    
    $token = $_SESSION['token'];
   
    $data = $db->fetchData($token);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php-mini-application</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/confirm.css">
</head>
<body>
    <div class="myCard">
        <div class="cardBody">
            <h2><?php echo $data->first_name. ' '.$data->last_name; ?></h2>
            <h4>Your aplication with the access code "<?php echo $data->token; ?>" is successful.</h4>
            <p>Kindly print Application status and Application Details by clicking the buttons below.</p>
            <div class="app">
            <a href="status.php" class="status">Application Status</a>
            <a href="detail.php" class="detail">Application Detail</a>
            </div>
        </div>
        
    </div>
    <a href="apply.php" class="btn btn-primary float-left  mb-2 ml-5">Apply</a>
    <a href="logout.php" class="btn btn-danger float-right mb-2 mr-5">Logout</a>
</body>
</html>