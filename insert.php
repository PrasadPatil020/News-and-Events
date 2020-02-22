<?php
session_start();
include 'conn.php';

if (($_SESSION['email'] != 'admin@admin.com') )
{
 header("Location:index.php");
}
 
 // date_default_timezone_set('Asia/Calcutta'); 

if(isset($_POST['done'])){
  $fileName = $_FILES['image']['name'];
  $tempName = $_FILES['image']['tmp_name'];
    
  if(isset($fileName))
     {
       if(!empty($fileName))
       {
             $location = "img/";
             if(move_uploaded_file($tempName, $location.$fileName))
             {
                  header("Location:display.php");
				
           }
        }
  }
 
   $title   = $_POST['title']; 
   $description = $_POST['description'];
   $social_link = $_POST['social_link'];
  
 $q = "INSERT INTO insertnews"."(title,description,image,social_link)"."VALUES"."( '$title','$description','$fileName','$social_link')";
 

//  $query = mysqli_query($con,$q);
//  if($query)
//  {
//   header("location:display.php");
//  // redirect("display.php");
//  }
//  else 
//  {
//      echo "Data Not Inserted!!!";
//  }

// }
 $result=$conn->query($q);

  if ($result==true) 
  {
    # code...
    $message = "Data Inserted Successfully...!";
echo "<script type='text/javascript'>alert('$message');</script>";
  }
  else
  {
    echo "Error".$q."<br>".$conn->error;
  }
  $conn->close();
  }
?>

<!DOCTYPE html>
<html>
<head>
 <title></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<?php 
include 'includes/header.php';
include 'includes/navbar.php';

?>
<body>

 <div class="col-lg-6 m-auto">
 
 <form method="post" enctype="multipart/form-data">
 
 <br><br><div class="card">
 
 <div class="card-header bg-dark">
 <h4 class="text-white text-center">News and Events</h4>
 </div><br>
 
   <label>Title</label>
 <input required placeholder="Enter Title" type="text" name="title"  class="form-control"> <br>
 
 <label>Description</label>
 <input required placeholder="Enter Description" type="text" name="description"  class="form-control"> <br>

  <label>Image</label>
  <input type="file" name="image" required class="form-control"><br>

  <label>Share Your Social Links Here</label>
 <input required placeholder="Ex.(LinkedIn,Facebook,Twitter,GooglePlus)" type="text" name="social_link"  class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="done"> Submit </button><br>

 </div>
 </form>
 </div>
</body>
</html>
<?php
include 'includes/footer.php';
?>