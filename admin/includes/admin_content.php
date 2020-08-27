<?php include_once("init.php"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>
            <?php
               //$user_found = User::get_all_users();
               //$user_found = User::get_user_by_id(2);
                $user_found = User::get_user_by_pass(123);
                //foreach ($user_found as $user) echo $user;
                //mysqli_fetch_array it return the query and put it in an array

                foreach(mysqli_fetch_array($user_found) as $user){
                    echo $user['username'] . "<br>";
                }

            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->