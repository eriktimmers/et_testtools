<?php

	//$importdir = '/home/developer/www/testtools/score/CustomerProfile/';
	//$exportName = "Export Daily Active Customers Profile";
	//$importdir = '/home/developer/www/testtools/score/CustomerTransactions/';
	//$exportName = "Export Daily Customer Transactions";
	$exportdir = '/home/developer/www/testtools/score/';

	$imprt[] = array('dir' => '/home/developer/www/testtools/score/CustomerProfile/',
					 'name' => "Export Daily Active Customers Profile");
	$imprt[] = array('dir' => '/home/developer/www/testtools/score/CustomerTransactions/',
					 'name' => "Export Daily Customer Transactions");


	foreach($imprt as $value) {

		$importdir = $value['dir'];
		$exportName = $value['name'];

		$j = 0;
		$min = 999;
		$max = 0;

		if (($expFile = fopen($exportdir . $exportName . '.txt', "w")) !== FALSE) {

			if ($hDir = opendir($importdir)) {
				while(($file = readdir($hDir)) !== false) {
					if (! (is_dir($importdir . $file) || substr($file, 0, 1) == '.' )) {

						if (($impFile = fopen($importdir . $file, "r")) !== FALSE) {
							$nr = (int)substr($file, -7, 3);
							if ($nr < $min) $min = $nr;
							if ($nr > $max) $max = $nr;
							$i = 0;
							//fwrite($expFile, $file . "\n");
							while($string = fgets($impFile)) {
								if ($i > 0 || $j == 0) {
									fwrite($expFile, $string);
								}
								$i++;
							}

							fclose($impFile);
						}

						$j++;

					}
				}
			}

			fclose($expFile);
			file_put_contents("compress.zlib://" . $exportdir . $exportName . '_' . $min . '_' . $max . '.txt.gz', file_get_contents($exportdir . $exportName . '.txt'));
			unlink($exportdir . $exportName . '.txt');

		}

	}