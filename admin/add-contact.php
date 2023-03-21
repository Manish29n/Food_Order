<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Contact</h1>

        <br><br>
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Name: </td>
                    <td>
                        <input type="text" name="name" placeholder="Name">
                    </td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>
                        <input type="number" name="phone" >
                    </td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td>
                        <input type="text" name="email" placeholder="E-mail">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Contact" class="btn-secondary">
                    </td>
                </tr> 

            </table>

        </form>
        <?php

            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                if(isset($_FILES['image']['name'])){
                    $image=$_FILES['image']['name'];
                    if($image!=""){
                $tmp=explode('.', $image);
                    $ext = end($tmp);
                        $image_name="Contact-Name-".rand(0000,9999).'.'.$ext;
                        $src=$_FILES['image']['tmp_name'];
                        $dst="../images/food/".$image; 
                        $upload=move_uploaded_file($src, $dst);
                        if($upload==false){
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            header('location:'.SITEURL.'admin/add-contact.php');
                            die();
                        }
                    }
                 }
                 else{
                    $image_name="";
                 }
                $sql2 = "INSERT INTO tbl_contact SET
                    Name = '$name',
                    Phone=$phone,
                    Email='$email',
                    image='$image'
                ";
                $res2 = mysqli_query($conn, $sql2) or die(mysqli_error());
                if ($res2 == TRUE) {
                    $_SESSION['add'] = '<div class="success">Contact Added Successfully.</div>';
                    header("location:" . SITEURL . 'admin/manage-contact.php');
                }
                else{
                    $_SESSION['add'] = '<div class="error"> Failed to Add Contact.</div>';
                    header("location:" . SITEURL . 'admin/manage-contact.php');
                }
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>