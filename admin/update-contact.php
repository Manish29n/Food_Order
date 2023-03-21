<?php include('partials/menu.php'); ?>
<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $sql2 = "SELECT * FROM tbl_contact WHERE id=$id";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);
        $Name=$row2['Name'];
        $Phone=$row2['Phone'];
        $current_image=$row2['image'];
        $Email=$row2['Email'];
    }
    else{
        header('loaction:' . SITEURL . 'admin/manage-contact.php');
    }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update contact</h1>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" name="Name" value="<?php echo $Name;?>" placeholder="Name">
                    </td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>
                        <input type="number" name="Phone" value="<?php echo $Phone;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image!=""){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/contact/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                        else{
                            echo "<div class='error'>Image Not Available.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>
                        Email:
                    </td>
                    <td>
                        <input type="text" name="Email" value="<?php echo $Email;?>" placeholder="Email">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update contact" class="btn-secondary">
                    </td>
                </tr> 

            </table>

        </form>
        <?php
            if(isset($_POST['submit'])){
        //echo "button clicked";
        $id = $_POST['id'];
        $Name = $_POST['Name'];
        $Phone = $_POST['Phone'];
        $current_image = $_POST['current_image'];
        $Email = $_POST['Email'];
        if(isset($_FILES['image']['name'])){
            $image = $_FILES['image']['name'];
            if($image!=""){
                $tmp=explode('.', $image);
                    $ext = end($tmp);
                    $image_name="Contact-Name-".rand(0000,9999).'.'.$ext;
                    $src_path=$_FILES['image']['tmp_name'];
                    $dst_path="../images/contact/".$image;
                    $upload=move_uploaded_file($src_path, $dst_path);
                    if($upload==false){
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image. </div>";
                        header('location:'.SITEURL.'admin/manage-contact.php');
                        die();
                    }
                    if($current_image!=""){
                        $remove_path="../images/food/".$current_image;
                    $remove = unlink($remove_path);
                    if($remove==false){
                        $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current Image.<?div>";
                        header('location:' . SITEURL . 'admin/manage-contact.php');
                    die();
                    }
                    }
            }
            else{
                $image = $current_image;
            }
        }
        else{
            $image = $current_image;
        }
        $sql3 = "UPDATE tbl_contact SET 
        Name = '$Name',
        Phone=$Phone,
        image='$image',
        Email = '$Email'
        WHERE id=$id
        ";
        $res3 = mysqli_query($conn, $sql3);
        if($res3==TRUE){
            $_SESSION['update'] = "<div class='success'>contact Updated successfully</div>";
            header('location:' . SITEURL . "admin/manage-contact.php");
        }
        else{
            $_SESSION['update'] = "<div class='error'>Failed to delete contact</div>";
            header('location:' . SITEURL . "admin/manage-contact.php");
        }
    }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>