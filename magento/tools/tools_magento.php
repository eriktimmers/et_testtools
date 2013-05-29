<?php
/**
 * Created by JetBrains PhpStorm.
 * User: erik
 * Date: 5/8/13
 * Time: 8:41 PM
 * To change this template use File | Settings | File Templates.
 */

class tools_magento {

	static function create_model($projectPath, $namespace, $module, $modelname)
	{
		$modelPath = $projectPath . 'app/code/local/' . $namespace . '/' . $module . '/Model/';
		if (!is_dir($modelPath)) {
			speak('Creating Model directory.');
			mkdir($modelPath);
		}
		speak('Creating model.');
		file_put_contents($modelPath . ucfirst($modelname) . '.php', tools_filecreate::model($namespace, $module, ucfirst($modelname)));
	}

	static function addtoconfig_model($projectPath, $namespace, $module, $modelname)
	{
		$configPath = $projectPath . 'app/code/local/' . $namespace . '/' . $module . '/etc/';
		$xml = simplexml_load_file($configPath . 'config.xml');
		if (!$xml->global) {
			$xml->addChild('global');
		}
		if (!$xml->global->models) {
			$xml->global->addChild('models');
			$xml->global->models->addChild($module);
			$xml->global->models->{$module}->addChild('class', $namespace . '_' . $module . '_Model');
		}

		$dom = new DOMDocument("1.0");
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml->asXML());
		$xml = $dom->saveXML();

		$xml2 = preg_replace_callback('/^( +)</m', function($a) {
			return str_repeat("\t",intval(strlen($a[1]) / 2)).'<';
		}, $xml);

		file_put_contents($configPath . 'config.xml', $xml2);

	}

}