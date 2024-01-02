<?php
    require_once 'db/db.php';
    session_start();
    if(isset($_SESSION["userID"])){
        if($_SESSION["role"] == "nurse"){
            header("Location: views/nurse/dashboard.php");
            exit();
        }
        if($_SESSION["role"] == "doctor"){
            header("Location: views/doctor/dashboard.php");
            exit();
        }
        if($_SESSION["role"] == "administrator"){
            header("Location: views/administrator/dashboard.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Hospital</title>
</head>
<body>
    
        <?php
            $database = Db::getInstance();

            $email = "";
            $emailError = $psdError = "";
            $error = "";
            $submit = true;
            $conn = $database->getConnection();
            $role = "";
            $roleError = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email =$_POST['email'];
                $psd =$_POST['psd'];
                $role = $_POST['role'];
                if (empty($email)) {
                    $emailError = "Veuillez entrer votre email";
                }
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                if (empty($psd)) {
                    $psdError = "Veuillez entrer votre mot de passe";
                }
                if (empty($role)) {
                    $roleError = "Veuillez entrer votre role";
                }
                if ($role == "nurse"){
                    $stmt = $conn->prepare("SELECT * FROM nurse WHERE Email=:Email");
                    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
                    if ($result) {
                        // $user_row = mysqli_fetch_assoc($result);
                        $hashed_password = $result['Password'];
                        // if (password_verify($_POST['psd'], $result['Password'])) {
                            if ($_POST['psd'] == $result['Password']) {
                            $_SESSION["userID"] = $result["NurseID"];
                            $_SESSION["USER_NAME"] = $result["Username"];  
                            $_SESSION["role"] = $role; 
                            header("location: views/nurse/dashboard.php");                      
                            
                        } else {
                            $psdError = "Invalid password.";
                            $submit = false;
                        }
                        
                    } 
                    else{
                        $emailError = "Invalid email or password.";
                        $submit = false;
    
                    }
                }
                if ($role == "doctor"){
                    $stmt = $conn->prepare("SELECT * FROM doctor WHERE Email=:Email");
                    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
                    if ($result) {
                        $hashed_password = $result['Password'];
                        // if (password_verify($_POST['psd'], $result['Password'])) {
                            if ($_POST['psd'] == $result['Password']) {
                            $_SESSION["userID"] = $result["DoctorID"];
                            $_SESSION["USER_NAME"] = $result["Username"]; 
                            $_SESSION["role"] = $role; 
  
                            header("location: views/doctor/dashboard.php");                      
                            
                        } else {
                            $psdError = "Invalid password.";
                            $submit = false;
                        }
                        
                    } 
                    else{
                        $emailError = "Invalid email or password.";
                        $submit = false;
    
                    }
                }
                if ($role == "administrator"){
                    $stmt = $conn->prepare("SELECT * FROM administrator WHERE Email=:Email");
                    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
                    if ($result) {
                        $hashed_password = $result['Password'];
                        // if (password_verify($_POST['psd'], $result['Password'])) {
                            if ($_POST['psd'] == $result['Password']) {
                            $_SESSION["userID"] = $result["AdministratorID"];
                            $_SESSION["USER_NAME"] = $result["Username"];   
                            $_SESSION["role"] = $role; 

                            header("location: views/administrator/dashboard.php");                      
                            
                        } else {
                            $psdError = "Invalid password.";
                            $submit = false;
                        }
                        
                    } 
                    else{
                        $emailError = "Invalid email or password.";
                        $submit = false;
    
                    }
                }
            }
            else {
                $submit = false;
            }
        ?>
       <div class="container mt-5">
            <div>
                <!-- Welcome Message -->
                <h3>Welcome</h3>
                <p>Please login to continue</p>
            </div>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email">
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>
                <div class="mb-3">
                    <label for="psd" class="form-label">Password</label>
                    <input type="password" class="form-control" name="psd">
                    <span class="text-danger"><?php echo $psdError; ?></span>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="role" value="nurse" checked>
                        <label class="form-check-label" for="role">Nurse</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="role" value="doctor">
                        <label class="form-check-label" for="role">Doctor</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="role" value="administrator">
                        <label class="form-check-label" for="role">Administrator</label>
                    </div>
                    <span class="text-danger"><?php echo $roleError; ?></span>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" name="submit" value="Log in">
                </div>
            </form>
        </div>
        </body>
</html>