<!DOCTYPE html>
<html lang="en">

<head>
    <!-- META SECTION -->
    <title>Joli Admin - Responsive Bootstrap Admin Template</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css" />
    <!-- EOF CSS INCLUDE -->
    <?php
                    $username= $_SESSION['username'];
                    $password= $_SESSION['password'];
                    $db=mysqli_connect("localhost","root","raghib@1998","juned");
                    $query="SELECT * from admin WHERE username='$username' AND password='$password'";
                    $query1="SELECT * from depositor ";
                    $query2="SELECT * from advance_taker ";
                    $query3="SELECT * from usrAcc ";
                    $query4="SELECT * from allAcc ";
                    $query5="SELECT * from saving_dept ";
                    $query6="SELECT * from current_dept";
                    $query7="SELECT * from fixed_dept";
                    $query8="SELECT * from recurring_dept ";
                    $getmessage="SELECT count(message) as messages from notification where username='$username' and isReaded=0";
                    $message="SELECT * from notification where username='$username' and isReaded=0 order by date_of_notification desc,time_of_notification desc";
                    $messageall="SELECT * from notification where username='$username' order by date_of_notification desc,time_of_notification desc";
                    $result=mysqli_query($db,$query) or die("login couldnt be completed!!");
                    $result1=mysqli_query($db,$query1) or die("account no couldnt be found1!!");
                    $result2=mysqli_query($db,$query2) or die("account no couldnt be found2!!");
                    $result3=mysqli_query($db,$query3) or die("account no couldnt be found3!!");
                    $result4=mysqli_query($db,$query4) or die("account no couldnt be found4!!"); 
                    $result5=mysqli_query($db,$query5) or die("account no couldnt be found5!!");
                    $result6=mysqli_query($db,$query6) or die("account no couldnt be foun6d!!");
                    $result7=mysqli_query($db,$query7) or die("account no couldnt be found7!!"); 
                    $result8=mysqli_query($db,$query8) or die("account no couldnt be found!8!");
                    $getmessageresult=mysqli_query($db,$getmessage) or die("account no couldnt be found!9!");   
                    $messageresult=mysqli_query($db,$message) or die("account no couldnt be found12!!"); 
                    $messageallresult=mysqli_query($db,$messageall) or die("account no couldnt be found!!");   
                    $row=mysqli_fetch_array($result);
                    $row1=mysqli_fetch_array($result1);
                    $getmessagerow=mysqli_fetch_array($getmessageresult); 
                    mysqli_close($db);
        ?>
</head>

