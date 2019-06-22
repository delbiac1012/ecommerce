<?php
	include 'includes/session.php';
	$conn = $pdo->open();

	$output = '';
date_default_timezone_set('America/Sao_Paulo');
$dd = date('d/m/Y H:i');




	if(isset($_SESSION['user'])){
		

		
			$total = 0;
			$stmt = $conn->prepare("SELECT *, cart.id AS cartid FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user");
			$stmt->execute(['user'=>$user['id']]);
			foreach($stmt as $row){
				
				$subtotal = $row['price_new']*$row['quantity'];
				$total += $subtotal;
				$output1 .= "
					<tr>
						
						<td style='padding:10px; border:1px'>".$row['name']."</td>
						<td style='padding:10px; border:1px'>R$ ".number_format($row['price_new'], 2)."</td>
						
						<td style='padding:10px; border:1px'>
            				<input type='text' class='form-control' value='".$row['quantity']."' id='qty_".$row['cartid']."'>
				         
						</td>
						<td style='padding:10px; border:1px'>R$ ".number_format($subtotal, 2)."</td>
					</tr>
				";
			}
			$output2 .= "
				<tr>
					<td style='padding:10px; border:1px' colspan='3' align='right'><b>Total</b></td>
					<td style='padding:10px; border:1px'><b>R$ ".number_format($total, 2)."</b></td>
				</tr>
			";

		
		

	}
	else{
		if(count($_SESSION['cart']) != 0){
			$total = 0;
			foreach($_SESSION['cart'] as $row){
				$stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.id=:id");
				$stmt->execute(['id'=>$row['productid']]);
				$product = $stmt->fetch();
				$image = (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg';
				$subtotal = $product['price_new']*$row['quantity'];
				$total += $subtotal;
				$output3 .= "
					<tr>
						
						<td style='padding:10px; border:1px'>".$product['name']."</td>
						<td style='padding:10px; border:1px'>R$ ".number_format($product['price_new'], 2)."</td>
						
						<td style='padding:10px; border:1px'>R$ ".number_format($subtotal, 2)."</td>
					</tr>
				";
				
			}

			$output4 .= "
				<tr>
					<td style='padding:10px; border:1px' colspan='5' align='right'><b>Total</b></td>
					<td style='padding:10px; border:1px'><b>R$ ".number_format($total, 2)."</b></td>
				</tr>
			";
		}

		else{
			$output5 .= "
				<tr>
					<td style='padding:10px; border:1px' colspan='6' align='center'>Shopping cart empty</td>
				</tr>
			";
		}
		
	}

	$pdo->close();
	
$servername = "localhost";
$username = "root";
$password = "";
$database = "ecomm";
 
$connn = new mysqli($servername, $username, $password, $database);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$asd = $_SESSION['user'];

$abc  = "SELECT * FROM users WHERE id = '$asd'";
$bcb = mysqli_query($connn , $abc);
$rok =  mysqli_fetch_assoc($bcb);

$naa1 = $rok['firstname'];
$naa2 = $rok['lastname'];
$naa3 = $rok['email'];


		require_once'admin/pdf/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$mpdf->AddPage('P');
$mpdf->setFooter('{PAGENO}/{nbpg}');

	   
	    $mpdf->SetFont('helvetica', '', 11);   
	    $content1 = '

<h2 style="display:inline;" align="center">Lista de Supermercado </h2>
<h4 style="display:inline;" align="left">Data do Pedido: '.$dd.'</h4>
<h4 style="display:inline;" align="left">Cliente: '.$naa1.' '.$naa2.'</h4>
<h4 style="display:inline;" align="left">E-mail: '.$naa3.'</h4>
<br>
<br>

	    <table>
		        			
		        				<tr>
		        				
		        				<th>Produto - Descrição</th>
		        			<th>Preço</th>
		        				<th >Quantidade</th>
		        				<th>Subtotal</th></tr>
		        			' ;
		        			
		        $content2		='</table>';  
	    
	  
	    $mpdf->WriteHTML($content1.$output1.$output2.$output3.$output4.$output5.$content2); 
	    $mpdf->Output();

?>

