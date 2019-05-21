<?php
// session_start();
include 'security.php';

$connect = new PDO('mysql:host=localhost;dbname=ao_cms', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);


// ----------Login-----------
$errorMessage;
if(isset($_POST['loginBtn']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $adminEmail=$_POST['email'];
    $adminPassword=$_POST['password'];
    
    try{ // Check the data base
        $query=$connect->prepare("SELECT * FROM register WHERE email=:email AND password=:password");
        $query->execute([
            'email'=>$adminEmail,
            'password'=>$adminPassword
        ]);
        $user=$query->fetch();

        if($user){
            $_SESSION['username']=$user->username;
            $_SESSION['id']=$user->id;
            if($user->type=='admin'){
                header('Location:index.php');
            }else if ($user->type=='user'){
                header('Location:../index.php');
            }
            
        }else{
            $errorMessage = 'Email et/ou mot de passe invalide(s)';
            header('Location:login.php?message='.$errorMessage);
        }
         
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        header('Location:login.php?message='.$errorMessage);
    }

}else{
    $errorMessage='Veuillez remplir tous les champs';
    header('Location:login.php?message='.$errorMessage);
}

// --------------Admin logout-----------
if(isset($_POST['logout'])){
    session_destroy();
    header('Location:login.php');
}

//-------------- Add a new profile---------
if (isset($_POST['addUserBtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmPassword'];
    $type=$_POST['profilType'];
    // confirm password
    if ($password === $cpassword) {
        try {
            $query=$connect->prepare("SELECT * FROM register WHERE email=:email");
            $query->execute([
            'email'=>$email
            ]);
            $user=$query->fetch();
           
           if($user){
               $_SESSION['status'] = 'Nouvel utilisateur non enregistré car cet email existe déjà';
                header('Location:register.php');
           }else{
                $query = $connect->prepare("INSERT INTO register (username,email,password,type) VALUES (:username,:email,:password,:type)");
                $query->execute([
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'type'=>$type
                ]);
                $_SESSION['success'] = 'Utilisateur enregistré';
                header('Location:register.php');
           }

            

        } catch (PDOException $e) {
            $_SESSION['status'] = 'Problème de connexion, utilisateur non enregistré';
            header('Location:register.php');
        }
    } else {
        $_SESSION['status'] = "Wrong password";
        header('Location:register.php');
    }
}

// ------------- Edit a profile-----------
if (isset($_POST['editUserBtn'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmPassword'];
    $type=$_POST['profilType'];
    // confirm password
    if ($password === $cpassword) {
        try {
            $query = $connect->prepare("UPDATE register SET username=:username, email=:email, password=:password, type=:type WHERE id=:id");
            $query->execute([
                'id' => $id,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'type'=>$type
            ]);
            $_SESSION['success'] = 'Modifications enregistrées';
            header('Location:register.php');

        } catch (PDOException $e) {
            $_SESSION['status'] = $e->getMessage();
            header('Location:register.php');
        }
    } else {
        $_SESSION['status'] = "Wrong password";
        header('Location:register.php');
    }
}

// ------------- Delete a profile-----------
if (isset($_POST['deleteProfile'])) {
    $id = $_POST['delete_id'];
    try {
        if($id===$_SESSION['id']){
            $_SESSION['status'] ='Vous ne pouvez pas supprimer ce profil';
            header('Location:register.php');
        }else{
            $query = $connect->exec("DELETE FROM register WHERE id=" . $id);
            $_SESSION['success'] = 'Profil supprimé';
            header('Location:register.php');
        }
        
    } catch (PDOException $e) {
        $_SESSION['status'] = $e->getMessage();
        header('Location:register.php');
    }
}
