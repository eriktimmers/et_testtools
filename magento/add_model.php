<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once 'tools.php';
require_once 'conf.php';
require_once 'tools/tools_filecreate.php';
require_once 'tools/tools_html.php';
require_once 'tools/tools_magento.php';

tools_html::html_default_head(array('extraJs' => 'js/add_model.js'));

switch ($_REQUEST['step']) {

	case '1':
		tools_magento::create_model($aProject[$_POST['project']]['path'], $_REQUEST['namespace'], $_POST['module'], $_POST['modelname']);
		tools_magento::addtoconfig_model($aProject[$_POST['project']]['path'], $_REQUEST['namespace'], $_POST['module'], $_POST['modelname']);

		break;

	default:
		form0();

}

?>


<?php
tools_html::html_default_footer();


function form0()
{
	global $aProject;
	echo '<form target="" method="post" action="">';
	foreach($aProject as $key=>$value) {
		$selProject[] = $key;
	}
	echo tools_html::select('Project', 'project', '', $selProject);
	echo tools_html::select('Namespace', 'namespace', 'Kega', null);
	echo tools_html::select('Modules', 'module', 'Kega', null);
	echo tools_html::field('Model name', 'modelname', 'newmodel');

	echo '<input type="hidden" name="step" value="1"/>';
	echo '<input type="submit" value="GO!"/>';
	echo '</form>
';
}