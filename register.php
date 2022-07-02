<?php 
require_once "include/head.php"; 
$title = "Registration Page";
$firstname = $lastname = $email = $phonenumber = $department = $jobrole = $currentaddress = $message  = "";
require_once "include/logic.php";
$logic = new Logic();
$con = $database->conn;
//$usedb = new DataBase();
//$connection = $usedb->getConn("localhost","root","","attendancesystem");

if(isset($_POST['register'])){
    $table = "users";
    global $conn;
    $firstname = $_POST['firstname'];
    $lastname =filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email =filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phonenumber =filter_var($_POST['phonenumber'], FILTER_VALIDATE_INT);
    $password =$_POST['password'];
    $cpassword =$_POST['cpassword'];
    $department =filter_var($_POST['department'], FILTER_SANITIZE_STRING);
    $jobrole =filter_var($_POST['jobrole'], FILTER_SANITIZE_STRING);
    $currentaddress =filter_var($_POST['currentaddress'], FILTER_SANITIZE_STRING);
    $stateoforigin =filter_var($_POST['stateoforigin'], FILTER_SANITIZE_STRING); 
    $datecreated = date("Y-m-d");

    if($password === $cpassword){
        $check = $logic->checktable($table,$email,$lastname);
        $password = sha1($password);
        if($check == 0){
            $insert = "INSERT INTO $table(firstname,lastname,email,phonenumber,password,department,jobrole,address,stateoforigin,dateaccountcreated) 
            VALUES ('$firstname','$lastname','$email','$phonenumber','$password','$department','$jobrole','$currentaddress','$stateoforigin','$datecreated')";
            // echo $insert;
            $insertintodb = $con->query($insert);
            if($insertintodb){
                $message = "<p class='alert alert-success text-center'>Account created.</p>";
                Session::set('email',"$email");
               
                

            }else{
                $message = "<p class='alert alert-danger text-center'>We could not create an account for you right now.</p>";   
            }
        
        }else{
            $message = "<p class='alert alert-danger text-center'>User $firstname $lastname with email $email already exist in database.</p>";
        }
    }else{
        $message = "<p class='alert alert-danger text-center'>Password does not match</p>";
    }
    
}
?>
    <title><?=$title; ?></title>
  </head>
  <body>
   <?php require_once "include/navbar.php"; ?>
    <div class="container" >
        <legend>Register</legend>
        <h4><?=$message; ?></h4>
       
            <form class="row" action="" method="POST">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstname" value="<?=$firstname; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>" required >
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required >
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="phonenumber" value="<?php echo $phonenumber; ?>" required  >
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control" name="cpassword" required>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">Department</label>
                    <input type="text" class="form-control" name="department" value="<?php echo $department; ?>" placeholder="1234 Main St" required>
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Job Role</label>
                    <input type="text" class="form-control" name="jobrole" value="<?php echo $jobrole; ?>" required >
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Residential Address In Lagos</label>
                    <input type="text" class="form-control" name="currentaddress" value="<?php echo $currentaddress; ?>" required  >
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">State Of Origin</label>
                    <select name="stateoforigin" class="form-select" required>
                    <option disabled selected>  --Select State--</option>
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
                    <option value="Abuja">Federal Capital Territory</option>
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
                    <option value="Nasarawa">Nasarawa</option>
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
            <div class="col-12 text-center">
                <p>By registering on this form, you are agreeing to all our terms and condition.</p>
            </div>
            <div class="col-12 d-grname gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary" name='register'>Create Account</button>
            </div>
        </form>

       
        
        <div class="d-grid gap-2 col-6 mx-auto px-auto Pt-2 mb-2">
            <button class="btn btn-primary btn-sm" type="button"><a href="login.php" target="_blank" rel="noopener noreferrer" style='text-decoration:none;color:white'>Login Here</a></button>
        
        </div>
      
    </div>
    
  

<?php require_once "include/footer.php"; ?>