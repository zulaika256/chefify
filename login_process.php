<?php
session_start();

// Sambung database (versi sir, database boleh create lepas ni)
$con = mysqli_connect("localhost", "root", "", "") 
       or die(mysqli_connect_error());

// Semak POST
if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query login (logic sir awak)
    $query = "SELECT * FROM register 
              WHERE username='$username' 
              AND password='$password'";
    $result = mysqli_query($con, $query);

    // Jika tiada rekod
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['error'] = "Wrong username or password";
        header("Location: login.php");
        exit();
    } else {
        $row = mysqli_fetch_assoc($result);

        // Simpan session
        $_SESSION['username'] = $row['username'];
        $_SESSION['status']   = $row['status'];

        // Redirect ikut role
        if ($row['status'] == "USER") {
            header("Location: homepage.php");
            exit();
        } elseif ($row['status'] == "ADMIN") {
            header("Location: indexadmin.html");
            exit();
        }
    }
} else {
    $_SESSION['error'] = "Please enter username and password";
    header("Location: login.php");
    exit();
}
?>
