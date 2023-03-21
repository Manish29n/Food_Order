<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Contacts</h1>
        <br /><br /> 
<?php
if(isset($_SESSION['add'])){
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(isset($_SESSION['upload'])){
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
if(isset($_SESSION['unauthorize'])){
    echo $_SESSION['unauthorize'];
    unset($_SESSION['unauthorize']);
}
if(isset($_SESSION['update'])){
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
?>
        <br><br>
<a href="<?php echo SITEURL;?>admin/add-contact.php" class="btn-primary">Add Contact</a>
<br /><br /><br />

<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Image</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    <?php
    $sql = "SELECT * FROM tbl_contact";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    $sn = 1;
    if($count>0){
        while($rows=mysqli_fetch_assoc($res)){
            $id = $rows['id'];
            $name = $rows['Name'];
            $phone = $rows['Phone'];
            $image = $rows['image'];
            $email = $rows['Email'];
            ?>
            <tr>
                <td><?php echo $sn++?></td>
                <td><?php echo $name?></td>
                <td><?php echo $phone?></td>
                <td>
                    <?php
                        if($image!=""){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/contact/<?php echo $image;?>" height="100px" width="100px">
                            <?php
                        }
                        else{
                            echo "<div class='error'>Image Not Added.</div>";
                    }
                    
                    ?>
                </td>
                <td><?php echo $email?></td>
                <td>
                    <a href="<?php echo SITEURL; ?>admin/update-contact.php?id=<?php echo $id; ?>" class="btn-secondary">Update Contact</a>
                    <a href="<?php echo SITEURL; ?>admin/delete-contact.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn-danger">Delete Contact</a>
                </td>
            </tr>
            <?php
        }

    }
    else{
        ?>
          <tr>
            <td colspan="7"> <div class="error">No Contact Added.</div> </td>
         </tr>
        <?php
    }
    ?>
    
</table>
<div class="clearfix"></div>
    </div>
</div>
<?php include('partials/footer.php'); ?>