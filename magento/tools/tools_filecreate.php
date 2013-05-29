<?php
/**
 * Created by JetBrains PhpStorm.
 * User: erik
 * Date: 5/8/13
 * Time: 8:29 PM
 * To change this template use File | Settings | File Templates.
 */


class tools_filecreate {

	static function makeclass($name, $extend, $comment = array(), $body = null)
	{
		$text = "<?php\n\n";
		$text .= "/**\n";
		foreach($comment as $line) {
			$text .= " * " . $line . "\n";
		}
		$text .= " */\n";
		$text .= "class " . $nameSpace. "_" . $module . "_Model_" . $name . " " . $extend . "\n";
		$text .= "{\n";
		$text .= "\n";
		$text .= "\n";
		$text .= $body;
		$text .= "}\n";
		return $text;
	}

	static function model($nameSpace, $module, $name, $extend = "")
	{
		$modelName = $nameSpace. "_" . $module . "_Model_" . $name;
		return self::makeclass($modelName,
							   $extend,
							   array($modelName,
								     $module . " " . $name
							   		),
							   null
		);
	}
}