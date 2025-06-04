<?php
require_once 'inner-header.php';
?>
    <style>
       .icon-badge-group .icon-badge-container {
          display: inline-block;
        
        }
        .icon-badge-container {
          
          position: absolute;
        }
        .icon-badge-icon {
          font-size: 30px;
          color: rgb(0 0 0 / 50%);
          position: relative;
        }
        .icon-badge {
          background-color: #979797;;
          font-size: 10px;
          color: white;
          text-align: center;
          width: 15px;
          height: 15px;
          border-radius: 49%;
          position: relative;
          top: -35px;
          left: 17px;
        }
      .footer.container-fluid.bg-dark.text-light {
          position:fixed;
          bottom:0;
      }
      .contact2 {
        font-family: "Montserrat", sans-serif;
        color: #8d97ad;
        font-weight: 300;
        /* padding: 60px 0; */
        /* margin-bottom: 170px; */
        background-position: center top;
      }

      .contact2 h1,
      .contact2 h2,
      .contact2 h3,
      .contact2 h4,
      .contact2 h5,
      .contact2 h6 {
        color: #3e4555;
      }

      .contact2 .font-weight-medium {
        font-weight: 500;
      }

      .contact2 .subtitle {
        color: #8d97ad;
        line-height: 24px;
      }

      .contact2 .bg-image {
        background-size: cover;
        position: relative;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
      }

      .contact2 .card.card-shadow {
          -webkit-box-shadow: 0px 0px 30px rgba(115, 128, 157, 0.1);
          box-shadow: 0px 0px 30px rgba(61, 109, 214, 0.774);
      }

      .contact2 .detail-box .round-social {
        margin-top: 100px;
      }

      .contact2 .round-social a {
        background: transparent;
        margin: 0 7px;
        padding: 11px 12px;
      }

      .contact2 .contact-container .links a {
        color: #8d97ad;
      }

      .contact2 .contact-container {
        position: relative;
        top: 107px;
      }

      .contact2 .btn-danger-gradiant {
        background: #ff4d7e;
        background: -webkit-linear-gradient(legacy-direction(to right), #ff4d7e 0%, #ff6a5b 100%);
        background: -webkit-gradient(linear, left top, right top, from(#ff4d7e), to(#ff6a5b));
        background: -webkit-linear-gradient(left, #ff4d7e 0%, #ff6a5b 100%);
        background: -o-linear-gradient(left, #ff4d7e 0%, #ff6a5b 100%);
        background: linear-gradient(to right, #ff4d7e 0%, #ff6a5b 100%);
      }

      .contact2 .btn-danger-gradiant:hover {
        background: #ff6a5b;
        background: -webkit-linear-gradient(legacy-direction(to right), #ff6a5b 0%, #ff4d7e 100%);
        background: -webkit-gradient(linear, left top, right top, from(#ff6a5b), to(#ff4d7e));
        background: -webkit-linear-gradient(left, #ff6a5b 0%, #ff4d7e 100%);
        background: -o-linear-gradient(left, #ff6a5b 0%, #ff4d7e 100%);
        background: linear-gradient(to right, #ff6a5b 0%, #ff4d7e 100%);
      }
    </style>
  
  <body>
  <?php include 'partials/_dbconnect.php';?>
  
      <!-- contact form -->
  <div class="contact-from-section mt-150 mb-150">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
              <div class="contact-box p-4">
                      <div class="row">
                        <div class="col-lg-8">
                          <h3 class="form-title">Have you any question?</h3>
                        </div>
                        <?php if($loggedin){ ?>
                          <div class="col-lg-4">
                            <div class="icon-badge-container mx-1" style="padding-left: 167px;">
                              <a href="#" data-toggle="modal" data-target="#adminReply"><i class="far fa-envelope icon-badge-icon"></i></a>
                              <div class="icon-badge"><b><span id="totalMessage">0</span></b></div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                      <?php
                          $passSql = "SELECT * FROM tbl_users WHERE id='$userId'"; 
                          $passResult = mysqli_query($conn, $passSql);
                          $row = mysqli_num_rows($passResult);
                          if($row){
                          $passRow=mysqli_fetch_assoc($passResult);
                          $email = $passRow['email'];
                          $phone = $passRow['phone'];
                          }
                      ?>
                      <form action="partials/_manageContactUs.php" method="POST">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group mt-3">
                                <b><label for="email">Email:</label></b>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required value="<?php if(!empty($email)) echo $email ?>">
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mt-3">
                                <b><label for="phone">Phone No:</label></b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon">+91</span>
                                    </div>
                                    <input type="tel" class="form-control" id="phone" name="phone" aria-describedby="basic-addon" placeholder="Enter Your Phone Number" required pattern="[0-9]{10}" value="<?php if(!empty($phone))echo $phone ?>">
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mt-3">
                              <b><label for="orderId">Order Id:</label></b>
                              <input class="form-control" type="text" id="orderId" name="orderId" placeholder="Order Id" value="0">
                              <small id="orderIdHelp" class="form-text text-muted">If your problem is not related to the order(order id = 0).</small>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group mt-3">
                              <b><label for="password">Password:</label></b>
                              <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" placeholder="Enter Your Password" required data-toggle="password">
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="form-group  mt-3">
                                <textarea class="form-control" id="message" name="message" rows="2" required minlength="6" placeholder="How May We Help You ?"></textarea>
                            </div>
                          </div>
                          <?php if($loggedin){ ?>
                            <div class="col-lg-12">
                              <input type="submit" value="SUBMIT">
                              <input type="submit" value="HISTORY" data-toggle="modal" data-target="#history">
                            </div>
                          <?php }else { ?>
                            <div class="col-lg-12">
                              <button type="submit" class="btn btn-danger-gradiant mt-3 text-white border-0 py-2 px-3" disabled><span> SUBMIT NOW <i class="ti-arrow-right"></i></span></button>
                              <small class="form-text text-muted">You need to log in first to contact us.</small>
                            </div>
                          <?php } ?>
                        </div>
                      </form>
                    </div>
                  </div>
                  <?php
                    $sql = "SELECT * FROM `tbl_sitedetail`";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    $systemName = $row['systemName'];
                    $address = $row['address'];
                    $email = $row['email'];
                    $contact1 = $row['contact1'];
                    $contact2 = $row['contact2'];

                    echo '<div class="col-lg-4">
          <div class="contact-form-wrap">
            <div class="contact-form-box">
              <h4><i class="fas fa-map"></i> Shop Address</h4>
              <p> Pune, Maharashtra </p>

            </div>
            <div class="contact-form-box">
              <h4><i class="far fa-clock"></i> Shop Hours</h4>
              <p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
            </div>
            <div class="contact-form-box">
              <h4><i class="fas fa-address-book"></i> Contact</h4>
              <p>Phone:' .$contact1. '
                <br> Email: support@Aookhaao@gmail.com </p>
            </div>
          </div>
        </div>';
        ?>
                </div>
              </div>
            </div>
         

      <!-- Message Modal -->
      <div class="modal fade" id="adminReply" tabindex="-1" role="dialog" aria-labelledby="adminReply" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(249 128 27);">
              <h5 class="modal-title" id="adminReply">Admin Reply</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="messagebd">
              <table class="table-striped table-bordered col-md-12 text-center">
                <thead style="background-color: rgb(249 128 27);">
                    <tr>
                        <th>Contact Id</th>
                        <th>Reply Message</th>
                        <th>datetime</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $sql = "SELECT * FROM `tbl_contactreply` WHERE `userId`='$userId'"; 
                    $result = mysqli_query($conn, $sql);
                    $count = 0;
                    while($row=mysqli_fetch_assoc($result)) {
                        $contactId = $row['contactId'];
                        $message = $row['message'];
                        $datetime = $row['datetime'];
                        $count++;
                        echo '<tr>
                                <td>' .$contactId. '</td>
                                <td>' .$message. '</td>
                                <td>' .$datetime. '</td>
                              </tr>';
                    }
                    echo '<script>document.getElementById("totalMessage").innerHTML = "' .$count. '";</script>';
                    if($count==0) {
                      ?><script> document.getElementById("messagebd").innerHTML = '<div class="my-1">you have not recieve any message.</div>';</script> <?php
                    }
                ?>
                </tbody>
		          </table>
            </div>
          </div>
        </div>
      </div>

      <!-- history Modal -->
      <div class="modal fade" id="history" tabindex="-1" role="dialog" aria-labelledby="history" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(249 128 27);">
              <h5 class="modal-title" id="history">Your Sent Message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="bd">
              <table class="table-striped table-bordered col-md-12 text-center">
                <thead style="background-color: rgb(249 128 27);">
                    <tr>
                        <th>Contact Id</th>
                        <th>Order Id</th>
                        <th>Message</th>
                        <th>datetime</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $sql = "SELECT * FROM `tbl_contact` WHERE `userId`='$userId'"; 
                    $result = mysqli_query($conn, $sql);
                    $count = 0;
                    while($row=mysqli_fetch_assoc($result)) {
                        $contactId = $row['contactId'];
                        $orderId = $row['orderId'];
                        $message = $row['message'];
                        $datetime = $row['time'];
                        $count++;
                        echo '<tr>
                                <td>' .$contactId. '</td>
                                <td>' .$orderId. '</td>
                                <td>' .$message. '</td>
                                <td>' .$datetime. '</td>
                              </tr>';
                    }                
                    if($count==0) {
                      ?><script> document.getElementById("bd").innerHTML = '<div class="my-1">you have not contacted us.</div>';</script> <?php
                    }    
                ?>
                </tbody>
		          </table>
            </div>
          </div>
        </div>
      </div>


  <?php require_once 'footer.php';
  ?> 

    