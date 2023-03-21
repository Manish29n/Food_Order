<?php include('partials/menu.php'); ?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Daily Revenue</h1>
                <br><br>
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>
                    <?php
                        $sql = "SELECT order_date FROM tbl_order";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        if($count>0){
                            $rows=mysqli_fetch_assoc($res);
                            $order_date = $rows['order_date'];
                                $sql2 = "SELECT distinct order_date FROM tbl_order WHERE status='Delivered'";
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);
                                if($count2>0){
                                    while($rows2=mysqli_fetch_assoc($res2)){
                                            $order_date2 = $rows2['order_date'];
                                            $sql3 = "SELECT sum(total) as Total FROM tbl_order WHERE order_date='$order_date2' and status='Delivered'";
                                            $res3 = mysqli_query($conn, $sql3);
                                            $rows3 = mysqli_fetch_assoc($res3);
                                            $total_revenue = $rows3['Total'];
                                            ?>
                                            <div class="col-4 text-center">
                                                <h1><?php echo $order_date2; ?></h1>
                                                <br>
                                                <h2>Rs.<?php echo $total_revenue; ?></h2>
                                                <br />
                                                Revenue Generated
                                            </div>
                                            <?php
                                        }

                                    }
                                    else{
                                        ?>
                                        <tr>
                                            <td colspan="7"> <div class="error">No Food Delivered.</div> </td>
                                        </tr>
                                        <?php
                                    }

                        }
                        else{
                            ?>
                            <tr>
                                <td colspan="7"> <div class="error">No Food Added.</div> </td>
                            </tr>
                            <?php
                        }
                        ?>
                <div class="clearfix"></div>
            </div>
        </div>
<?php include('partials/footer.php'); ?>
