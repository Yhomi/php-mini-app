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
    <title>Status</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/status.css">
</head>
<body>
    <div class="myCard">
        <h1>APPLICANT’S STATUS</h1>
        <div class="img">
            <img src="./uploads/<?php echo $data->image; ?>" alt="" class="img-fluid">
        </div>
        <h4>I “ <?php echo $data->first_name.' '.$data->last_name; ?> “ , applied with the application code “ <?php echo $data->token; ?>”.</h4>
        <h4>I live at “<?php echo $data->adress; ?>” and I was born on “ <?php echo $data->dob; ?>.”</h4>
        <h4>My favourite subjects are: <?php echo $data->best_subject; ?></h4>
    </div>
</body>
</html>