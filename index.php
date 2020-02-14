<html>
    <head>
        <title>PHP Crud by Kim</title>
        <script scr = "scrips/jquery-2.1.3.min.js"></script>
        <link rel = "stylesheet" href ="styles/bootstrap.min.css">
        <meta name ="view-port" content="width = device-width, initial scale = 1">
        <script src = ""></script>
    </head>
    
    <body>
        <?php require_once 'process.php'?>
        
        <!--Checking session messages on completion of action-->
        
        <?php
            if (isset($_SESSION['message'])):
        ?>
        <div class = "alert-<?=$_SESSION['msg_type']?>">
             <?php
                    //Print out the message from the action
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
             ?>
        </div>
        <?php endif;?>
        <div class="container"> 
        <?php
            $mysqli = new mysqli("localhost", "user", "user", "PHP_crud") or die(mysqli_error($mysqli));
            
            $result = $mysqli -> query("SELECT * from Data") or die($mysqli->error);
            
            //print out what is in the database
            //pre_r($result);
            ?>
            
            <!--Create the html table to display the data we want-->
            <div class = "row justify-content-center">
                <table class = "table">
                    <thead><!--table head for the columns-->
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th colspan ="2">Action</th>
                        </tr>
                    </thead>
                    
                   <!--Now use php to get data and load it into the table-->
                   <?php
                        while ($row = $result -> fetch_assoc()):
                   ?>
                   <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <!--Edit and delete record. First, Edit-->
                            <a href = "index.php?edit=<?php echo $row['ID'];?>"
                                class="btn btn-info">Edit</a>
                            
                            <a href = "index.php?delete=<?php echo $row['ID'];?>"
                                class="btn btn-danger">Delete</a>
                        </td>
                   </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            
        <!--the form that is going to be taking all the data-->
        <div class = "row justify-content-center">
            <form action = "process.php" method = "post">
            <!--Create a hidden input field for saving the ID we need to edit details-->
            <input type = "hidden" name="id" value = <?php echo $id;?>>
            
                <div class = "form-group">
                    <label>Name</label>
                    <input type = "text" class="form-control"
                        name = "name" value = "<?php echo $name ?>" placeholder = "Enter Your Name">
                </div>
                <div class = "form-group">
                    <label>Location</label>
                    <input type = "text" class="form-control" 
                        name = "location" value ="<?php echo $location ?>" placeholder = "Enter your location">
                </div>
                <div class = "form-group">
                  <?php if ($update == true):?>
                      <button type = "submit" class = "btn btn-info" name = "update">Update</button>
                  <?php else: ?>
                    <button type = "submit" class = "btn btn-primary" name = "save">Save</button>
                  <?php endif?>
                </div>
            </form>
        </div>
        
        </div>
    </body>
</html>
