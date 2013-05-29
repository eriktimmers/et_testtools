<?php
error_reporting(E_ALL ^ E_NOTICE);

	require_once 'tools.php';
	require_once 'conf.php';

	html_default_head();


switch ($_REQUEST['step']) {


	case '1':
		//var_dump($_REQUEST);
		$aPath = array_flip($aProject);
		$moduleName = ucfirst($_REQUEST['modulename']);
		$basePath = $aPath[$_REQUEST['project']] . 'app/code/' . $_REQUEST['codepool'] . '/' . $_REQUEST['namespace'] . '/';
		$modulePath = $basePath . $moduleName . '/';
		$etcPath = $aPath[$_REQUEST['project']] . 'app/etc/modules/';

		if (!is_dir($basePath)) {
			echo 'Error making module path! Basepath "' . $basePath . '" unknown.';
			die();
		}
		if (is_dir($basePath . $moduleName . '/')) {
			echo 'Error making module path! path "' . $basePath . $moduleName . '/' . '" already exists.';
			die();
		}

		speak('Creating module.');
		mkdir($modulePath);

		if ($_REQUEST['blocks']) {
			speak('Creating block directory.');
			mkdir($modulePath . 'Block/');
			if ($_REQUEST['blocks_tpl']) {
				speak('Creating block.');
				file_put_contents($modulePath . 'Block/' . $moduleName . '.php', create_block($_REQUEST['namespace'], $moduleName));
			}

		}
		if ($_REQUEST['controllers']) {
			speak('Creating controllers directory.');
			mkdir($modulePath . 'controllers/');
			if ($_REQUEST['controllers_tpl']) {
				speak('Creating controller.');
				file_put_contents($modulePath . 'controllers/IndexController.php', create_controller($_REQUEST['namespace'], $moduleName));
			}
		}
		speak('Creating etc directory.');
		mkdir($modulePath . 'etc/');
		if ($_REQUEST['helpers']) {
			speak('Creating helper directory.');
			mkdir($modulePath . 'Helper/');
			if ($_REQUEST['helpers_tpl']) {
				speak('Creating helper.');
				file_put_contents($modulePath . 'Helper/Data.php', create_helper($_REQUEST['namespace'], $moduleName));
			}
		}
		if ($_REQUEST['models']) {
			speak('Creating model directory.');
			mkdir($modulePath . 'Model/');
			if ($_REQUEST['models_tpl']) {
				speak('Creating model.');
				file_put_contents($modulePath . 'Model/Specimen.php', create_model_file($_REQUEST['namespace'], $moduleName, 'Specimen'));
			}
		}
		speak('Creating sql directory.');
		mkdir($modulePath . 'sql/');

		speak('Creating app etc xml');
		file_put_contents($etcPath . $_REQUEST['namespace'] . '_' . $moduleName . '.xml',
			create_etc($_REQUEST['namespace'], $moduleName)
		);

		speak('Creating config.xml');
		file_put_contents($modulePath . 'etc/config.xml',
			create_config($_REQUEST['namespace'], $moduleName)
		);

		break;

	default:
		form();


}

?>




<?php
	html_default_footer();

function form()
{
	global $aProject;
	echo '<form target="" method="post" action="">';

	echo select('Project', 'project', '', $aProject);
	echo select('Codepool', 'codepool', 'local', array('local', 'community', 'core'));
	echo select('Namespace', 'namespace', 'Kega', array('Kega', 'Erikt'));
	echo field('Module name', 'modulename', '');
	echo '<br/>';
	echo field('Depends', 'depends', '');
	echo check2('Add Blocks', 'blocks', 1, true, true);
	echo check2('Add Controllers', 'controllers', 1, true, true);
	echo check2('Add Helpers', 'helpers', 1, true, true);
	echo check2('Add Models', 'models', 1, true, true);

	echo '<input type="hidden" name="step" value="1"/>';
	echo '<input type="submit" value="GO!"/>';
	echo '</form>
';
}

