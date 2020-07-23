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
    <link rel="stylesheet" href="./public/css/detail.css">
</head>
<body>
    <a href="confirm.php" class="btn btn-secondary float-left ml-2 mt-5 mb-2">Back</a>
    <div class="myCard">
        <h1>APPLICANT’S DETAILS</h1>
        <div class="img">
            <img src="./uploads/<?php echo $data->image; ?>" alt="" class="img-fluid">
        </div>
        <h4>Dear “<?php echo $data->first_name.' '.$data->last_name; ?>” , your application details have been received .</h4>
        <h4>Your Access code is “ <?php echo $data->token; ?>” . Kindly go through the details .</h4>
        <div class="box">
            <table class="table table-bordered table-striped">
                <tr>
                    <td>Address</td>
                    <td><?php echo $data->adress; ?></td>
                </tr>
                <tr>
                    <td>Marital Status</td>
                    <td><?php echo $data->marital_status; ?></td>
                </tr>
                <tr>
                    <td>Education Background</td>
                    <td><?php echo $data->education_background; ?></td>
                </tr>
                <tr>
                    <td>Select Best Subject</td>
                    <td><?php echo $data->best_subject; ?></td>
                </tr>
                <tr>
                    <td>Religion</td>
                    <td><?php echo $data->religion; ?></td>
                </tr>
                <tr>
                    <td>State of Origin</td>
                    <td><?php echo $data->state_of_origin; ?></td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><?php echo $data->dob; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <a href="apply.php" class="btn btn-primary float-left  mb-2 ml-5">Apply</a>
    <a href="logout.php" class="btn btn-danger float-right mb-2 mr-5">Logout</a>
</body>
</html>