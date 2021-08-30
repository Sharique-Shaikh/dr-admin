<?php 
   ob_start();
   include('../function.php');
   include('../includes/functions.php');
    if(!isset($_SESSION['recid'])){
          header("Location: index.php");
      }
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title></title>
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
      <main class="site-main  bg-lignt-blue h-100 main-admin"> 

      <section class="table-container">
			<div class=" ">
				<div class=" equal-padding-B">

					<div class="table-main  rounded background-white p-4">
						<div class="table-heading">
							<h1 class=" mb-4">Builders</h1>
						</div>
						
					<table id="inviteList" class=" row-border   border-0 text-nowrap " style="width:100%!important;">
        <thead class="bg-light border-0">
        <tr> 
          
          <th>Developer Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Status</th>
          <th>Is Paid</th>
         </tr>
        </thead>
        <tbody>
        <?php              
          $stmt = $pdo->prepare("SELECT r.*, p.address, p.dev_company_logo FROM `tbl_register` r left join tbl_developerMyprofile p on r.reg_id = p.reg_id where `account_type`= 2 and is_verified=1");
              $stmt->execute();
              $developers = $stmt->fetchAll();
              foreach($developers as $developer){ ?>
            <tr>
				    

                 <td class="text-start"><div class="userthumb"><?php  echo !empty($developer['dev_company_logo']) ? '<img src="'.siteUrl.'/assets/images/uploads/developer/companylogo/'.$developer['dev_company_logo'].'"/></span>' : '' ; ?></div><span><?php echo $developer['name']; ?></span></td>

                <td><?php echo $developer['email']; ?></td>
               <td><?php echo $developer['mobileno']; ?></td>
                <td style="white-space: pre-wrap;"><span><?php echo $developer['address']; ?></span></td> 
                
                <td><?php echo $developer['is_verified'] == 1 ? '<span class="txt-approved" ><i class="far fa-dot-circle   me-2"></i>Approved</span>' : '<span class="txt-pending"><i class="far fa-dot-circle  me-2"></i>Pending</span>'; ?></td>
                
                <td>
                       <?php if($developer['is_payment'] == 0){ ?>
                      <button type="button" data-id="<?php echo $developer['recid']; ?>" class="btn background-one rounded-pill text-white text-nowrap">Mark Paid</button>
                      <?php } ?>
                    </td>
                   
               
            </tr>
            <?php }?>
          
            
            
			</tbody>
			</table>
			


					</div>
				</div>
			</div>
		</section>



        <!--  <div class="entry-content pageProfile divide2" style="margin-left: 0px;">
            <div class="societyprofileTabEvent" style="padding-right:0px">
               <section>
                  <div class="">
                     <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="smallHeading mb-4">
                           <h1>Builders</h1>
                        </div>
                     </div>
                     <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                           <div class="row">
                               <table id="inviteList" class="inviteListWrapper invitesList table table-striped  nowrap">
                                    <thead>
                                       <tr> 
                                          <th></th>
                                          <th>Dev eloper Name</th>
                                          <th>Email</th>
                                          <th>Phone</th>
                                          <th>Address</th>
                                          <th>Status</th>
                                          <th>Is Paid</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                    </?php              
                                      $stmt = $pdo->prepare("SELECT r.*, p.address, p.dev_company_logo FROM `tbl_register` r left join tbl_developerMyprofile p on r.reg_id = p.reg_id where `account_type`= 2 and is_verified=1");
                                      $stmt->execute();
                                      $developers = $stmt->fetchAll();
                                      foreach($developers as $developer){ ?>
                                       <tr> 
                                          <td width="50px"></?php  echo !empty($developer['dev_company_logo']) ? '<span class="userthumb"><img src="../assets/images/uploads/developer/companylogo/'.$developer['dev_company_logo'].'"/></span>' : '' ; ?></td>
                                          <td valign="middle"></?php echo $developer['name']; ?></td>
                                          <td></?php echo $developer['email']; ?></td>
                                          <td></?php echo $developer['mobileno']; ?></td>
                                          <td style="white-space: pre-wrap;"></?php echo $developer['address']; ?></td> 
                                          <td></?php echo $developer['is_verified'] == 1 ? 'Approved' : 'Pending'; ?></td>
                                          <td>
                                             </?php if($developer['is_payment'] == 0){ ?>
                                            <button type="button" data-id="</?php echo $developer['recid']; ?>" class="btn themeBg invitebidbutton">Mark Paid</button>
                                            </?/php } ?>
                                          </td>
                                          <td>
                                             </?php if($developer['is_verified'] == 0){ ?>
                                            <button type="button" data-id="</?php echo $developer['reg_id']; ?>" class="btn themeBg invitebidbutton">Mark Paid</button>
                                            </?php } ?>
                                          </td>
                                       </tr>
                                      </?php }
                                    ?>
                                   </tbody>
                             </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
         </div> -->
      </main>
      <!-- Modal -->
      <div class="modal fade" id="approveNaddlink" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newmeetingPopupLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="newmeetingPopupLabel">New meeting request</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form action="" method="post" name="approve_meeting">
                  <div class="modal-body">
                     <div class="createmeetLinkWrap">
                        <div class="row">
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Title</label>
                                 <input type="text" readonly name="title" class="form-control" readonly placeholder="Title">
                              </div>
                           </div>
                           <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                 <label for="" class="form-label">Zoom Link</label>
                                 <input type="url" name="zoom_link" class="form-control" required autocomplete="off" placeholder="Zoom Link">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer justify-content-center border-top-0">
                     <input type="hidden" name="action" value="approve_meeting">
                     <input type="hidden" name="meetingid" value="">
                     <input type="hidden" name="sid" value="">
                     <button type="submit" class="btn themeBg">Approve & Send Reminder</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <footer></footer>
      <?php 
         include('../assets/includes/footer-links.php'); 
          ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" ></script>
	<script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
	<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

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
	var table = $('#inviteList').DataTable({
		
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