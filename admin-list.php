<?php
include('../connection.php');
 if(!isset($_SESSION['recid'])){
          header("Location: index.php");
      }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" href="">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<!-- 	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css"> -->
    
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time();?>">
</head>
<body>
   <?php include('header.php'); ?>
      <?php include('sidebar.php'); ?>

  <main class="site-main  bg-lignt-blue h-100 main-admin" >
         <section class="table-container">
            <div class=" ">
               <div class=" equal-padding-B">
                  <div class="table-main  rounded background-white p-4">
                     <div class="table-heading">
                        <h1 class=" mb-4">Admin List</h1>
                     </div>
                     <table id="dr-adminlist" class=" row-border   border-0 text-nowrap " style="width:100%!important;">
                        <thead class="bg-light border-0">
                           <tr>
                              <th>Name </th>
                              <th>Email</th>
                               <th>Status</th>
                              <th>Action</th>
                                            
                           </tr>
                        </thead>
                        <tbody>
                           <?php                         
                              $stmt = $pdo->prepare("SELECT * FROM `tbl_administrator` WHERE status=1");
                              $stmt->execute();
                              $alladmin = $stmt->fetchAll();
                              foreach($alladmin as $admin){ ?>
                           <tr>
                             
                              <td> <?php echo $admin['user_name']; ?></td>
                              <td><?php echo $admin['user_email']; ?></td>
                             
                              <td><?php echo $admin['status'] == 1 ? '<span class="txt-approved" ><i class="far fa-dot-circle   me-2"></i>Approved</span>' : '<span class="txt-pending"><i class="far fa-dot-circle  me-2"></i>Pending</span>'; ?></td>

                               <td><div class="action-btn"> <a href="" class="bg-declined text-white">Archive</a> <a href="" class="bg-pending text-white">Password</a></td>



                              <!--   <td><?php //echo $developer['is_verified'] == 1 ? '<span class="txt-approved" ><i class="far fa-dot-circle   me-2"></i>Approved</span>' : '<span class="txt-pending"><i class="far fa-dot-circle  me-2"></i>Pending</span>'; ?></td> -->
                              <!--                 <td><button class="btn background-one rounded-pill text-white text-nowrap">View More</button></td>
                                 -->               
                           </tr>
                           <?php }?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </section>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script  src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script  src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
	<!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" ></script>
	<script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
	<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script> -->
    <script src="assets/js/validation.js"></script>
</body>
</html>