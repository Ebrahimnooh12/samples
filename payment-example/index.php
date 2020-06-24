<?php 
extract($_GET);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Payment Example</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>
	<script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>

	<link rel="stylesheet" href="style.css">
	<script src="script.js"></script>

	<script>
	
	var charge="";
	charge="<?php if(isset($charge)){echo $charge;}?>"

	if(charge == "p"){
		$(document).ready(function(){
			document.getElementById("loader").style.display = "none";
			$('#alertMs').text("Amount got charged successfully");
			$('#Modal').modal('show');
		})
	}

	if(charge == "f"){
		$(document).ready(function(){
			$('#alertMs').text("Payment got failed..")
			$('#Modal').modal('show')
		})
	}

	</script>
</head>
<body> 
<div id="loader"></div>
	<div id="content" class="container mt-5">
		<h2 class="header">Pay</h2>
		<div class="card p-5">
			<form id="form-container" method="post" action="charge.php">
			<h4 for="paymentcard">Customer Details</h4>
				<div class="form-group">
    				<label for="firstname">First Name</label>
 				    <input name="first" type="text" class="form-control" id="firstname"  placeholder="Enter Your First Name">
				</div>
				<div class="form-group">
    				<label for="lastname">last Name</label>
 				    <input name="last" type="text" class="form-control" id="lastname"  placeholder="Enter Your First Name">
				</div>
				<div class="form-group">
    				<label for="email">Email</label>
					<input name="email" type="email" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter email">
				</div>
				<div class="form-group d-flex">
					<label for="phone" class="mr-2">Tel</label>
					<h4 class="mr2">+</h4>
					<input name="c_code" type="number" style="width:20%;" class="form-control mr-2" id="phone">
					<input name="phone" type="number" style="width:50%;" class="form-control mr-2" id="phone">
				</div>
				<hr>
				<div class="form-group">
					<h4 for="paymentcard">Payment Method Details</h4>
					<!-- Tap element will be here -->
					<div id="element-container"></div>
					<div id="error-handler" class="alert alert-danger" role="alert" style="display: none;"></div>
					<div id="success"style=" display: none;;position: relative;float: left;">
						Success!
					</div>
				</div>  
					<!-- Tap pay button -->
				<div class="d-flex justify-content-end">
					<!-- Clears the form inputs and errors-->
					<button id="clear-btn" class="btn btn-outline-primary mt-5 mr-2" type="reset">clear</button>
					<button id="tap-btn" class="btn btn-primary mt-5">Submit</button>
				</div>	
			</form>	
		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  ...
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		  </div>
		</div>
	  </div>  


	  <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Payment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="alertMs"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
		</div>
</body>


</html>