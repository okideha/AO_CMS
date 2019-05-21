<?php
include 'includes/header.php';
include 'includes/navbar.php';
$connect = new PDO('mysql:host=localhost;dbname=ao_cms', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);
?>

<div id="addAdminProfile" >
</div>
<div id="editProfile">
</div>
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3" style="display: flex;justify-content: space-between;align-items: center">
    <h6 class="m-0 font-weight-bold text-primary">Admin Profile
    </h6>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdminProfile">Add Admin Profile</button>
  </div>

  <div class="card-body">
    <?php
if (isset($_SESSION['success']) && ($_SESSION['success'] != '')) {
    echo '<h3 style="color:green">' . $_SESSION['success'] . '</h3>';
    unset($_SESSION['success']);
} else if (isset($_SESSION['status']) && ($_SESSION['status'] != '')) {
    echo '<p style="color:red">' . $_SESSION['status'] . '</p>';
    unset($_SESSION['status']);
}
?>

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Profil</th>
            <th>Modifier</th>
            <th>Supprimer</th>
          </tr>
        </thead>
        <tbody>
        <?php
try {
    $query = $connect->query('SELECT*FROM register');
    $users = $query->fetchAll();
    if (sizeof($users) > 0) {
        foreach ($users as $user) {?>
                  <tr>
                    <td><?=$user->id?></td>
                    <td><?=$user->username?></td>
                    <td><?=$user->email?></td>
                    <td><?=$user->password?></td>
                    <td><?=$user->type?></td>
                    <td>
                      <!-- <form action="" method="post"> -->
                        <button  type="button" onclick="addModalProfile(modalEditProfile,actionForm,editUser,editBtn,'<?=$user->id?>','<?=$user->username?>','<?=$user->email?>','<?=$user->password?>')" name="editProfile" data-toggle="modal" data-target="#editProfile" class="btn btn-success"><i class="far fa-edit"></i></button>
                      <!-- </form> -->
                    </td>
                    <td>
                      <form action="code.php" method="post">
                      <input type="hidden" name="delete_id" value="<?=$user->id?>">
                        <button type="submit" name="deleteProfile" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                      </form>

                    </td>
                  </tr>
                  <?php
}
    } else {
        echo 'Pas de données enregistrées';
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->


<?php

include 'includes/scripts.php';
include 'includes/footer.php';
?>

