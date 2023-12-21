<?php
    require_once 'db/db.php';
    session_start();
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
    <div> 
        <!-- login -->
        <h3>Welcome</h3>
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
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email">
                <span class="error"><?php echo $emailError; ?></span>
            </div>
            <div class="form-group">
                <label for="psd">Password</label>
                <input type="password" name="psd">
                <span class="error"><?php echo $psdError; ?></span>
            </div>
            <!-- nurse or a doctor -->
            <div class="form-group">
                <label for="role">Role</label>
            <!-- radio -->
                <input type="radio" name="role" value="nurse" checked>Nurse
                <input type="radio" name="role" value="doctor">Doctor
                <input type="radio" name="role" value="administrator">administrator
                <span class="error"><?php echo $roleError; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Log in">
            </div>

        </form>
    </div>
</body>
</html>