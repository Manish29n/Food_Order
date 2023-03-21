<?php
include('../config/constants.php');
    if(isset($_GET['id']) && isset($_GET['image'])){
        //echo "Deleted successfully";
        $id = $_GET['id'];
        $image = $_GET['image'];
        if($image!=""){
            $path = "../images/contact/" . $image;
            $remove = unlink($path);
            if($remove==false){
                    $_SESSION['upload']="<div class'error'>Failed to remove image file.</div>";
                    header('location:' . SITEURL . 'admin/manage-contact.php');
                    die();
                }
        }
        $sql="DELETE FROM tbl_contact WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res==true){
        $_SESSION['delete']="<div class'success'>Contact deleted successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-contact.php');
        }
        else{
        $_SESSION['delete']="<div class'error'>Failed to delete Contact.</div>";
        header('location:' . SITEURL . 'admin/manage-contact.php');

        }
    }
    else{
        $_SESSION['unauthorize']="<div class'error'>Unauthorized Access</div>";
        header('location:' . SITEURL . 'admin/manage-contact.php');
    }
?>
<div></div>