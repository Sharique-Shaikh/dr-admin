<?php
include('../connection.php');
 if(isset($_SESSION['error'])){
         $error = $_SESSION['error'];
         unset($_SESSION['error']);
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


	<main>

		<section class="login-container mt-5  "> 
			<div class="auth-form">
				<div class="logo text-center mb-4"><img src="http://dev.dreamsredeveloped.com/assets/images/logo.svg" alt=""></div>
				<div class="login-main">
				<div class="top-content ">
					<div class="col-sm-7 col-6">
					<h1> Sign In</h1>
					<!-- <p class="mb-0">Welcome back! Please signin <br> to continue.</p> -->
					</div>
				</div>
				<div class="form-content">
					<form method="post" action="admin_control.php" name="dr-login">

						<div class=" mb-3">
							<label  class="form-label">Email address</label>
							<div class="input-group">
						  <input type="text" class="form-control" placeholder="Email address" name="email">
						  <span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						</div>


						<div class="mb-3">
						  <label  class="form-label">Password</label>

						  <div class="input-group position-relative">
						  <input type="password" class="form-control" placeholder="Email password" name="password" id="inputPass">
						  <span id="showPass" class=" position-absolute  bg-white p-1 " style="right:50px; top:3px;"><i class="far fa-eye  text-dark"></i></span><span class="input-group-text"><i class="fas fa-unlock"></i></span>
						</div>


						 
						</div>
						<input type="hidden" name="action" value="adminlogin">
						<button type="submit" class="btn  mt-3 w-100">Login</button>
					  </form>
					        <?php if(isset($error)){ echo $error; };  ?>

				</div>
				</div>
			</div>
		</section>




	</main>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script  src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script  src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
	<!-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" ></script>
	<script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
	<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script> -->
    <script src="assets/js/validation.js"></script>
	<script>
		$('#showPass').click(function(){
			if($('#inputPass').attr('type')==='password'){
				$('#inputPass').attr('type','text');
			}else{
				$('#inputPass').attr('type','password');
			}
		});
	</script>
</body>
</html>
