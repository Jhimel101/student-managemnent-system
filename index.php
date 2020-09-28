<?php 

	require_once "app/autoload.php"


 ?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>


	<?php 

		if ( isset($_POST['padd'])) {

			//Value get

			     $pname = $_POST['pname'];
				 $pprice = $_POST['pprice'];
				 $pquan = $_POST['pquan'];

				 $total = NULL;

				 if (!empty($pprice) && !empty($pquan)) {
				 	$total = $pprice * $pquan;
				 }
				 




			
		}


			// Form validation
				if (empty($pname) || empty($pprice) || empty($pquan) || empty($total)) {
					$mess = '<p class=\'alert alert-danger\'>All fields are required ! <button class=\'close\' data-dismiss=\'alert\'>&times;</button></p>';
				
			}
			else{

				//Product Photo Upload

				 $file =fileUpload($_FILES['pphoto'], 'products/');
				 $photo_name = $file['file_name'];

			//Product upload
				 $sql ="INSERT INTO products (photo, product_name, product_price, quantity, total) VALUES ('$photo_name','$pname','$pprice','$pquan','$total')";
				 $connection -> query($sql);
				 $mess = '<p class=\'alert alert-success\'>Product added done ! <button class=\'close\' data-dismiss=\'alert\'>&times;</button></p>';
			}






	 ?>
	
	

	<div class="wrap-table ">
		<div class="card w-50 mx-auto">
			<div class="card-body">
				<h3>Add Product</h3>

				<?php

				if(isset($mess)){
					echo $mess;
				}



				?>


				
				<form action="" method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<input name="pname" class="form-control"type="text" placeholder="Product Name">
					</div>

					<div class="form-group">
						<input name="pprice" class="form-control"type="text" placeholder="Product Price">
					</div>

					<div class="form-group">
						<input name="pquan" class="form-control"type="text" placeholder="Product Quantity" name="">
					</div>
					<div class="form-group">
						<input name="pphoto" class="form-control"type="File" >
					</div>
					<div class="form-group">
						<input name="padd" class="btn btn-primary btn-block" type="Submit" value="Add Product">s
					</div>


				</form>

			</div>

		</div>
		<div class="card shadow-sm">
			<div class="card-body">
				<h2>Products Management </h2>
				<table class="table table-striped ">
					<thead>
						<tr>
							<th>#</th>
							<th>Photo</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>

					<?php

					//Product show

					$sql ="SELECT  * FROM products ORDER BY id DESC";
				    $products = $connection -> query($sql);

				    $i =1;

				    while ( $pro = $products -> fetch_assoc()) :

					?>



						<tr>
							<td><?php echo $i;$i++; ?></td>
							<td><img src="products/<?php echo $pro ['photo']; ?>" alt=""></td>
							<td><?php echo $pro ['product_name']; ?></td>
							<td><?php echo $pro ['product_price']; ?></td>
							<td><?php echo $pro ['quantity']; ?></td>
							<td><?php echo $pro ['total']; ?></td>
							<td style="width:70px;">
								
								<a class="btn btn-sm btn-danger" href="#">Delete</a>
							</td>
						</tr>

						<?php endwhile; ?>



						<tr id ="amo">
							<td class="text-right" colspan="5">Total=</td>
							<td class="text-left">12000</td>
						</tr>
						
						

					</tbody>
				</table>
			</div>
		</div>
	</div>

	
	<br>
	<br>
	<br>
	<br>
	<br>
    <br>






	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>