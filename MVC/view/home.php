<?php
	class HomeView {

	}

	$acc = $_SESSION['account'];
	$acc = unserialize($acc);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Stock Market</title>
	<link rel="stylesheet" type="text/css" href="<?php echo 'http://'.DOMAIN.'public/style/'.'Demo.css'?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo 'http://'.DOMAIN.'public/js/'.'Demo.js'?>"></script>
	<style>
		#centerbar{	
			background-image: url(<?php echo 'http://'.DOMAIN.'public/img/BG1.png'?>);
		}
		#rightbar {
			background-image: url(<?php echo 'http://'.DOMAIN.'public/img/BG1.png'?>);
		}
	</style>
</head>
<body>	
	<div id="board">
		<div id="topbar">
			<div id="money" onclick="deposite()"><?php echo floatval($acc->GetAmount()).'$' ?></div>
			<div id="moneyalert"><input type="text" name="money" id="inputmoney"><button id="depositebut" onclick="depositeclick()">Deposite</button></div>
			<img src="<?php echo 'http://'.DOMAIN.'public/img/'.'dollar.png'?>" id="avatar">
			<img src="<?php echo 'http://'.DOMAIN.'public/img/'.'logo.png'?>" id="logo">
			<img src="<?php echo 'http://'.DOMAIN.'public/img/'.'fb.png'?>" id="company">			
		</div>							

		<div id="rightbar">
			<form>
				<div class="choose" id="moneyIn">Amount<input type="text" name="amt" id="amt" onclick="AmountColorChangeWhenClick()"></div>
				<div class="choose">Lever
					<select id="lever">
						<option selected="selected">x1</option>
						<option>x5</option>
						<option>x10</option>
						<option>x20</option>
					</select>
				</div>
				<div class="centerText" id="closebutt">Close</div>				
				<div class="button" id="myBuy">CALL</div>
				<div class="button" id="mySell">PUT</div>

			</form>
		</div>

		<div id="leftbar">
			<div id="hist">HISTORY</div>
		</div>			

		<div id="centerbar">

			<canvas id="myCanvas"></canvas>			
						
		</div>
	
		<div id="bottombar">

		</div>

	</div>
	<script type="text/javascript" src="<?php echo 'http://'.DOMAIN.'public/js/'.'chart.js'?>"></script>
</body>
</html>