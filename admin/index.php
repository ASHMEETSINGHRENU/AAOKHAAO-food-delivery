<?php 
require_once 'header.php';    
if($adminloggedin) {
?>
<body> 
    <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                            <span class="dash-widget-bg1"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <?php
                            $fetch_query = mysqli_query($conn, "select count(*) as total from tbl_users where userType='0'"); 
                            $user = mysqli_fetch_row($fetch_query);
                            ?>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $user[0]; ?></h3>
                                <span class="widget-title1">Users <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-bar-chart"></i></span>
                            <?php
                            $fetch_query = mysqli_query($conn, "select count(*) as total from tbl_orders where orderStatus='0'"); 
                            $order = mysqli_fetch_row($fetch_query);
                            ?>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $order[0]; ?></h3>
                                <span class="widget-title2">New Order <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-handshake-o" aria-hidden="true"></i></span>
                            <?php
                            $fetch_query = mysqli_query($conn, "select count(*) as total from tbl_orders where orderStatus='4' and DATE(orderDate)=CURDATE()"); 
                            $delivered = mysqli_fetch_row($fetch_query);
                            ?>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $delivered[0]; ?></h3>
                                <span class="widget-title3">Order Delivered <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                       <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">Message </h4> 
                                <!-- <a href="contactManage.php" class="btn btn-primary float-right">View all</a> -->
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table mb-0 new-patient-table">
                                        <thead>
                                            <tr>
                                        <th>Contact Id</th>
                                        <th>User Id</th>
                                        <th>Order Id</th>
                                        <th>Message</th>
                                        <th>Date & Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                            $sql = "SELECT * FROM tbl_contact where orderId!='0'"; 
                            $result = mysqli_query($conn, $sql);
                            
                            while($row=mysqli_fetch_assoc($result)) {
                                $contactId = $row['contactId'];
                                $userId = $row['userId'];
                                $orderId = $row['orderId'];
                                $message = $row['message'];
                                $time = $row['time'];
                                
                                         ?>
                                            <tr>
                                                
                                                <td><?php echo $row['contactId']; ?></td>
                                                <td><?php echo $row['userId']; ?></td>
                                              <td><?php echo $row['orderId']; ?></td> <td><?php echo $row['message']; ?></td> 
                                                <td><?php echo $row['time']; ?></td>
                                                
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>

<?php
    }
    else{
        header("location: /food-ordering-system/admin/login.php");
    }
?>
<?php 
 require_once 'footer.php';
?>