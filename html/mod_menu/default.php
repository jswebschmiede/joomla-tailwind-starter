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
    $id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use mod-menu instead
?>

<?php foreach ($list as $i => &$item) {
    $itemParams = $item->getParams();
    $class      = 'f-header__item item-' . $item->id;

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
        $class .= ' parent';
    }

    if ($item->deeper) {
        echo '<li class="' . $class . '"><button class="f-header__dropdown-control max-h-[34px] js-f-header__dropdown-control text-inherit"><span>';
    } else {
        echo '<li class="' . $class . '">';
    }

    switch ($item->type):
        case 'separator':
        case 'component':
        case 'heading':
        case 'url':
            require ModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
            break;

        default:
            require ModuleHelper::getLayoutPath('mod_menu', 'default_url');
            break;
    endswitch;

    if ($item->deeper) {
        echo '</span><svg class="f-header__dropdown-icon icon h-[12px] w-[12px] inline-block text-inherit fill-dark-500 leading-none shrink-0" aria-hidden="true" viewBox="0 0 12 12">
        <path d="M9.943,4.269A.5.5,0,0,0,9.5,4h-7a.5.5,0,0,0-.41.787l3.5,5a.5.5,0,0,0,.82,0l3.5-5A.5.5,0,0,0,9.943,4.269Z" />
      </svg></button>';
    }

    // The next item is deeper.
    if ($item->deeper) {
        echo '<ul class="mod-menu__sub f-header__dropdown bg-primary">';
    } elseif ($item->shallower) {
        // The next item is shallower.
        echo '</li>';
        echo str_repeat('</ul></li>', $item->level_diff);
    } else {
        // The next item is on the same level.
        echo '</li>';
    }
}
?>
