<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
            <br/><br/>

            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
            if(isset($_SESSION['pw-not-match'])){
                echo $_SESSION['pw-not-match'];
                unset($_SESSION['pw-not-match']);
            }
            if(isset($_SESSION['pw-changed'])){
                echo $_SESSION['pw-changed'];
                unset($_SESSION['pw-changed']);
            }
            if(isset($_SESSION['pw-not-changed'])){
                echo $_SESSION['pw-not-changed'];
                unset($_SESSION['pw-not-changed']);
            }

            ?>

            <br/><br/>
        <!-- Button to add admin -->
        <a href="add_admin.php" class="btn-primary">Add Admin</a>
        <br/><br/><br/>
            <table class = "tbl-full">
                <tr>
                    <th>S.NO.</th>
                    <th>Full Name</th>
                    <th>UserName</th>
                    <th colspan="2">Actions</th>
                </tr>

                <?php
                //Query to fetch all data;
                $sn = 1;
            $sql = "SELECT * FROM `tbl_admin`";
            $res = $conn->query($sql);
            while($row= $res->fetch_assoc()){
                $id = $row['id'];
                $full_name = $row['full_name'];
                $username = $row['username'];
            
                ?>

                <tr>
                    <td><?php echo $sn++;  ?></td>
                    <td><?php echo $full_name;  ?></td>
                    <td><?php echo $username;  ?></td>
                    <td>
                        <a href="change_pass_admin.php?id=<?php echo $id;  ?>" class="btn-primary">Change Password</a>
                        <a href="update_admin.php?id=<?php echo $id;  ?>" class="btn-secondary">Update Admin</a>
                        <a href="delete_admin.php?id=<?php echo $id;  ?>" class="btn-danger">Delete Admin</a>
                    </td>
                </tr>


                <?php
            }
                ?>
               
            </table>

        <div class="clearfix"></div>

        </div>
    </div>
    <!-- Main Content Section Ends -->

   <?php include('partials/footer.php');  ?>