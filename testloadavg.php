<?php

$aLoad = sys_getloadavg();

logline(implode('; ', $aLoad));

if ((float)$aLoad[0] > 8) {
	logline2(' ');
	getPs();	
	getOther();
	getTopInfo();
	getDbStat('localhost', 'infoqbase_it', 'z0X77bx');
	getDbStat('localhost', 'deldo_log', 'D3ld0l0g3r');
	getDbStat('localhost', 'tools_infomerce', '2WgHOK1e5xs');
	getDbStat('localhost', 'tools_log', 'D3ld0l0g3r');
	getDbStat('localhost', 'mobiel_infomerce', '0Lp5YPtd2');
	getDbStat('localhost', 'mobiel_log', 'D3ld0l0g3r');	
	//callDashboard('highload', 'error', urlencode(implode('; ', $aLoad)));
} else {
	//callDashboard('ok', 'ok', urlencode(implode('; ', $aLoad)));	
}

function callDashboard($event, $status, $msg)
{
	$config = array(
		'adapter'      => 'Zend_Http_Client_Adapter_Socket'
	);
 
	// Instantiate a client object
	$client = new Zend_Http_Client('http://support-dashboard.itnova.nl/push/amz100load/' . $event . '/status/' . $status . '/msg/' . $msg . '/', $config);
 
	// The following request will be sent over a TLS secure connection.
	$response = $client->request();
	
	echo $response . '!';
	
	
}



function getOther() 
{
	logline2('== vmstat ==');
	exec('vmstat', $out);
	foreach($out as $outLine) {	
		logline2($outLine);
	}
	unset($out);
	logline2('== free ==');
	exec('free', $out);
	foreach($out as $outLine) {	
		logline2($outLine);
	}	
}	

function getTopInfo() 
{	
	unset($out);
	logline2('== top ==');
	exec('top -b -c -n 1', $out);
	$i=0;
	foreach($out as $outLine) {
		$i++;
		if ($i > 6 && $i < 14) {
			logline2($outLine);
		}		
	}	
}

function getPs() 
{
	logline2('== PHP processes ==');
	exec('ps aux', $out);
	foreach($out as $outLine) {	
		if (strpos($outLine, 'php') !== false) {
			logline2($outLine);
		}
	}
}

function logline($msg) 
{
	error_log(date('Y-m-d H:i:s') . ' ' . $msg . "\n", 
			  3, dirname(__FILE__) . '/log/' . 'loadavg' . date('Ymd') . '.log');
	
}

function logline2($msg) 
{
	error_log(date('Y-m-d H:i:s') . ' [' . getmypid() . '] ' . $msg . "\n", 
			  3, dirname(__FILE__) . '/log/' . 'loadavgmoreinfo' . date('Ymd') . '.log');	
}

function getDbStat($db, $usn, $pwd)
{
	logline2('== DB ' . $usn . ' ==');
	$link = mysql_connect($db, $usn, $pwd);
	
	if (!$link) {
		logline2('Could not connect: ' . mysql_error());
		return false;
	}
	//mysql_select_db('db2'); 
	$query = mysql_query('show processlist', $link);
	$i = 0;
	while ($rs = mysql_fetch_array($query)) {
		$i++;
		if ($i < 7) {
			$logstring = $rs['Id'] . ': ' . $rs['User'] . '@' . $rs['Host'] . ' => (' . $rs['Time'] . ') ' . $rs['Info'];
			logline2($logstring);
		}
	}
	
	mysql_close($link);
	logline2('Counted ' . $i . ' Processes');

}