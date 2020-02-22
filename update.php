<?php
session_start();
if (($_SESSION['email'] == '') ){ 
   header("Location: index.php");
}
 include 'conn.php';

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

 $id=$_GET['id'];
 $title = $_POST['title'];
 $description = $_POST['description'];
 $social_link = $_POST['social_link'];

 $q = "update insertnews set title='$title',description='$description', image = '$fileName',social_link='$social_link' where id=$id  ";

 $query = mysqli_query($conn,$q);

 header('location:display.php');
 }

?>

<?php
if(isset($_POST['done'])){

// if in present id (attachment is empty then fill attachment with current filename)
$curr_fileName = $_POST['current_image'];
$eid = $_POST['id'];
$q = "update insertnews set  image = '$curr_fileName' where id='$eid' and image='' ";
$query = mysqli_query($conn,$q);
 header('location:display.php');
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
 <?php
 $id = $_GET['id'];
 $q ="select * from insertnews where id=$id";


 $query = mysqli_query($conn,$q);

 while($res = mysqli_fetch_array($query)){
	 
	 ?>
 <form  method="post" enctype="multipart/form-data">
 
 <br><br><div class="card">
 
 <div class="card-header bg-dark">
 <h1 class="text-white text-center"> Update News and Events </h1>
 </div><br>

 <label> Title</label>
 <input placeholder="Enter Title" type="text" name="title"  value="<?php echo $res['title'] ?>" class="form-control"> <br>

 <label>Description</label>
 <input placeholder="Enter Title" type="text" name="description"  value="<?php echo $res['description'] ?>" class="form-control"> <br>

  <label>Image</label>
  <input type="hidden" name="id" value="<?php echo $res['id'];?>">
  <input type="hidden" name="current_image" value="<?php echo $res['image'];?>">
  <input type="file" name="image" class="form-control" value="<?php echo $res['image'];?>" class="form-control"><br>

  <label> Share Your Social Links Here</label>
 <input placeholder="Ex.(LinkedIn,Facebook,Twitter,GooglePlus)" type="text" name="social_link"  value="<?php echo $res['social_link'] ?>" class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="done"> Submit </button><br>
 <?php } ?>
 </div>
 </form>
 </div>
</body>
</html>



<?php
include 'includes/footer.php';
?>