<body>
    <!-- START PAGE CONTAINER -->
    <div class="page-container">

        <!-- START PAGE SIDEBAR -->
        <div class="page-sidebar" style="background-color : white;">
            <!-- START X-NAVIGATION -->
            <ul class="x-navigation">
                <li class="xn-logo">
                    <a href="index.html" style="background-color : #1f61db;">
                        <span class="fa fa-university" style="font-size: 24px; color : white;"></span> miniBANK</a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="#" class="profile-mini">
                        <img src="assets/images/users/avatar.jpg" alt="John Doe"  />
                    </a>
                    <div class="profile">
                        <div class="admin profile-image" >
                            <img src="assets/images/users/avatar.jpg" alt="John Doe" />
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name"><?php echo $row['name']?></div>
                            <div class="profile-data-title"><?php echo $row['username']?><</div>
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
                
                <li class="active">
                    <a href="index.php">
                        <span class="fa fa-desktop"></span>
                        <span class="xn-text">Dashboard</span>
                    </a>
                </li>
                <li class="xn-openable">
                    <a href="">
                        <span class="fa fa-users"></span>
                        <span class="xn-text"> Users</span>
                    </a>
                    <ul>
                
                        <li>
                            <a href="users-saving-deposit.php">
                                <span class="fa fa-archive"></span> Saving Deposit</a>
                        </li>
                        <li>
                            <a href="users-fixed-deposit.php">
                                <span class="fa fa-flash"></span> Fixed Deposit</a>
                        </li>
                        <li>
                            <a href="users-current-deposit.php">
                                <span class="fa fa-credit-card"></span> Current Deposit</a>
                        </li>
                        <li>
                            <a href="users-recurring-deposit.php">
                                <span class="fa fa-sort-amount-desc"></span> Recurring Deposit</a>
                        </li>
                    </ul>
                </li>
            
                
                <li>
                    <a href="">
                        <span class="fa fa-download"></span> Deposit</a>
                </li>
                <li>
                    <a href="">
                        <span class="fa fa-briefcase"></span> Withdrawal</a>
                </li>
                <li>
                    <a href="">
                        <span class="fa fa-share-square-o"></span> Money Transfer</a>
                </li>
                <li>
                    <a href="user-detail.php">
                        <span class="fa fa-table"></span> User Table</a>
                </li>
                <li>
                    <a href="account-table.php">
                        <span class="fa fa-building-o"></span> Account Table</a>
                </li>
                
                <li>
                    <a href="txn-all.php">
                        <span class="fa fa-inr"></span> Transaction Tables</a>
                </li>
               
                <li>
                    <a href="messages.php">
                        <span class="fa fa-comments"></span>
                        <span class="xn-text">Messages</span>
                    </a>
                </li>
                <li>
                	<a href="notification.php">
                		<span class="fa fa-comments"></span>
                        <span class="xn-text">Notifications</span>

            </ul>
            <!-- END X-NAVIGATION -->
        </div>
        <!-- END PAGE SIDEBAR -->

        <!-- PAGE CONTENT -->
        <div class="page-content">

            <!-- START X-NAVIGATION VERTICAL -->
            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
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
                <li class="xn-icon-button pull-right">
                    <a href="#" class="mb-control" data-box="#mb-signout">
                        <span class="fa fa-sign-out"></span>
                    </a>
                </li>
                <!-- END SIGN OUT -->
                <!-- MESSAGES -->
                <li class="xn-icon-button pull-right">
                    <a href="#">
                        <span class="fa fa-comments"></span>
                    </a>
                    <div class="informer informer-danger"><?php echo $getmessagerow['message']?></div>
                    <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <span class="fa fa-comments"></span> Messages</h3>
                            <div class="pull-right">
                                <span class="label label-danger"><?php echo $getmessagerow['message']?> new</span>
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
                            <a href="messages.php">Show all messages</a>
                        </div>
                    </div>
                </li>
                <!-- END MESSAGES -->
                <!-- TASKS -->
                <
                <!-- END TASKS -->
            </ul>
            <!-- END X-NAVIGATION VERTICAL -->

            <!-- START BREADCRUMB -->

            <!-- END BREADCRUMB -->

            <!-- PAGE TITLE -->

            <!-- END PAGE TITLE -->

            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap" style="margin-top:10px;">

                
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="color:#1f61db;">
                                    <span class="fa fa-sort-amount-asc"></span> Depositor</h3>
                                <ul class="panel-controls">
                                    <li>
                                        <a href="#" class="panel-collapse">
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-refresh">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-remove">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Cin</th>
                                            <th>Customer Type</th>
                                            <th>Account Type</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row1=mysqli_fetch_array($result1)){?>
                                        <tr>
                                            <td>
                                                <?php echo $row1['username']?>
                                            </td>
                                            <td>
                                                <?php echo $row1['cin']?>
                                            </td>
                                            <td>
                                                <?php echo $row1['cust_type']?>
                                            </td>
                                            <td>
                                                <?php echo $row1['account_type']?>
                                            </td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="color:#1f61db;">
                                    <span class="fa fa-mail-reply-all"></span> Advance Taker</h3>
                                <ul class="panel-controls">
                                    <li>
                                        <a href="#" class="panel-collapse">
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-refresh">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-remove">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable ">
                                     <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Cin</th>
                                            <th>Customer Type</th>
                                            <th>Account Type</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row2=mysqli_fetch_array($result2)){?>
                                        <tr>
                                            <td>
                                                <?php echo $row2['username']?>
                                            </td>
                                            <td>
                                                <?php echo $row2['cin']?>
                                            </td>
                                            <td>
                                                <?php echo $row2['cust_type']?>
                                            </td>
                                            <td>
                                                <?php echo $row2['account_type']?>
                                            </td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="color:#1f61db;">
                                    <span class="fa fa-book"></span> Depositor Information</h3>
                                <ul class="panel-controls">
                                    <li>
                                        <a href="#" class="panel-collapse">
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-refresh">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-remove">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable ">
                                   <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Account Type</th>
                                            <th>Cin</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row3=mysqli_fetch_array($result3)){?>
                                        <tr>
                                            <td>
                                                <?php echo $row3['username']?>
                                            </td>
                                            <td>
                                                <?php echo $row3['name']?>
                                            </td>
                                            <td>
                                                <?php echo $row3['account_no']?>
                                            </td>
                                            <td>
                                                <?php echo $row3['cin']?>
                                            </td>
                                            <td>
                                                <?php echo $row3['balance']?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="color:#1f61db;">
                                    <span class="fa fa-credit-card"></span> All Accounts</h3>
                                <ul class="panel-controls">
                                    <li>
                                        <a href="#" class="panel-collapse">
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-refresh">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-remove">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Cin</th>
                                            <th>Account Type</th>
                                            <th>Balance</th>
                                            <th>Opening Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row4=mysqli_fetch_array($result4)){?>
                                        <tr>
                                            <td>
                                                <?php echo $row4['username']?>
                                            </td>
                                            <td>
                                                <?php echo $row4['cin']?>
                                            </td>
                                            <td>
                                                <?php echo $row4['account_no']?>
                                            </td>
                                            <td>
                                                <?php echo $row4['balance']?>
                                            </td>
                                            <td>
                                                <?php echo $row4['opening_date']?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="color:#1f61db;">
                                    <span class="fa fa-download"></span> Saving Deposit</h3>
                                <ul class="panel-controls">
                                    <li>
                                        <a href="#" class="panel-collapse">
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-refresh">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-remove">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </li> 
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Cin</th>
                                            <th>Account Number</th>
                                            <th>Balance</th>
                                            <th>Opening Date</th>
                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row5=mysqli_fetch_array($result5)){?>
                                        <tr>
                                            <td>
                                                <?php echo $row5['username']?>
                                            </td>
                                            <td>
                                                <?php echo $row5['cin']?>
                                            </td>
                                            <td>
                                                <?php echo $row5['account_no']?>
                                            </td>
                                            <td>
                                                <?php echo $row5['balance']?>
                                            </td>
                                            <td>
                                                <?php echo $row5['opening_date']?>
                                            </td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="color:#1f61db;">
                                    <span class="fa fa-briefcase"></span> Current Deposit</h3>
                                <ul class="panel-controls">
                                    <li>
                                        <a href="#" class="panel-collapse">
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-refresh">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-remove">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Cin</th>
                                            <th>Account Number</th>
                                            <th>Balance</th>
                                            <th>Opening Date</th>
                                            <th>Over Draft</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row6=mysqli_fetch_array($result6)){?>
                                        <tr>
                                            <td>
                                                <?php echo $row6['username']?>
                                            </td>
                                            <td>
                                                <?php echo $row6['cin']?>
                                            </td>
                                            <td>
                                                <?php echo $row6['account_no']?>
                                            </td>
                                            <td>
                                                <?php echo $row6['balance']?>
                                            </td>
                                            <td>
                                                <?php echo $row6['opening_date']?>
                                            </td>
                                            <td>
                                                <?php echo $row6['over_draft']?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="color:#1f61db;">
                                    <span class="fa fa-bolt"></span> Fixed Deposit</h3>
                                <ul class="panel-controls">
                                    <li>
                                        <a href="#" class="panel-collapse">
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-refresh">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-remove">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Cin</th>
                                            <th>Account Number</th>
                                            <th>Balance</th>
                                            <th>Opening Date</th>
                                            <th>Period Policy</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row7=mysqli_fetch_array($result7)){?>
                                        <tr>
                                            <td>
                                                <?php echo $row7['username']?>
                                            </td>
                                            <td>
                                                <?php echo $row7['cin']?>
                                            </td>
                                            <td>
                                                <?php echo $row7['account_no']?>
                                            </td>
                                            <td>
                                                <?php echo $row7['balance']?>
                                            </td>
                                            <td>
                                                <?php echo $row7['opening_date']?>
                                            </td>
                                            <td>
                                                <?php echo $row7['period_policy']?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="color:#1f61db;">
                                    <span class="fa fa-clock-o"></span> Recurring Deposit</h3>
                                <ul class="panel-controls">
                                    <li>
                                        <a href="#" class="panel-collapse">
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-refresh">
                                            <span class="fa fa-refresh"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="panel-remove">
                                            <span class="fa fa-times"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <table class="table datatable ">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Cin</th>
                                            <th>Account Number</th>
                                            <th>Balance</th>
                                            <th>Opening Date</th>
                                            <th>Period Policy</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row8=mysqli_fetch_array($result8)){?>
                                        <tr>
                                            <td>
                                                <?php echo $row8['username']?>
                                            </td>
                                            <td>
                                                <?php echo $row8['cin']?>
                                            </td>
                                            <td>
                                                <?php echo $row8['account_no']?>
                                            </td>
                                            <td>
                                                <?php echo $row8['balance']?>
                                            </td>
                                            <td>
                                                <?php echo $row8['opening_date']?>
                                            </td>
                                            <td>
                                                <?php echo $row8['period_policy']?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
            <!-- PAGE CONTENT WRAPPER -->
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
                        <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
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

    <!-- THIS PAGE PLUGINS -->
    <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
    <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

    <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
    <!-- END PAGE PLUGINS -->

    <!-- START TEMPLATE -->
    <script type="text/javascript" src="js/settings.js"></script>

    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/actions.js"></script>
    <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->

</body>

</html>