<?php 
	session_start();
	if(!isset($_SESSION['admin'])){
		header('Location: login.php');
		exit();
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


	<main>   



		<section class="dashboard-container">
			<div class="container-fluid">
				<div class="equal-padding-T equal-padding-B">
					<div class="dashboard-header d-flex justify-content-between align-items-center mb-4 ">
						<h1 class="fs-3">Dashboard</h1>
						<div class="fs-5 "><span >Minible</span> / <span class="color-dash-gray">Dashboard</span></div>
					</div>
					<div class="dashboard-row row gy-3">
						<div class="col-lg-3 col-md-6 ">
							<div class="dashboard-items background-white rounded-3 shadow-sm p-4 d-grid ">
								<div class="items-top d-flex justify-content-between ">
									<div>
										<h2 class="mb-2">$34,153</h2>
										<span class="color-dash-gray ">Total Revenged</span>
									</div>
									<div class="details-icons"></div>
								</div>
								<p class="color-dash-gray"><span class="color-dash-green">&#8679; 2.65%</span> since last week</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="dashboard-items background-white rounded-3 shadow-sm p-4">
								<div class="items-top d-flex justify-content-between  ">
									<div>
										<h2 class="mb-2">5,643</h2>
										<span class="color-dash-gray">Orders</span>
									</div>
									<div class="details-icons"></div>
								</div>
								<p class="color-dash-gray"><span class="color-dash-red">&#8681; 0.82% </span> since last week</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="dashboard-items background-white rounded-3 shadow-sm p-4">
								<div class="items-top d-flex justify-content-between ">
									<div>
										<h2 class="mb-2">45,254</h2>
										<span class="color-dash-gray"> Customers </span>
									</div>
									<div class="details-icons"></div>
								</div>
								<p class="color-dash-gray"><span class="color-dash-red"> &#8681; 6.24% </span>since last week</p>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="dashboard-items background-white rounded-3 shadow-sm p-4">
								<div class="items-top d-flex justify-content-between  ">
									<div>
										<h2 class="mb-2">+12.58%</h2>
										<span class="color-dash-gray">Growth</span>
									</div>
									<div class="details-icons"></div>
								</div>
								<p class="color-dash-gray"><span  class="color-dash-green">&#8679; 10.51% </span>since last week</p>
							</div>
						</div>
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