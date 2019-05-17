<?php 
	class SignUpView {

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
	<link rel="stylesheet" type="text/css" href="<?php echo 'http://'.DOMAIN.'public/style/signup.css'?>">	

	<style> 
		body {
			background-image: url(<?php echo '"http://'.DOMAIN.'public/img/BG1.png"';?>);
		}
	</style>
</head>
<body>
	<div id="avatar"></div>
	<div id="form">
		<form action="<?php echo 'http://'.DOMAIN.'signup/';?>" method="post">
			<table>
				<tr>
					<td>Full Name</td>
					<td><input type="text" name="fullname" id="fullname" oninput="validate(fullname,/^([A-Z]\w+(\ )*)+$/,show1)"></td>					
				</tr>
				<tr class="check">
					<td><span id="show1"></span></td>
				</tr>
				<tr>
					<td>User Name</td>
					<td><input type="text" name="username" id="username" oninput="validate(username,/^[a-zA-Z][a-z0-9]{5,}$/,show2)"></td>
				</tr>
				<tr class="check">
					<td><span id="show2"></span></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password" id="password" oninput="validate(password,/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})/,show3)"></td>
				</tr>
				<tr class="check">
					<td><span id="show3"></span></td>
				</tr>
				<tr>
					<td>Confirm Password</td>
					<td><input type="password" name="confirm" id="confirm" oninput="checkpass(password,confirm,show4)"></td>
				</tr>
				<tr class="check">
					<td><span id="show4"></span></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><input type="text" name="email" id="email" oninput="validate(email,/^[a-z][a-z0-9_\.\-]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/,show5)"></td>
				</tr>
				<tr class="check">
					<td><span id="show5"></span></td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td><input type="text" name="phone" id="phone" oninput="validate(phone,/^[0][1-9][0-9]{8,}$/,show6)"></td>
				</tr>
				<tr class="check">
					<td><span id="show6"></span></td>
				</tr>
				<!-- <tr>
					<td>Country</td>
					<td><input type="text" name="Nation" id="Nation" oninput="validate(Nation,/[a-zA-Z]{2,}/,show7)"></td>
				</tr>
				<tr class="check">
					<td><span id="show7"></span></td>
				</tr> -->
				<tr>
					<td>Birthday</td>
					<td><input type="date" name="birthday" id="birthday" oninput="test(show7)"></td>
					<!--validate(birthday,/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/,show7)-->
				</tr>
				<tr class="check">
					<td><span id="show7"></span></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="address" id="address" oninput="validate(address,/^\d+\s[A-z]+\s[A-z]+/,show8)"></td>
				</tr>
				<tr class="check">
					<td><span id="show8"></span></td>
				</tr>
				
			</table>
			<input type="submit" name="submit" id="submitButt">				
		</form>
	</div>

	<script type="text/javascript" src="<?php echo 'http://'.DOMAIN.'public/js/account.js'; ?>"></script>
	<script type="text/javascript">
		var timeFlow = setInterval(function(){
	        var count = 0;
	        var check = true;
	        for(var i = 1;i<=8;i++){
	            if(document.getElementById("show"+i).innerHTML!="OK"){
	                check = false;
	            }
	        }
	        // if(count==8){
	        //     check = true;
	        // }
	        if(check==true){
	            submitButt.style.visibility = "visible";
	        }
	        else{
	            submitButt.style.visibility = "hidden";
	        }
    	},1000);
	</script>
</body>
</html>