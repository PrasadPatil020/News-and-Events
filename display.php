<?php
include 'conn.php';
?>

<!DOCTYPE html>
<html>
<head>
 <title></title>

 <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

 <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
   <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

</head>
<?php 
include 'includes/header.php';
include 'includes/navbar.php';

?>
<body>

 <div class="ex1" class="container">
 <div class="col-lg-12">

 <h4 class="text-warning text-center" >Your News and Events</h4>
 <br>
 <table  id="tabledata" class=" table table-striped table-hover table-bordered">
 
 <tr class="bg-dark text-white text-center">
 
 <th>Title</th>
 <th>Description</th>
 <th>Image</th>
 <th>Social Link</th>
 <th>Delete</th>
 <th>Update</th>

 </tr >

 <?php
 include 'conn.php'; 
 $q = "select * from insertnews order by id desc";
  date_default_timezone_set('Asia/Calcutta'); 

 
 $query = mysqli_query($conn,$q);

 while($res = mysqli_fetch_array($query)){
     
    
 ?>
 <tr class="text-center">
 <td> <?php echo $res['title'];  ?> </td>
 <td><?php echo $res['description']; ?></td>
  <td><?php echo $res['image'];?></td>
  <td><?php echo $res['social_link']; ?></td>
 
 <td><button class="btn-danger btn"><a href="delete.php?id=<?php echo $res['id']; ?>" class="text-white"> Delete </a>  </button> </td>
 <td><button class="btn-primary btn"><a href="update.php?id=<?php echo $res['id']; ?>" class="text-white"> Update </a> </button> </td>

 </tr> 
<?php }?>
 </table>  

 </div>
 </div>

 <script type="text/javascript">
 
 $(document).ready(function(){$('#tabledata').DataTable();})
 
 </script>

</body>
</html>