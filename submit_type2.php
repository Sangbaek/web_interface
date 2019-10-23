<!DOCTYPE html>
<html>
	<head>
		<title>CLAS12 Monte-Carlo Job Submission Portal</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
		<link rel="stylesheet" href="main.css">
	</head>
	<body>
		<!-- Header -->
		<header class="w3-panel w3-opacity w3-container" id="myHeader">
		    
		    <ul id="nav">
		      <li><a href="index.php">Home</a></li>
		      <li><a href="about.html">About</a></li>
		    </ul>

			<div class="w3-center">
				<h1 class="w3-xlarge">CLAS12 Monte-Carlo Job Submission Portal</h1>
				<h2 class="w3-xlarge">  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Logged in as <?php $username= $_SERVER['PHP_AUTH_USER']; echo($username); ?> <br>
			</div>
		</header>

		<div class="w3-center">
			
			<?php
				$project     = 'CLAS12';
				$rungroup    = $_POST['rungroup'];
				$farm        = $_POST['farm'];
				$gcards      = $_POST['gcards'];
				$lundFiles   = $_POST['lundFiles'];
				$username    = $_SERVER['PHP_AUTH_USER'];

				if (!empty($genOptions) ||!empty($project) || !empty($rungroup) || !empty($farm) || !empty($gcards)  || !empty($lundFiles)) {
					$fp = fopen('scard_type2.txt', 'w');
					fwrite($fp, 'project:  '.$project.'      #'.PHP_EOL);
					fwrite($fp, 'group: '.$rungroup.'        #'.PHP_EOL);
					fwrite($fp, 'farm_name: '.$farm.'        #'.PHP_EOL);
					fwrite($fp, 'gcards: '.$gcards.'         #'.PHP_EOL);
					fwrite($fp, 'generator: '.$lundFiles.'   #'.PHP_EOL);
					fclose($fp);
					$command = escapeshellcmd('../SubMit/client/src/SubMit.py -u '.$username.' scard_type2.txt');
					$output = shell_exec($command);
				}
				else {
					echo "All field are required";
					die();
				}
			?>


			<h4>Your job was successfully submitted with the following parameters.</h4>
			<table style="text-align: center;width: 50%;"align="center">
				<tr>
					<td>Project</td>
					<td> <?php echo($project); ?> </td>
				</tr>
				<tr>
					<td>Tag</td>
					<td><?php echo($rungroup); ?></td>
				</tr>
				<tr>
					<td> Farm </td>
					<td> <?php echo($farm); ?> </td>
				</tr>
				<tr>
					<td>Gcards</td>
					<td><?php echo($gcards); ?></td>
				</tr>
				<tr>
					<td>Lund File Location</td>
					<td> <?php echo($lundFiles); ?> </td>
				</tr>
			</table>
			<h4>Output and logs will be at /lustre/expphy/volatile/clas12/osg/<?php echo($username); ?>.</h4>
		</div>
	</body>

	<script src="main.js">
	</script>
</html>
