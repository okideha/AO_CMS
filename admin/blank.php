<?php
include 'includes/header.php';
include 'includes/navbar.php';
$connect = new PDO('mysql:host=localhost;dbname=ao_cms', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

        </div>
        <!-- /.container-fluid -->

<?php

include 'includes/scripts.php';
include 'includes/footer.php';
?>
