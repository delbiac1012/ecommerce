<?php
error_reporting(0);
 
include('libs/phpqrcode/qrlib.php'); 


$pricen=$_POST['price'];
$pname=$_POST['product_name'];

function getUsernameFromEmail($email) {
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}

if(isset($_POST['submit']) ) {
	$tempDir = 'temp/'; 
	$email = $_POST['mail'];
	$subject =  $_POST['subject'];
	$filename = getUsernameFromEmail($email);
	$body =  $_POST['msg'];
	$codeContents = 'mailto:'.$email.'?subject='.urlencode($subject).'&body='.urlencode($body); 
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);
}
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
	<link rel="icon" href="img/favicon.ico" type="image/png">
	<link rel="stylesheet" href="libs/css/bootstrap.min.css">
	<link rel="stylesheet" href="libs/style.css">
	<script src="libs/navbarclock.js"></script>
	</head>
	<body>
		<nav class="navbar-inverse" role="navigation">
			
		
		</nav>

		<div class="myoutput">
		
			<div class="input-field">
				<h3>Por favor, preencha os campos abaixo:</h3>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
					<div class="form-group">
						<label>E-mail</label>
						<input type="email" class="form-control" name="mail" style="width:20em;" placeholder="Enter your Email"  required />
					</div>
					<div class="form-group">
						<label>Nome do produto</label>
						<input type="text" class="form-control" value="<?php echo $pname ?>" name="subject" style="width:20em;" placeholder=""  required  />
					</div>
					<div class="form-group">
						<label>Preço</label>
						<input type="text" class="form-control" name="msg" value="<?php echo $pricen ?>" style="width:20em;"  required pattern="[a-zA-Z0-9 .]+" placeholder=""></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Clique aqui para gerar o QR Code" class="btn btn-primary submitBtn" style="width:20em; margin:0;" />

					</div>
				</form>
				<br><br><a style="margin-left: 40%;" href="ecommerce(1)/index.php">Voltar</a>
			</div>
			<?php
			if(!isset($filename)){
				$filename = "author";
			}
			?>
			<div class="qr-field">
				<h2 style="text-align:center">QR Code: </h2>
				<center>
					<div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
							<?php echo '<img src="temp/'. @$filename.'.png" style="width:200px; height:200px;"><br>'; ?>
					</div>
					<a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file=<?php echo $filename; ?>.png ">Download QR Code</a>
				</center>
			</div>
			
		</div>
	</body>

</html>