<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update'])){

   $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];

   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;


  if(empty($name) || empty($email) || empty($phone) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{

      $update_data = "UPDATE `student` SET `name`='$name', `email`='$email',`phone`='$phone',`image`='$product_image'   WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:index.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM student WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update Student</h3>
      <input type="text" class="box" name="name" value="<?php echo $row['name']; ?>" placeholder="enter name">
      <input type="text" class="box"  name="email" value="<?php echo $row['email']; ?>" placeholder="Student email">
      <input type="text"  name="phone" class="box" value="<?php echo $row['phone']; ?>" placeholder="phone no.">
      
      <input type="file" class="box" name="product_image"  accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="update" name="update" class="btn">
      <a href="index.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>