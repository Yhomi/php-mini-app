<?php
    session_start();
    require_once('dbConfig/auth.php');
    if(!isset($_SESSION['email'])){
        header("Location:index.php");
        die;
    }
    
    $db = new Auth();
    $email = $_SESSION['email'];
    $token = $_SESSION['token'];
    print_r($_SESSION);
    $data = $db->fetchData($email,$token);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/css/confirm.css">
</head>
<body>
    <div class="card">
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
</body>
</html>