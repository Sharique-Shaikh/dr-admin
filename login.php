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


	<main>

		<section class="login-container mt-5  "> 
			<div class="col-lg-4 col-md-6 col-11 mx-auto  ">
				<div class="login-main">
				<div class="top-content ">
					<div class="col-sm-7 col-6">
					<h1> Sign In</h1>
					<!-- <p class="mb-0">Welcome back! Please signin <br> to continue.</p> -->
					</div>
				</div>
				<div class="form-content">
					<form method="post" action="admin_control.php">
						<div class="mb-3">
						  <label for="exampleInputEmail1" class="form-label">Email address</label>
						  <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" required="">
						 
						</div>
						<div class="mb-3">
						  <label for="exampleInputPassword1" class="form-label">Password</label>
						  <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Enter password" required="">
						</div>
						<input type="hidden" name="action" value="adminlogin">
						<button type="submit" class="btn  mt-3 w-100">Login</button>
					  </form>
				</div>
				</div>
			</div>
		</section>




	</main>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" ></script>
	<script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
	<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    
    <script src="assets/js/main.js"></script>
</body>
</html>