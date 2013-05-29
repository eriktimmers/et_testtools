<?php

	function linkit($label, $url, $target = '_blank', $addHttp = true) {
		echo '<a href="' . ($addHttp ? 'http://' : '') . $url . '" target="' . $target . '">' . $label . '</a><br/>';
	}

?>