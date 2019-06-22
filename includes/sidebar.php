<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Mais visualizados hoje</b></h3>
	  	</div>
	  	<div class="box-body">
	  		<ul id="trending">
	  		<?php
	  			$now = date('Y-m-d');
	  			$conn = $pdo->open();

	  			$stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10");
	  			$stmt->execute(['now'=>$now]);
	  			foreach($stmt as $row){
	  				echo "<li><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></li>";
	  			}

	  			$pdo->close();
	  		?>
	    	<ul>
	  	</div>
	</div>
</div>

<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Torne-se um assinante</b></h3>
	  	</div>
	  	<div class="box-body">
	    	<p>Receba as melhores ofertas em seu e-mail.</p>
	    	<form method="POST" action="">
		    	<div class="input-group">
	                <input type="text" class="form-control">
	                <span class="input-group-btn">
	                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-envelope"></i> </button>
	                </span>
	            </div>
		    </form>
	  	</div>
	</div>
</div>

<div class="row">
	<div class='box box-solid'>
	  	<div class='box-header with-border'>
	    	<h3 class='box-title'><b>Siga nos em nossas redes sociais</b></h3>
	  	</div>
	  	<div class='box-body'>
	  		<a style="padding: 30px;
  font-size: 30px;
  
  text-align: center;
  text-decoration: none;" href="https://www.facebook.com/mineirissimasp/" class="fa fa-facebook"></a>


<a style="padding: 30px;
  font-size: 30px;
  
  text-align: center;
  text-decoration: none;" href="#" class="fa fa-twitter"></a>


  <a style="padding: 30px;
  font-size: 30px;
  
  text-align: center;
  text-decoration: none;" href="" class="fa fa-instagram"></a>



	    	
	  	</div>
	</div>
</div>
