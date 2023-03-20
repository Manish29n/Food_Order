<?php include('partials-front/menu.php'); ?>
<section class="food-menu">
        <div class="container">
            <h2 class="text-center">Contacts</h2>
            <?php
        $sql2 = "SELECT * FROM tbl_contact";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
        if($count2>0){
            while($row2=mysqli_fetch_assoc($res2)){
                $id = $row2['id'];
                $Name = $row2['Name'];
                $Phone = $row2['Phone'];
                $image = $row2['image'];
                $Email = $row2['Email'];
                ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                if($image==""){
                                    echo "<div class='error'>Image not Available</div>";
                                }
                                else{
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/contact/<?php echo $image; ?>" height="150px" width="88.5px" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $Name; ?></h4>
                            <p class="food-title"><?php echo $Phone; ?></p>
                            <p class="food-title"><?php echo $Email; ?></p>
                            
                        </div>
                    </div>
                <?php
            }
        }
        else{
            echo "<div class='error'>contact not Available.</div>";
        }
    ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
<?php include('partials-front/footer.php'); ?>
