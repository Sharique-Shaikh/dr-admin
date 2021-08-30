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
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    
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
                     <div class="table-heading d-flex justify-content-between align-items-center mb-4">
                        <h1 class=" mb-4">Admin List</h1>
                        <button class="btn background-one rounded-pill text-white text-nowrap" data-bs-toggle="modal" data-bs-target="#createAdmin"> Create Admin</button>
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
                             
                              <td class="text-start"> <?php echo $admin['user_name']; ?></td>
                              <td><?php echo $admin['user_email']; ?></td>
                             
                              <td><?php echo $admin['status'] == 1 ? '<span class="txt-approved" ><i class="far fa-dot-circle   me-2"></i>Approved</span>' : '<span class="txt-pending"><i class="far fa-dot-circle  me-2"></i>Pending</span>'; ?></td>

                               <td><div class="action-btn"> <a href="" class="bg-declined text-white" data-bs-toggle="modal" data-bs-target="#adminAlert"><i class="fas fa-archive me-1"></i> Archive</a> <a href="" class="bg-pending text-white" data-bs-toggle="modal" data-bs-target="#createAdmin"><i class="far fa-eye me-1"></i> View More</a></td>



                              <!--   <td></?php //echo $developer['is_verified'] == 1 ? '<span class="txt-approved" ><i class="far fa-dot-circle   me-2"></i>Approved</span>' : '<span class="txt-pending"><i class="far fa-dot-circle  me-2"></i>Pending</span>'; ?></td> -->
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

         <!-- Modal -->
      <div class="modal fade" id="createAdmin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newmeetingPopupLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="newmeetingPopupLabel">Create Admin</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form action="" method="post" name="approve_meeting">
                  <div class="modal-body">
                     <div class="createmeetLinkWrap">
                        <div class="row gy-3">
                           <div class="col-lg-12 col-md-12 ">
                              <div class="form-group">
                                 <label for="" class="form-label">Name</label>
                                 <input type="text" name="title" class="form-control" required placeholder="Enter your name">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Email</label>
                                 <input type="email" name="zoom_link" class="form-control" required autocomplete="off" placeholder="Enter your email id">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Password</label>
                                 <input type="password" name="zoom_link" class="form-control" required autocomplete="off" placeholder="Enter your password">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Confirm Password</label>
                                 <input type="password" name="zoom_link" class="form-control" required autocomplete="off" placeholder="Enter your confirm password">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Role</label>
                                 <select name="" required class="form-control" id="">
                                    <option value="">Admin</option>
                                    <option value="">Super Admin</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                     <input type="hidden" name="action" value="approve_meeting">
                     <input type="hidden" name="meetingid" value="">
                     <input type="hidden" name="sid" value="">
                     <button type="submit" class="btn background-one px-4 rounded-3 text-white text-nowrap">Approve & Send Reminder</button>
                  </div>
               </form>
            </div>
         </div>
      </div>



      <div class="modal fade" id="adminAlert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newmeetingPopupLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header border-0 pb-0">
                  <!-- <h5 class="modal-title" id="newmeetingPopupLabel">Create Admin</h5> -->
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="p-4 text-center ">
                  <h3>Are you sure you want to archive this records?</h3>
                  <div class="mt-4 "><button class="btn  background-one w-25 rounded-3 text-white text-nowrap mx-2">Yes </button><button class="btn bg-danger rounded-3 text-white text-nowrap mx-2 w-25" data-bs-dismiss="modal"> Cancel</button></div>
               </div>
            </div>
         </div>
      </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script  src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script  src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" ></script>
	<script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
	<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="assets/js/validation.js"></script>
    <script type="text/javascript">
            $(".invitebidbutton").click(function(e){
                e.preventDefault();
                did = $(this).data('id');
                $.ajax({
                  type: "POST",
                  url: "admin_control.php",
                  data: {action:'approvepayment', did:did},
                  success: function () {
                    alert('Payment Approved');
                    location.reload();
                  }
                });
            });



            $(document).ready(function (){
	var table = $('#dr-adminlist').DataTable({
		
		"paging":   true,
        "info":     false,
		"filter": true,
      "pageLength": 25,
	   'columnDefs': [{
		  'targets': 0,
		  'searchable': true,
        'ordering': false,
		  'orderable': false,
		  'className': 'dt-body-center',
		  /* 'render': function (data, type, full, meta){
			  return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
		  } */
	   }],
      "bSort" : false,
	   /* scrollY:        "auto",
        scrollX:        true,
        scrollCollapse: true,
        
        fixedColumns:   {
			leftColumns: 1,
            leftColumns: 2,
            rightColumns: 1
        }, */
	   'order': [[1, 'asc']]
	});
 
 
 });

        </script>
</body>
</html>
