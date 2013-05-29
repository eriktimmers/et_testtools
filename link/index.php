<?php
	require_once 'tools.php';

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/style/styles.css" media="screen" />
	</head>
	<body>
		<b>RDC - Readshop</b><br/>
		<?php
			linkit('Readshop [dev]', 'readshopnew.eriktimmers.kega.nl');
			linkit('Readshop [staging] (readshop:r3@dshoppe)', 'staging.readshop.nl');
			linkit('Readshop [live]', 'www.readshop.nl');
		
		?>
		<br/>
		<b>RDC - Plantage</b><br/>
		<?php
			linkit('Plantage [dev]', 'plantage.eriktimmers.kega.nl');
			linkit('Plantage [staging] (plantage:pl@nt@g3)', 'plantage.itnova.nl');
			linkit('Plantage [live]', 'www.plantage.nl');
			linkit('Plantage Overtoom [live]', 'www.plantageovertoom.nl');
		?>

		<br/>
		<b>RDC - Boekentijd</b><br/>
		<?php
			linkit('Boekentijd [dev]', 'boekentijd.eriktimmers.kega.nl');
			linkit('Boekentijd [staging] (boekentijd:deh00gstetijd)', 'boekentijd-prelive.rdcgroup.nl');
			linkit('Boekentijd [live]', 'www.boekentijd.nl');
			linkit('Boekentijd Cazemier [live]', 'www.boekhandelcazemier.nl');
		?>
		<br/>
		<b>RDC - Catalogus</b><br/>
		<?php
			linkit('CB Catalogus [dev]', 'catalogus-cb.eriktimmers.kega.nl/sitemanager/');
			linkit('CB Catalogus [staging]', 'cb-catalogus-prelive.rdcgroup.nl/sitemanager/');
			linkit('CB Catalogus [live]', 'cb-catalogus.rdcgroup.nl/sitemanager/');
			linkit('Libridis Catalogus [live]', 'catalogus.rdcgroep.nl/sitemanager/');
		?>		
		
		<br/><br/>
		<?php 
			linkit('DB>', '/link/db.php', '_self', false);
		?>
		
	</body>
</html>

