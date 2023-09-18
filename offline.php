<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.joomla-codyhouse-starter
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// variables
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\AuthenticationHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

require(JPATH_THEMES . '/' . $this->template . '/logic.php');

$extraButtons = AuthenticationHelper::getLoginButtons('form-login');
$app = Factory::getApplication();
$wa = $this->getWebAssetManager();

// Logo file or site title param
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>

<body>
    <div class="container max-width-adaptive-lg padding-y-lg text-center">
        <div class="offline-card">
            <div class="header">
                <?php if (!empty($logo)) : ?>
                    <h1><?php echo $logo; ?></h1>
                <?php else : ?>
                    <h1 class="color-primary text-xxxl padding-bottom-md"><?php echo $sitename; ?></h1>
                <?php endif; ?>
                <?php if ($app->get('offline_image')) : ?>
                    <?php echo HTMLHelper::_('image', $app->get('offline_image'), $sitename, [], false, 0); ?>
                <?php endif; ?>
                <?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) != '') : ?>
                    <p class="text-lg"><?php echo $app->get('offline_message'); ?></p>
                <?php elseif ($app->get('display_offline_message', 1) == 2) : ?>
                    <p class="text-lg"><?php echo Text::_('JOFFLINE_MESSAGE'); ?></p>
                <?php endif; ?>
            </div>
            <div class="login max-width-xxxs margin-auto padding-y-lg text-left">
                <jdoc:include type="message" />
                <form action="<?php echo Route::_('index.php', true); ?>" method="post" id="form-login">
                    <fieldset class="flex flex-column">
                        <label for="username"><?php echo Text::_('JGLOBAL_USERNAME'); ?></label>
                        <input name="username" class="form-control" id="username" type="text">
                        <br>
                        <label for="password"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
                        <input name="password" class="form-control" id="password" type="password">

                        <?php foreach ($extraButtons as $button) :
                            $dataAttributeKeys = array_filter(array_keys($button), function ($key) {
                                return substr($key, 0, 5) == 'data-';
                            });
                        ?>
                            <div class="mod-login__submit form-group">
                                <button type="button" class="btn btn--primary <?php echo $button['class'] ?? '' ?>" <?php foreach ($dataAttributeKeys as $key) : ?> <?php echo $key ?>="<?php echo $button[$key] ?>" <?php endforeach; ?> <?php if ($button['onclick']) : ?> onclick="<?php echo $button['onclick'] ?>" <?php endif; ?> title="<?php echo Text::_($button['label']) ?>" id="<?php echo $button['id'] ?>">
                                    <?php if (!empty($button['icon'])) : ?>
                                        <span class="<?php echo $button['icon'] ?>"></span>
                                    <?php elseif (!empty($button['image'])) : ?>
                                        <?php echo $button['image']; ?>
                                    <?php elseif (!empty($button['svg'])) : ?>
                                        <?php echo $button['svg']; ?>
                                    <?php endif; ?>
                                    <?php echo Text::_($button['label']) ?>
                                </button>
                            </div>
                        <?php endforeach; ?>

                        <button type="submit" name="Submit" class="btn btn--primary margin-top-md"><?php echo Text::_('JLOGIN'); ?></button>

                        <input type="hidden" name="option" value="com_users">
                        <input type="hidden" name="task" value="user.login">
                        <input type="hidden" name="return" value="<?php echo base64_encode(Uri::base()); ?>">
                        <?php echo HTMLHelper::_('form.token'); ?>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>

</html>