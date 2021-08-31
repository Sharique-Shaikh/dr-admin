<?php
include('connection.php');
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
                        <button class="btn background-one rounded-pill text-white text-nowrap" id="create_admin_btn" data-bs-toggle="modal" data-bs-target="#createadminpopup"> Create Admin</button>
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

                               <td><div class="action-btn"> <a href="" class="bg-declined text-white">Archive</a> 


                               <a href="" recid="<?php echo $admin['recid'];?>" class="bg-pending text-white update" data-bs-toggle="modal" data-bs-target="#updateadminpopup">View More</a></td>



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
      <div class="modal fade" id="createadminpopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newmeetingPopupLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="newmeetingPopupLabel">Create Admin</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form method="post" id="createadmin" name="createadmin">
                  <div class="modal-body">
                     <div class="createmeetLinkWrap">
                        <div class="row gy-3">
                           <div class="col-lg-12 col-md-12 ">
                              <div class="form-group">
                                 <label for="" class="form-label">Name</label>
                                 <input type="text" name="name" id="name" class="form-control" required placeholder="Enter your name" >
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Email</label>
                                 <input type="email" name="email" id="email" class="form-control" required autocomplete="off" placeholder="Enter your email id">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Password</label>
                                 <input type="password" name="password" id="password" class="form-control" required autocomplete="off" placeholder="Enter your password">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Confirm Password</label>
                                 <input type="password" name="con_password" id="con_password" class="form-control" required autocomplete="off" placeholder="Enter your confirm password">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Role</label>
                                 <select name="role" required class="form-control" id="role">
                                    <option value="2">Super Admin</option>
                                    <option value="3" checked>Admin</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                     <button type="submit" class="btn background-one px-4 rounded-3 text-white text-nowrap" id="submit">Approve & Send Reminder</button>
                     <div id="error_sms_created"></div>
                  </div>
               </form>
            </div>
         </div>
      </div>


         <!-- Modal Update-->
      <div class="modal fade" id="updateadminpopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateadminLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="updateadminLabel">Update Admin</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form method="post" id="updateadmin" name="updateadmin">
                  <div class="modal-body">
                     <div class="createmeetLinkWrap">
                        <div class="row gy-3">
                           <div class="col-lg-12 col-md-12 ">
                              <div class="form-group">
                                 <label for="" class="form-label">Name</label>
                                 <input type="text" name="update_name" id="update_name" class="form-control" required placeholder="Enter your name">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Email</label>
                                 <input type="email" name="update_email" id="update_email" class="form-control" required autocomplete="off" placeholder="Enter your email id">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Password</label>
                                 <input type="password" name="update_password" id="update_password" class="form-control" required autocomplete="off" placeholder="Enter your password">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Confirm Password</label>
                                 <input type="password" name="update_con_password" id="update_con_password" class="form-control" required autocomplete="off" placeholder="Enter your confirm password">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Role</label>
                                 <select name="update_role" id="update_role" required class="form-control" >
                                    <option value="2">Super Admin</option>
                                    <option value="3" checked>Admin</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                     <input type="hidden" id="recid" name="recid">
                     <button type="submit" class="btn background-one px-4 rounded-3 text-white text-nowrap" id="update_btn">Update</button>
                     <div id="error_sms_update"></div>
                  </div>
               </form>
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
        "info":   false,
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


$(".update").on("click",function()
{
    var recid = $(this).attr('recid');
    $.ajax({
      type: "POST",
      url: "admin_control.php",
      data: {
              recid : recid,
              action : 'fetchAdmin'
            }, 
      success: function (data) 
          {
              arr = $.parseJSON(data); 
              $("#recid").val(arr.recid);
              $("#update_name").val(arr.user_name);
              $("#update_email").val(arr.user_email);
              $("#update_role").val(arr.role);
          }
    });
});


jQuery.validator.addMethod("lettersonly", function(value, element) 
{
  return this.optional(element) || /^[a-zA-Z- ]+$/i.test(value);
}, "Letters only please."); 


$("#updateadmin").validate({
  ignore: ":hidden",
  rules: {
          update_name: {
            required:true,
            lettersonly: true
          },
          update_email: {
            required: true,
            email: true
          },
          update_password : {
            required: false
          },
          update_con_password : {
            required: false,
            equalTo : "#update_password"
          }
        },
  submitHandler: function (form) {
             $.ajax({
                type: "POST",
                url: "admin_control.php",
                data: $('#updateadmin').serialize() + "&action=updateadmin",
                success: function (data) 
                {
                  //alert(data);
                  $("#error_sms_update").html(data);
                  //location.reload();
                }
              });
              return false; // required to block normal submit since you used ajax
         }
});

$("#createadmin").validate({
  ignore: ":hidden",
  rules: {
          name: {
            required:true,
            lettersonly: true
          },
          email: {
            required: true,
            email: true
          },
          password : {
            required: true,
          },
          con_password : {
            required: true,
            equalTo : "#password"
          }
        },
  submitHandler: function (form) {
             $.ajax({
              type: "POST",
              url: "admin_control.php",
              data: $('#createadmin').serialize() + "&action=createadmin",
              success: function (data) 
              {
                //alert(data);
                $("#error_sms_update").html(data);
                //location.reload();
              }
            });
             return false; // required to block normal submit since you used ajax
         }
});

 });
</script>
</body>
</html>
