<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$class = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';

if ($class)
{
    $faIcon = '<i '. $class .' aria-hidden="true"></i>';
}
else
{
    $faIcon = '';
}

if ($item->menu_image)
{
	$item->params->get('menu_text', 1) ?
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' :
	$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
    if ($item->deeper || $item->id == 270)
    {
        $explodeTitle = explode(" ", $item->title);
        $last_key = key( array_slice( $explodeTitle, -1, 1, TRUE ) );
        $lastString = end($explodeTitle);
        unset($explodeTitle[$last_key]);
        $withoutLastElement = implode(" ", $explodeTitle);

        $linktype = '
        '. $faIcon .'
        <a href="'. $item->flink .'">
        '. $withoutLastElement ." ". $lastString . '</span>
        </a>';
    }
    else
    {
        $linktype = ''. $faIcon .'<a href="'. $item->flink .'"  >'. $item->title . '</a>';
    }
}

switch ($item->browserNav)
{
	default:
	case 0:
?><?php echo $linktype; ?><?php
		break;
	case 1:
		// _blank
?><?php echo $linktype; ?><?php
		break;
	case 2:
	// Use JavaScript "window.open"
?><a href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');return false;" <?php echo $title; ?>><?php echo $linktype; ?></a>
<?php
		break;
}
