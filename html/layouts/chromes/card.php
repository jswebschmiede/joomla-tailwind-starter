<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.joomla-codyhouse-starter
 *
 * @copyright   (C) 2020 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\Utilities\ArrayHelper;

$module  = $displayData['module'];
$params  = $displayData['params'];
$attribs = $displayData['attribs'];

if ($module->content === null || $module->content === '') {
    return;
}

$moduleTag              = $params->get('module_tag', 'div');
$moduleAttribs          = [];
$moduleAttribs['class'] = 'default container max-width-adaptive-lg padding-y-lg padding-x-md ' . htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8');
$headerTag              = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass            = htmlspecialchars($params->get('header_class', ''), ENT_QUOTES, 'UTF-8');
$headerAttribs          = [];
$headerAttribs['class'] = 'margin-bottom-md ';
$headerAttribs['class'] .= $headerClass;


// Only add aria if the moduleTag is not a div
if ($moduleTag !== 'div') {
    if ($module->showtitle) :
        $moduleAttribs['aria-labelledby'] = 'mod-' . $module->id;
        $headerAttribs['id']              = 'mod-' . $module->id;
    else :
        $moduleAttribs['aria-label'] = $module->title;
    endif;
}

$header = '<' . $headerTag . ' ' . ArrayHelper::toString($headerAttribs) . '>' . $module->title . '</' . $headerTag . '>';
?>
<<?php echo $moduleTag; ?> <?php echo ArrayHelper::toString($moduleAttribs); ?>>
    <?php if ($params->get('backgroundimage')) : ?>
        <?php if ($module->showtitle) : ?>
            <?php echo $header; ?>
        <?php endif; ?>

        <div class="card position-relative">
            <div class="grid flex items-center">
                <div class="card__image col-3@md position-relative">
                    <figure class="position-absolute height-100% width-100%">
                        <img class="width-100% height-100% object-cover" src="<?php echo Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $params->get('backgroundimage'))->url ?>" alt="">
                    </figure>
                </div>
                <div class="card__content col-9@md">
                    <div class="text-center padding-lg">
                        <?php echo $module->content; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="card position-relative">
            <div class="card__content">
                <div class="text-center padding-lg">
                    <?php if ($module->showtitle) : ?>
                        <?php echo $header; ?>
                    <?php endif; ?>
                    <?php echo $module->content; ?>
                </div>
            </div>
        </div>
    <?php endif ?>
</<?php echo $moduleTag; ?>>