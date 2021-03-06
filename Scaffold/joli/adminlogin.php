<?php
session_start();
if (isset($_POST['submit']))
{
    $_SESSION['username']=$_POST['username'];
    $_SESSION['password']=$_POST['password'];
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- META SECTION -->
        <title>MiniBank</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css" />
        <!-- EOF CSS INCLUDE -->
        <?php
                $username=$_SESSION['username'];
                $password=$_SESSION['password'];
                $db=mysqli_connect("localhost","root","raghib@1998","juned");
                
                $query="SELECT * from user WHERE username='$username' AND password='$password'";
                $query1="SELECT * from allAcc where username='$username' ";
                $query2="SELECT * from allTransaction where username='$username' and type='DEBIT' order by date_of_transaction desc,time_of_transaction desc limit 1";
                $query3="SELECT * from allTransaction where username='$username' and type='CREDIT' order by date_of_transaction desc,time_of_transaction desc limit 1";
                $getmessage="SELECT count(message) as messages from notification where username='$username' and isReaded=0";
                $message="SELECT * from notification where username='$username' and isReaded=0 order by time_of_notification desc,date_of_notification desc";
                $messageall="SELECT * from notification where username='$username' order by time_of_notification desc,date_of_notification desc";
                $result=mysqli_query($db,$query) or die("login couldnt be completed!!");
                $result1=mysqli_query($db,$query1) or die("account no couldnt be found!!");
                $result2=mysqli_query($db,$query2) or die("account no couldnt be found!!");
                $result3=mysqli_query($db,$query3) or die("account no couldnt be found!!"); 
                $getmessageresult=mysqli_query($db,$getmessage) or die("account no couldnt be found!!");   
                $messageresult=mysqli_query($db,$message) or die("account no couldnt be found!!"); 
                $messageallresult=mysqli_query($db,$messageall) or die("account no couldnt be found!!");   
                $row=mysqli_fetch_array($result);
                $row1=mysqli_fetch_array($result1);
                $row2=mysqli_fetch_array($result2);
                $row3=mysqli_fetch_array($result3);
                $getmessagerow=mysqli_fetch_array($getmessageresult);
                
                mysqli_close($db);
    ?>
            <script>
                function myFunction(contentId) {
                    var arr = document.getElementsByClassName("sem");
                    for (var i = 0; i < arr.length; i++) {
                        arr[i].style.display = "none";
                    }
                    var x = document.getElementById(contentId);
                    console.log(contentId);

                    contentId.style.display = "block";
                }

            </script>
            <style>
                .sem {
                    display: none;
                }

                .table-responsive {
                    height: 300px;
                    overflow: auto;
                }
            </style>
    </head>

    <body>
        <!-- START PAGE CONTAINER -->

        <div class="page-container">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar" style="position : fixed;">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <img src="assets/images/logo.png" alt="MiniBank" />
                        <a class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="assets/images/users/avatar.jpg" alt="Mohd Sadique" />
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="assets/images/users/avatar.jpg" alt="Mohd Sadique" />
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">
                                    <?php echo $row['name'];?>
                                </div>
                                <div class="profile-data-title">Welcome</div>
                            </div>
                            <div class="profile-controls">
                                <a href="pages-profile.html" class="profile-control-left">
                                    <span class="fa fa-info"></span>
                                </a>
                                <a href="pages-messages.html" class="profile-control-right">
                                    <span class="fa fa-envelope"></span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="xn-title">DASHBOARD</li>
                    <li class="">
                        <a onclick="myFunction(detail)">
                            <span class="fa fa-desktop"></span>
                            <span class="xn-text">All Users</span>
                        </a>
                    </li>
                    <li class="">
                        <a onclick="myFunction(transiction)">
                            <span class="fa fa-desktop"></span>
                            <span class="xn-text">Transactions</span>
                        </a>
                    </li>
                    <li class="">
                        <a onclick="myFunction(moneytransfer)">
                            <span class="fa fa-desktop"></span>
                            <span class="xn-text">Money Transfer</span>
                        </a>
                    </li>
                    <li class="">
                        <a onclick="myFunction(withdraw)">
                            <span class="fa fa-desktop"></span>
                            <span class="xn-text">Withdraw Amount</span>
                        </a>
                    </li>
                    <li class="">
                        <a onclick="myFunction(deposit)">
                            <span class="fa fa-desktop"></span>
                            <span class="xn-text">Deposit Amount</span>
                        </a>
                    </li>
                    <li class="">
                        <a onclick="myFunction(message)">
                            <span class="fa fa-desktop"></span>
                            <span class="xn-text">Messages</span>
                        </a>
                    </li>

                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel" style="position : fixed;">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize">
                            <span class="fa fa-dedent"></span>
                        </a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..." />
                        </form>
                    </li>
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right" style="position : fixed; right :1em;">
                        <a href="#" class="mb-control" data-box="#mb-signout">
                            <span class="fa fa-sign-out"></span>
                        </a>
                    </li>
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->

                    <li class="xn-icon-button pull-right" style="position : fixed; right : 5em;">
                        <a href="#">
                            <span class="fa fa-comments"></span>
                        </a>
                        <div class="informer informer-danger">
                            <?php 
                            echo $getmessagerow['messages'];
                        ?>
                        </div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <span class="fa fa-comments"></span> Messages</h3>
                                <div class="pull-right">
                                    <span class="label label-danger">
                                        <?php echo $getmessagerow['messages']; ?> new</span>
                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                                <?php
                            
                            while ($messagerow=mysqli_fetch_array($messageresult))
                            {
                            ?>

                                    <a href="#" class="list-group-item">
                                        <div class="list-group-status status-online"></div>
                                        <span class="contacts-title">
                                            <?php echo $messagerow['time_of_notification']." ".$messagerow['date_of_notification']?>
                                        </span>
                                        <p>
                                            <?php echo $messagerow['message'] ?>
                                        </p>
                                    </a>
                                    <?php
                            }
                            ?>
                            </div>
                            <div class="panel-footer text-center">
                                <a onclick="myFunction(message)">Show all messages</a>
                            </div>
                        </div>
                    </li>
                    <!-- END MESSAGES -->
                    <!-- TASKS -->

                    <!-- END TASKS -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">Dashboard</li>
                </ul>
                <!-- END BREADCRUMB -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START WIDGETS -->

                    <!-- END WIDGETS -->
                    <div class="row">
                        <div class="col-md-9 sem" style="padding-top : 35px; padding-left : 20px;" id="detail">
                            <div class="col sem" id="message">
                                <div class="col" style="height: 100%; max-height: 500px; overflow-y: scroll;">
                                    <div class="content-frame-top">
                                        <div class="page-title">
                                            <h2>
                                                <span class="fa fa-comments"></span> Messages</h2>
                                        </div>
                                    </div>
                                    <div class="content-frame-body content-frame-body-left">

                                        <div class="messages messages-img">
                                            <?php
                                            while ($messageallrow=mysqli_fetch_array($messageallresult))
                                            {
                                        ?>
                                                <div class="item in">
                                                    <div class="image">
                                                        <img src="favicon.ico" alt="John Doe">
                                                    </div>
                                                    <div class="text">
                                                        <div class="heading">
                                                            <a href="#">
                                                                <?php echo $messageallrow['time_of_notification']." ".$messageallrow['date_of_notification'];?>
                                                            </a>
                                                            <span class="date">
                                                                <?php echo " Account No. ".$messageallrow['account_no'];?>
                                                            </span>
                                                        </div>
                                                        <?php echo $messageallrow['message'];?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        ?>

                                        </div>
                                    </div>

                                </div>
                                <div class="panel panel-default push-up-10">
                                    <div class="panel-body panel-body-search">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default">
                                                    <span class="fa fa-camera"></span>
                                                </button>
                                                <button class="btn btn-default">
                                                    <span class="fa fa-chain"></span>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Your message..." />
                                            <div class="input-group-btn">
                                                <button class="btn btn-default">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="page-title">
                                    <h2>
                                        <span class="fa fa-users"></span> All Users
                                        <small>139 users</small>
                                    </h2>
                                </div>
                                <!-- START PROJECTS BLOCK -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user3.jpg" alt="Nadia Ali" />
                                                </div>
                                                <div class="profile-data">
                                                    
                                                    <input type="text-center" name="name">
                                                    <div class="profile-data-title">Singer-Songwriter</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(555) 555-55-55</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>nadiaali@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user.jpg" alt="Dmitry Ivaniuk" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">Dmitry Ivaniuk</div>
                                                    <div class="profile-data-title">Web Developer</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(333) 333-33-22</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>dmitry@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user2.jpg" alt="John Doe" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">John Doe</div>
                                                    <div class="profile-data-title">Web Developer/Designer</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(234) 567-89-12</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>john@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user4.jpg" alt="Brad Pitt" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">Brad Pitt</div>
                                                    <div class="profile-data-title">Actor and Film Producer</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(321) 777-55-11</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>brad@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user5.jpg" alt="John Travolta" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">John Travolta</div>
                                                    <div class="profile-data-title">Actor</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(111) 222-33-78</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>travolta@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user6.jpg" alt="Darth Vader" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">Darth Vader</div>
                                                    <div class="profile-data-title">Cyborg</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(000) 000-00-01</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>vader@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>Somewhere deep in space</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user7.jpg" alt="Samuel Leroy Jackson" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">Samuel Leroy Jackson</div>
                                                    <div class="profile-data-title">Actor and film producer</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(552) 221-23-25</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>samuel@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/no-image.jpg" alt="Samuel Leroy Jackson" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">Alex Sonar</div>
                                                    <div class="profile-data-title">Designer</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="pages-profile.html" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(213) 428-74-13</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>alex@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user5.jpg" alt="John Travolta" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">John Travolta</div>
                                                    <div class="profile-data-title">Actor</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(111) 222-33-78</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>travolta@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user6.jpg" alt="Darth Vader" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">Darth Vader</div>
                                                    <div class="profile-data-title">Cyborg</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(000) 000-00-01</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>vader@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>Somewhere deep in space</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/user7.jpg" alt="Samuel Leroy Jackson" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">Samuel Leroy Jackson</div>
                                                    <div class="profile-data-title">Actor and film producer</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="#" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(552) 221-23-25</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>samuel@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                    <div class="col-md-3">
                                        <!-- CONTACT ITEM -->
                                        <div class="panel panel-default">
                                            <div class="panel-body profile">
                                                <div class="profile-image">
                                                    <img src="assets/images/users/no-image.jpg" alt="Samuel Leroy Jackson" />
                                                </div>
                                                <div class="profile-data">
                                                    <div class="profile-data-name">Alex Sonar</div>
                                                    <div class="profile-data-title">Designer</div>
                                                </div>
                                                <div class="profile-controls">
                                                    <a href="pages-profile.html" class="profile-control-left">
                                                        <span class="fa fa-info"></span>
                                                    </a>
                                                    <a href="#" class="profile-control-right">
                                                        <span class="fa fa-phone"></span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <div class="contact-info">
                                                    <p>
                                                        <small>Mobile</small>
                                                        <br/>(213) 428-74-13</p>
                                                    <p>
                                                        <small>Email</small>
                                                        <br/>alex@domain.com</p>
                                                    <p>
                                                        <small>Address</small>
                                                        <br/>123 45 Street San Francisco, CA, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END CONTACT ITEM -->
                                    </div>
                                </div>
                                <!-- END PROJECTS BLOCK -->

                            </div>


                        </div>
                        <div id="transiction" class="col-md-9 sem">

                            <!-- START PROJECTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>TRANSACTIONS</h3>
                                        <span>Last Transactions</span>
                                    </div>
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li>
                                            <a href="#" class="panel-fullscreen">
                                                <span class="fa fa-expand"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="panel-refresh">
                                                <span class="fa fa-refresh"></span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <span class="fa fa-cog"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="#" class="panel-collapse">
                                                        <span class="fa fa-angle-down"></span> Collapse</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="panel-remove">
                                                        <span class="fa fa-times"></span> Remove</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <div style="position : fixed;">
                                                    <tr>
                                                        <th width="20%">TransactionID</th>
                                                        <th width="15%">Amount</th>
                                                        <th width="15%">Time</th>
                                                        <th width="15%">Date</th>
                                                        <th width="10%">Type</th>
                                                    </tr>
                                                </div>
                                            </thead>
                                            <tbody>
                                                <?php
                                                                    $username=$_POST['username'];
                                                                    $password=$_POST['password'];
                                                                    $db1=mysqli_connect("localhost","root","raghib@1998","juned");
                                                                    $query4="SELECT * from allTransaction order by time_of_transaction desc,date_of_transaction ";
                                                                    $result4=mysqli_query($db1,$query4) or die("account no couldnt be found!!");   
                        
                                                                    while ($row4=mysqli_fetch_array($result4))
                                                                    {
                                                                     echo "<tr>
                                                                    <td>
                                                                        <div class='widget-subtitle'>" .$row4['transaction_id']."</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='widget-subtitle'>".$row4['ammount']."</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='widget-subtitle'>".$row4['time_of_transaction']."</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='widget-subtitle'>".$row4['date_of_transaction']."</div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='widget-subtitle'>".$row4['type']."</div>
                                                                    </td>
                                                                 </tr>";
                                                                    }
                                                                    mysqli_close($db1);
                        
                                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- END PROJECTS BLOCK -->

                        </div>


                    </div>
                </div>
                <div class="col-md-3" style="position : fixed; bottom : 0em; right : 1em; padding-right:0px; padding-left:70px;">
                    <div class="">
                        <div class="col">

                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-info widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>
                                <div class="widget-subtitle plugin-date">Loading...</div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget">
                                        <span class="fa fa-times"></span>
                                    </a>
                                </div>
                                <div class="widget-buttons widget-c3">
                                    <div class="col">
                                        <a href="#">
                                            <span class="fa fa-clock-o"></span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="#">
                                            <span class="fa fa-bell"></span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="#">
                                            <span class="fa fa-calendar"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET CLOCK -->

                        </div>
                        <div class="col">

                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-title" style="font-size:12px;">Account Number</div>
                                    <div class="widget-title" style="font-size:20px;">
                                        <strong>
                                            <?php echo $row1['account_no']?>
                                        </strong>
                                    </div>
                                    <div class="widget-title" style="font-size:12px;">Customer Idetificatin Number</div>
                                    <div class="widget-title" style="font-size:20px;">
                                        <strong>
                                            <?php echo $row1['cin']?>
                                        </strong>
                                    </div>
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget">
                                        <span class="fa fa-times"></span>
                                    </a>
                                </div>
                            </div>
                            <!-- END WIDGET REGISTRED -->

                        </div>
                        <div class="col">

                            <!-- START WIDGET SLIDER -->
                            <div class="widget widget-default widget-carousel">
                                <div class="owl-carousel" id="owl-example">
                                    <div>
                                        <div class="widget-title">Total Amount</div>
                                        <div class="widget-subtitle">27/03/2018 15:23</div>
                                        <div class="widget-int" style="font-size : 40sp; padding-top : 30px">
                                            <?php echo $row1['balance']?>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="widget-title">Last Amount Debited</div>
                                        <div class="widget-subtitle">
                                            <?php echo $row2['date_of_transaction']?>
                                        </div>
                                        <div class="widget-int">
                                            <?php echo $row2['ammount']?>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="widget-title">Last Amount Credited</div>
                                        <div class="widget-subtitle">
                                            <?php echo $row3['date_of_transaction']?>
                                        </div>
                                        <div class="widget-int">
                                            <?php echo $row3['ammount']?>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget">
                                        <span class="fa fa-times"></span>
                                    </a>
                                </div>
                            </div>
                            <!-- END WIDGET SLIDER -->

                        </div>
                        <div class="col">

                            <!-- START WIDGET MESSAGES -->

                            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-envelope"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count">48</div>
                                    <div class="widget-title">New messages</div>
                                    <div class="widget-subtitle">In your mailbox</div>
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget">
                                        <span class="fa fa-times"></span>
                                    </a>
                                </div>
                            </div>
                            <!-- END WIDGET MESSAGES -->

                        </div>


                    </div>
                </div>
            </div>



            <div id="transiction" class="col-md-8 sem">

                <!-- START PROJECTS BLOCK -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title-box">
                            <h3>TRANSACTIONS</h3>
                            <span>Last Transactions</span>
                        </div>
                        <ul class="panel-controls" style="margin-top: 2px;">
                            <li>
                                <a href="#" class="panel-fullscreen">
                                    <span class="fa fa-expand"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="panel-refresh">
                                    <span class="fa fa-refresh"></span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="fa fa-cog"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" class="panel-collapse">
                                            <span class="fa fa-angle-down"></span> Collapse</a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-remove">
                                            <span class="fa fa-times"></span> Remove</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <div style="position : fixed;">
                                        <tr>
                                            <th width="20%">TransactionID</th>
                                            <th width="15%">Amount</th>
                                            <th width="15%">Time</th>
                                            <th width="15%">Date</th>
                                            <th width="10%">Type</th>
                                        </tr>
                                    </div>
                                </thead>
                                <tbody>
                                    <?php
                                            $username=$_POST['username'];
                                            $password=$_POST['password'];
                                            $db1=mysqli_connect("localhost","root","raghib@1998","juned");
                                            $query4="SELECT * from allTransaction where username='$username' order by time_of_transaction desc,date_of_transaction ";
                                            $result4=mysqli_query($db1,$query4) or die("account no couldnt be found!!");   

                                            while ($row4=mysqli_fetch_array($result4))
                                            {
                                             echo "<tr>
                                            <td>
                                                <div class='widget-subtitle'>" .$row4['transaction_id']."</div>
                                            </td>
                                            <td>
                                                <div class='widget-subtitle'>".$row4['ammount']."</div>
                                            </td>
                                            <td>
                                                <div class='widget-subtitle'>".$row4['time_of_transaction']."</div>
                                            </td>
                                            <td>
                                                <div class='widget-subtitle'>".$row4['date_of_transaction']."</div>
                                            </td>
                                            <td>
                                                <div class='widget-subtitle'>".$row4['type']."</div>
                                            </td>
                                         </tr>";
                                            }
                                            mysqli_close($db1);

                                        ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- END PROJECTS BLOCK -->

            </div>



        </div>



        <!-- START DASHBOARD CHART -->
        <div class="chart-holder" id="dashboard-area-1" style="height: 200px;"></div>
        <div class="block-full-width">

        </div>
        <!-- END DASHBOARD CHART -->

        </div>
        <!-- END PAGE CONTENT WRAPPER -->
        </div>
        <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title">
                        <span class="fa fa-sign-out"></span> Log
                        <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

        <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>
        <script type="text/javascript" src="js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->


        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>

        <script type="text/javascript" src="js/demo_dashboard.js"></script>

        <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->
    </body>

    </html>