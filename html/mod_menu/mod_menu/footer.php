<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$id = '';

if ($tagId = $params->get('tag_id', '')) {
    $id = 'id="' . $tagId . '"';
}

// The menu class is deprecated. Use mod-menu instead
?>

<?php if ($module->showtitle) : ?>
    <p class="pb-8 font-heading"><?php echo $module->title; ?></p>
<?php endif ?>
<ul <?php echo $id; ?> class="mod-menu flex gap-2 flex-col <?php echo $class_sfx; ?>" data-element="footer-menu">
    <?php foreach ($list as $i => &$item) {
        $itemParams = $item->getParams();
        $class      = 'nav-item item-' . $item->id;

        if ($item->id == $default_id) {
            $class .= ' default';
        }

        if ($item->id == $active_id || ($item->type === 'alias' && $itemParams->get('aliasoptions') == $active_id)) {
            $class .= ' current';
        }

        if (in_array($item->id, $path)) {
            $class .= ' active';
        } elseif ($item->type === 'alias') {
            $aliasToId = $itemParams->get('aliasoptions');

            if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) {
                $class .= ' active';
            } elseif (in_array($aliasToId, $path)) {
                $class .= ' alias-parent-active';
            }
        }

        if ($item->type === 'separator') {
            $class .= ' divider';
        }

        if ($item->deeper) {
            $class .= ' deeper';
        }

        if ($item->parent) {
            $class .= ' parent dropdown';
        }

        echo '<li class="' . $class . '">';

        switch ($item->type):
            case 'separator':
            case 'component':
            case 'heading':
            case 'url':
                require ModuleHelper::getLayoutPath('mod_menu', 'footer_' . $item->type);
                break;

            default:
                require ModuleHelper::getLayoutPath('mod_menu', 'footer_component');
                break;
        endswitch;

        // The next item is deeper.
        if ($item->deeper) {
            echo '<ul class="mod-menu__sub list-unstyled small">';
        } elseif ($item->shallower) {
            // The next item is shallower.
            echo '</li>';
            echo str_repeat('</ul></li>', $item->level_diff);
        } else {
            // The next item is on the same level.
            echo '</li>';
        }
    }
    ?></ul>