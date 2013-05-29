<?php
require_once 'tools.php';

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/style/styles.css" media="screen" />
</head>
<body>
<div id="menu">
    <h1>Magento</h1>
    <b>Links</b><br/>
    <a href="/link/db.php" target="workspace">Open DB</a><br/>

	<br/><b>Modules</b><br/>
	<a href="module_new.php" target="workspace">New Module</a><br/>
	<a href="add_model.php" target="workspace">Add Model</a><br/>

    <br/><br/>
	<?php
	linkit('[<<]', '/', '', false);
	?>

</div>
<div id="workarea">
    <iframe id="workspace" src="empty.php"></iframe>
</div>
<div id="workarea2">
    <iframe id="workspace2" src="empty.php"></iframe>
</div>


</body>
</html>