<?php
    session_start();
    require_once('dbConfig/auth.php');
    if(!isset($_SESSION['email'])){
        header("Location:index.php");
        die;
    }
    print_r($_SESSION);
    $email = $_SESSION['email'];
    // $token = $_SESSION['token'];
    $db = new Auth();
    $msg='';
    $msgClass='';
    if(isset($_POST['submit'])){
        //remove space,htmlcharacters,stripslashes
        $firstName =$db->cleanInput($_POST['first_name']);
        $lastName =$db->cleanInput($_POST['last_name']);
        $address =$db->cleanInput($_POST['address']);
        $education =$db->cleanInput($_POST['education']);
        $maritalStatus = $_POST['maritalStatus'];
        $religion = $_POST['religion'];
        $sub = $_POST['subject'];
        $file = $_FILES['file'];
        $dob = $_POST['dob'];
        $state = $_POST['state'];
        $subject = implode(',',$sub);

        // check for empty fields
        if(empty($firstName) || empty($lastName) || empty($address) || empty($education) ){
            $msg ='Please Fill all fields';
            $msgClass='warning';
        }else{
            $fileName=$_FILES['file']['name'];
            $fileTmpName=$_FILES['file']['tmp_name'];
            $fileSize=$_FILES['file']['size'];
            $fileError=$_FILES['file']['error'];
            $fileType=$_FILES['file']['type'];

            $fileExt= explode('.', $fileName);
            $fileActualExt= strtolower(end($fileExt));

            $allowed=array('jpg', 'jpeg', 'png');
            if(in_array($fileActualExt, $allowed)){
                if($fileError===0){
                    if($fileSize < 1000000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination= 'uploads/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        if ($db->insertData($firstName,$lastName,$address,$maritalStatus,$education,$subject,$religion,$state,$dob,$fileNameNew,$email)) {
                        
                            header("Location:confirm.php");
                        }else {
                            $msg="Something Went Wrong Please try again";
                            $msgClass="waring";
                        }
                    }else{
                        $msg='FIle size too large';
                        $msgClass="warning";
                    }
                }else {
                    $msg="There was an error uploading your file";
                    $msgClass="warning";
                }
            }else {
                $msg= "You cannot upload file of this type";
                $msgClass="warning";
            }
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
    <link rel="stylesheet" href="./public/css/styles.css">
</head>

<body>
<?php if($msg !=""): ?>
        <div class="alert alert-<?php echo $msgClass; ?>"><?php echo $msg; ?> </div>

    <?php endif; ?>
    <form action="" method="POST" enctype="multipart/form-data">

        <div>
            <label class="desc" id="title1" for="Field1">First Name:</label>
            <div>
                <input id="Field1" name="first_name" type="text" class="field inputClass text fn" value="" required>
            </div>
        </div>

        <div>
            <label class="desc" id="title3" for="Field3">Last Name:</label>
            <div>
                <input id="Field3" name="last_name" type="text" class="inputClass" value="" required>
            </div>
        </div>
        <div>
            <label class="desc" id="title3" for="Field3">Address:</label>
            <div>
                <input id="Field3" name="address" type="text" class="inputClass" value="" required>
            </div>
        </div>

        <div>
            <fieldset>

                <legend id="title5" class="desc">
                    Marital Status
                </legend>

                <div>
                    <div>
                        <input id="Field5_0" name="maritalStatus" type="radio" required value="Single">
                        <label class="choice" for="Field5_0">Single</label>
                    </div>
                    <div>
                        <input id="Field5_1" name="maritalStatus" type="radio" required value="Married" tabindex="6">
                        <label class="choice" for="married">Married</label>
                    </div>
                </div>
            </fieldset>
        </div>

        <div>
            <label class="desc" id="title3" for="Field3">
           Education
          </label>
            <div>
                <input id="Field3" name="education" type="text" class="inputClass" value="" required>
            </div>
        </div>

        <div>
            <fieldset>
                <legend id="title6" class="desc">
                   Select Best Subject
                </legend>
                <div>
                    <div>
                        <input id="Field6" name="subject[]" type="checkbox" value="Mathemaics"  tabindex="8">
                        <label class="choice" for="subject">Mathematics</label>
                    </div>
                    <div>
                        <input id="subject" name="subject[]" type="checkbox" value="English"  tabindex="9">
                        <label class="choice" for="subject">English</label>
                    </div>
                    <div>
                        <input id="subject" name="subject[]" type="checkbox" value="Science"  tabindex="10">
                        <label class="choice" for="subject">Science</label>
                        </span>
                    </div>
                    <div>
                        <input id="subject" name="subject[]" type="checkbox" value="Government"  tabindex="10">
                        <label class="choice" for="subject">Government</label>
                        </span>
                    </div>
                    <div>
                        <input id="subject" name="subject[]" type="checkbox" value="Third Choice"  tabindex="10">
                        <label class="choice" for="subject">Art</label>
                        </span>
                    </div>
                    <div>
                        <input id="subject" name="subject[]" type="checkbox" value="Civic"  tabindex="10">
                        <label class="choice" for="subject">Civic</label>
                        </span>
                    </div>
                    <div>
                        <input id="subject" name="subject[]" type="checkbox" value="Computer"  tabindex="10">
                        <label class="choice" for="subject">Computer</label>
                        </span>
                    </div>
                    <div>
                        <input id="subject" name="subject[]" type="checkbox" value="History"  tabindex="10">
                        <label class="choice" for="subject">History</label>
                        </span>
                    </div>
                    <div>
                        <input id="subject" name="subject[]" type="checkbox" value="Agriculture"  tabindex="10">
                        <label class="choice" for="subject">Agriculture</label>
                        </span>
                    </div>
            </fieldset>
            </div>

            <div>
                <fieldset>

                    <legend id="title5" class="desc">
                        Religion
                    </legend>

                    <div>
                        
                        <div>
                            <input id="Field5_0" name="religion" type="radio" value="Islam" tabindex="5" required>
                            <label class="choice" for="religion">Islam</label>
                        </div>
                        <div>
                            <input id="Field5_1" name="religion" type="radio" value="Christainity" tabindex="6" required>
                            <label class="choice" for="religion">Christainity</label>
                        </div>
                        <div>
                            <input id="Field5_1" name="religion" type="radio" value="Traditional" required tabindex="6">
                            <label class="choice" for="religion">Traditional</label>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div>
                <label class="desc" id="title106" for="Field106">
              State of Origin
          </label>
                <div>
                    <select id="Field106" name="state" class="field select medium" required tabindex="11"> 

                        <option value="" selected="selected">- Select -</option>
                        <option value="Abuja FCT">Abuja FCT</option>
                        <option value="Abia">Abia</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Anambra">Anambra</option>
                        <option value="Bauchi">Bauchi</option>
                        <option value="Bayelsa">Bayelsa</option>
                        <option value="Benue">Benue</option>
                        <option value="Borno">Borno</option>
                        <option value="Cross River">Cross River</option>
                        <option value="Delta">Delta</option>
                        <option value="Ebonyi">Ebonyi</option>
                        <option value="Edo">Edo</option>
                        <option value="Ekiti">Ekiti</option>
                        <option value="Enugu">Enugu</option>
                        <option value="Gombe">Gombe</option>
                        <option value="Imo">Imo</option>
                        <option value="Jigawa">Jigawa</option>
                        <option value="Kaduna">Kaduna</option>
                        <option value="Kano">Kano</option>
                        <option value="Katsina">Katsina</option>
                        <option value="Kebbi">Kebbi</option>
                        <option value="Kogi">Kogi</option>
                        <option value="Kwara">Kwara</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Nassarawa">Nassarawa</option>
                        <option value="Niger">Niger</option>
                        <option value="Ogun">Ogun</option>
                        <option value="Ondo">Ondo</option>
                        <option value="Osun">Osun</option>
                        <option value="Oyo">Oyo</option>
                        <option value="Plateau">Plateau</option>
                        <option value="Rivers">Rivers</option>
                        <option value="Sokoto">Sokoto</option>
                        <option value="Taraba">Taraba</option>
                        <option value="Yobe">Yobe</option>
                        <option value="Zamfara">Zamfara</option>
                        
                    </select>
                </div>
            </div>
            <div class="date">
                <p>Date of Birth</p>
                <input type="date" name="dob" id="" required>
                
            </div>

            <div class="file">
                <p>Upload image</p>
                <input type="file" name="file" id="" required>
                
            </div>

            <div>

                <input id="saveForm" class="submit" name="submit" type="submit" value="Submit">

            </div>

    </form>
</body>

</html>