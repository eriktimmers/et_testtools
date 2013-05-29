<?php



function speak($msg)
{
	echo ' - ' . $msg . '<br/>';
}


function create_etc($nameSpace, $module)
{
	$text = "<config>
    <modules>
        <{$nameSpace}_{$module}>
            <active>true</active>
            <codePool>" . $_REQUEST['codepool'] . "</codePool>";
	if ($_REQUEST['depends']) {
		$text .= "
			<depends>
				<" . $_REQUEST['depends'] . " />
			</depends>";
	}

	$text .= "
        </" . $nameSpace. "_" . $module . ">
    </modules>
</config>
";
	return $text;
}


function create_block($nameSpace, $module)
{
	$text = "<?php\n\n";
	$text .= "class " . $nameSpace. "_" . $module . "_Block_" . $module . " extends Mage_Core_Block_Template\n";
	$text .= "{\n";
	$text .= "\tprotected function _construct()\n";
	$text .= "\t{\n";
	$text .= "\tparent::_construct();\n";
	$text .= "\t\$this->setTemplate('" . strtolower($module) . "/" . strtolower($module) . ".phtml');\n";
	$text .= "\t}\n";
	$text .= "}\n";
	return $text;
}

function create_controller($nameSpace, $module)
{
	$text = "<?php\n\n";
	$text .= "class " . $nameSpace. "_" . $module . "_IndexController extends Mage_Core_Controller_Front_Action\n";
	$text .= "{\n";
	$text .= "\tpublic function indexAction()\n";
	$text .= "\t{\n";
	$text .= "\t}\n";
	$text .= "}\n";
	return $text;
}

function create_helper($nameSpace, $module)
{
	$text = "<?php\n\n";
	$text .= "/**\n";
	$text .= " * " . $nameSpace. "_" . $module . "_Helper_Data\n";
	$text .= " * " . $module . " Helper\n";
	$text .= " */\n";
	$text .= "class " . $nameSpace. "_" . $module . "_Helper_Data extends Mage_Core_Helper_Abstract\n";
	$text .= "{\n";
	$text .= "\tpublic function indexAction()\n";
	$text .= "\t{\n";
	$text .= "\t}\n";
	$text .= "}\n";
	return $text;
}



function create_config($nameSpace, $module)
{
	$text = "<?xml version=\"1.0\"?>\n";
	$text .= "<config>\n";


	//<modules>
	//	<Kega_Wizard>
	//		<version>0.0.3</version>
	//	</Kega_Wizard>
	//</modules>
	$text .= "</config>\n";
	return $text;
}


function getSubdirs($dir)
{
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if (filetype($dir . $file) == 'dir' && !in_array($file, array('.', '..'))) {
					$aModules[] = $file;
				}
			}
			closedir($dh);
		}
	} else {
		echo 'Error reading ' . $dir;
		die();
	}
	return $aModules;
}


