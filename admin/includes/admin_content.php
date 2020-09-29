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

               //mysqli_fetch_array it return the query and put it in an array
//               $user_found = User::get_all_users();
//               while ($row = mysqli_fetch_array($user_found)) {
//                   echo $row['username'] ."<br>";
//               }

               //$user_found = User::get_user_by_id(2);

                //$user_found = User::get_user_by_pass(123);
//                while ($row = mysqli_fetch_array($user_found)) {
//                    echo $row['username'] ."<br>";
//                }

                 // QQQQQQ   I want to print all the usernames that has this password
//                foreach($user_found as $u) echo $u; */


                //this is a way which i creat object and init every property in the object with it's value , but it is boring as the table can have hundreds of data

//                $user_found = User::get_user_by_id(2);
//                $user = new User();
//
//                $user-> id = $user_found['id'];
//                $user-> username = $user_found['username'];
//                $user-> password = $user_found['password'];
//                $user-> first_name = $user_found['first_name'];
//                $user-> last_name = $user_found['last_name'];
//
//                echo $user->first_name. "<br>";
//                echo $user->last_name;


            // Doing the same as above but in easier way
//                    $users = User::get_all_users();
//                    foreach ($users as $user){
//                        echo $user-> password . "<br>";
//                    }



//                $user = User::get_user_by_id(1);
//                echo $user-> username. "<br>";

                // print the user that have the given password if there is no users it will print empty
                /*$users = User::get_user_by_pass(123);
                if (!empty($users)) {
                    foreach ($users as $user) {
                        echo $user->username . "<br>";
                    }
                }
                else echo "Empty" ;*/

//                $user = User::get_user_by_id(9);
//                $user = new User();
//                $user->username = "youssef211";
//                $user->delete();

//                $user = new User();
//                $user->username = "Ahmed1";
//                $user->password = "125";
//                $user->first_name = "Ahmed1";
//                $user->last_name = "Ayman1";
//                $user->create();


                $user = User::get_user_by_id(12);
                $user->username = "Ahmed12";
                $user->password = "1159357";
                $user->first_name = "Ahmed12";
                $user->last_name = "Ayman12";

                $user->update();





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