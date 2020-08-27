<?php include_once("init.php"); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>
            <?php                              // QQQQQQQQQ    why for each print users twice ... why database has an error
                $sql = "SELECT * FROM users WHERE id=1  ";
                $result = $database->query($sql);
                $user_found = mysqli_fetch_array($result);    //mysqli_fetch_array it return the query and put it in an array

                /*foreach($user_found as $user){
                    echo $user . "<br>";
                }*/

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