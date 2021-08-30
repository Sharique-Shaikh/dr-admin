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
      <main class="site-main  bg-lignt-blue h-100 main-admin" >
         <section class="table-container">
            <div class=" ">
               <div class=" equal-padding-B">
                  <div class="table-main  rounded background-white p-4">
                     <div class="table-heading">
                        <h1 class=" mb-4">Society List</h1>
                     </div>
                     <table id="societylist" class=" row-border   border-0 text-nowrap " style="width:100%!important;">
                        <thead class="bg-light border-0">
                           <tr>
                              <th>Society Name </th>
                              <th>Name</th>
                              <th>Phone</th>
                              <th>Address </th>
                              <th>Members </th>
                              <th>Status</th>
                              <!--             <th>Action</th>
                                 -->            
                           </tr>
                        </thead>
                        <tbody>
                           <?php                         
                              $stmt = $pdo->prepare("SELECT r.*, p.location, p.societyLogo, p.societyName, (select count(recid) from tbl_society_invites where society_id = r.reg_id ) as members FROM `tbl_register` r left join tbl_societyprofile p on r.reg_id = p.reg_id where `account_type`= 1 and roleType=1");
                              $stmt->execute();
                              $societies = $stmt->fetchAll();
                              foreach($societies as $society){ ?>
                           <tr>
                              <td class="text-start">
                                 <div class="userthumb"><img  src="<?php echo siteUrl?>assets/images/uploads/societyprofile/<?php echo $society['societyLogo'];?>"/></div>
                                 <?php echo $society['societyName']; ?></span>
                              </td>
                              <td> <?php echo $society['name']; ?></td>
                              <td><?php echo $society['mobileno']; ?></td>
                              <td style="white-space: pre-wrap;"><?php echo $society['location']; ?></td>
                              <td style="white-space: pre-wrap;"><?php echo $society['members']; ?></td>
                              <td><?php echo $society['is_active'] == 1 ? '<span class="txt-approved" ><i class="far fa-dot-circle   me-2"></i>Approved</span>' : '<span class="txt-pending"><i class="far fa-dot-circle  me-2"></i>Pending</span>'; ?></td>
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
        
      </main>
     
      <footer></footer>
   
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
      <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" ></script>
      <script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
      <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
      <script type="text/javascript">
       
         
         $(document).ready(function (){
         var table = $('#societylist').DataTable({
         
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

