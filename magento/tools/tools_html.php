<?php
/**
 * Created by JetBrains PhpStorm.
 * User: erik
 * Date: 5/8/13
 * Time: 8:39 PM
 * To change this template use File | Settings | File Templates.
 */

class tools_html {
	static function linkit($label, $url, $target = '_blank', $addHttp = true)
	{
		echo '<a href="' . ($addHttp ? 'http://' : '') . $url . '" target="' . $target . '">' . $label . '</a><br/>';
	}

	static function field($label, $name, $value)
	{
		return '<b>' . $label . ':</b><br/><input type="text" name="' . $name . '" value="' . $value . '"/><br/>';
	}

	static function label($label, $name, $value)
	{
		return '<b>' . $label . ':</b><br/>' . $value . '<input type="hidden" name="' . $name . '" value="' . $value . '"/><br/>';
	}


	static function check($label, $name, $value, $checked=false)
	{
		return '<b>' . $label . ':</b><br/><input type="checkbox" name="' . $name . '" value="' . $value . '"' . ($checked ? 'checked="checked"' : '' ) . '/><br/>';
	}

	static function check2($label, $name, $value, $checked=false, $checked2=false)
	{
		return '<b>' . $label . ':</b> <input type="checkbox" name="' . $name . '" value="' . $value . '"' . ($checked ? 'checked="checked"' : '' ) . '/> => ' .
			'<b>Add template:</b> <input type="checkbox" name="' . $name . '_tpl" value="' . $value . '"' . ($checked2 ? 'checked="checked"' : '' ) . '/><br/>';
	}


	static function select($label, $name, $value, $options=array())
	{

		$html = '<b>' . $label . ':</b><br/><select id="id_' . $name . '" name="' . $name . '">';
		foreach((array)$options as $okey=>$ovalue) {
			$html .= '<option value="' . (is_numeric($okey) ? $ovalue : $okey) . '"' . ($ovalue == $value ? ' selected="selected"' : "") . '>' . $ovalue . '</option>';
		}
		$html .= '</select><br/>';
		return $html;
	}

	static function html_default_head($opts = null)
	{
		$html = '<html><head>';
		$html .= '<link rel="stylesheet" type="text/css" href="/style/styles.css" media="screen" />' . "\n";
		$html .= '<script type="text/javascript" src="/js/jquery-1.9.1.js"></script>' . "\n";
		if ($opts['extraJs']) {
			$html .= '<script type="text/javascript" src="' . $opts['extraJs'] . '"></script>' . "\n";
		}
		$html .= '</head><body>';
		echo $html;
	}

	static function html_default_footer()
	{
		$html = <<<HTML
</body>
</html>
HTML;
		echo $html;
	}
}