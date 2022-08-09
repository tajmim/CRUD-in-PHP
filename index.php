<!-- establishing connection -->

<?php

  $db = mysqli_connect('localhost','root','','crud');

  if($db){
    //echo "connected";
  }else{
    echo "not connected";
  }

?>

<!-- add user to database -->

<?php
  $add_msg = "";

  if(isset($_POST['add-user'])){

    $name = $_POST['name'];
    $phone = $_POST['c-no'];
    $email = $_POST['email'];
    $pass = $_POST['passsss'];

    $query = "insert into users(Name,cno,eadd,pass) Values('$name','$phone','$email','$pass')";

    $add_query = mysqli_query($db , $query);

    if($add_query){
      $add_msg = "user added successfully";
    }else{
      $add_msg = "user can't add";
    }

  }

?>

<!-- delete user from database -->
<?php 
if (isset($_GET['delete_id'])) {
   
   $d_id = $_GET['delete_id'];

   $query = "DELETE FROM users WHERE user_id='$d_id';";

   $del_query = mysqli_query($db , $query);

   if($del_query){
    echo "deleted";
   }else{
    echo "can't deleted";
   }



 } 

?>







<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
   

        <div class="row p-4">

          <div class="col-6">
            <h1 class="m-5 text-center">Reg form</h1>
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="your Name" name="name">
                </div>


                 <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
                </div>


                 <div class="mb-3">
                  <label for="c-no" class="form-label">Contact No</label>
                  <input type="number" class="form-control" id="c-no" placeholder="" name="c-no">
                </div>



                 <div class="mb-3">
                  <label for="pass" class="form-label">password</label>
                  <input type="password" class="form-control" id="pass" placeholder="" name="passsss">
                </div>


                 <div class="mb-3">
                  <input type="submit" class="btn btn-primary" value="add user" name="add-user">
                  <br>
                  <span><?php echo "$add_msg" ?></span>
                </div>



                 
            </form>
          </div>


          <div class="col-6">
            <h1 class="m-5 text-center">Records</h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php 


                    $read_query = "select * from users";
                    $sirial = 0;
                    $result = mysqli_query($db,$read_query);
                    while($row = mysqli_fetch_assoc($result)){

                      $id = $row['user_id'];
                      $name = $row['Name'];
                      $phone = $row['cno'];
                      $email = $row['eadd'];
                      $pass = $row['pass'];
                      $sirial = $sirial+1;
                   ?>



                  <tr>
                    <th scope="row"><?php echo "$sirial" ?></th>
                    <td><?php echo "$name" ?></td>
                    <td><?php echo "$email" ?></td>
                    <td><?php echo "$phone" ?></td>
                    <td><a class="m-1" href="index.php?delete_id=<?php echo $id ?>">delete</a> <a class="m-1" href="index.php?edit_id=<?php echo $id ?>">edit</a></td>
                  </tr>

                <?php } ?>

                </tbody>
            </table>
          </div>

          <!-- for update / edit -->
          <?php 
          $update_msg = "";
            $e_id = "";
            if (isset($_GET['edit_id'])) {
              $e_id = $_GET['edit_id'];

              $read_query2 = "select * from users where user_id = '$e_id'";
              $result = mysqli_query($db,$read_query2);
              while($row = mysqli_fetch_assoc($result)){

                $id = $row['user_id'];
                $name = $row['Name'];
                $phone = $row['cno'];
                $email = $row['eadd'];
                $pass = $row['pass'];
              }

           ?>

             <div class="col-6">
            <h1 class="m-5 text-center">edit form</h1>
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="your Name" name="name" value="<?php echo $name ?>">
                </div>


                 <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?php echo $email ?>">
                </div>


                 <div class="mb-3">
                  <label for="c-no" class="form-label">Contact No</label>
                  <input type="number" class="form-control" id="c-no" placeholder="" name="c-no" value="<?php echo $phone ?>">
                </div>



                 <div class="mb-3">
                  <input type="submit" class="btn btn-primary" value="update user" name="update-user">
                  <br>
                  <span><?php echo "$update_msg" ?></span>
                </div>



                 
            </form>
          </div>

        <?php 

      } 



  if(isset($_POST['update-user'])){

    $name = $_POST['name'];
    $phone = $_POST['c-no'];
    $email = $_POST['email'];


    $query2 = "UPDATE `users` SET `Name` = '$name', `cno` = '$phone', `eadd` = '$email' WHERE `users`.`user_id` = '$e_id'";



    $edit_query2 = mysqli_query($db , $query2);

    if($edit_query2){
      $update_msg = "user updated successfully";
    }else{
      $update_msg = "user can't be updated";
    }


  }

      ?>




        </div>











    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>