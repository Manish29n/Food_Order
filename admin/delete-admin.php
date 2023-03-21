<?php
    include('../config/constants.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_admin where id=$id";
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    if($res==TRUE){
        //echo "Admin deleted";
        $_SESSION['delete']='<div class="success"> Admin deleted successfully </div>';
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //echo "failed to delete Admin";
        $_SESSION['delete']='<div class="error"> Failed to delete Admin. Try again later </div>';
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>