<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Router\Route;

/** @var \Joomla\Component\Users\Site\View\Login\HtmlView $cookieLogin */

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
    ->useScript('form.validate');

$usersConfig = ComponentHelper::getParams('com_users');

?>
<div class="com-users-login login card max-w-lg py-8 px-12 mb-12 lg:mb-24 mx-auto">
    <?php if ($this->params->get('show_page_heading')) : ?>
        <div class="page-header prose lg:prose-lg pb-4">
            <h2>
                <?php echo $this->escape($this->params->get('page_heading')); ?>
            </h2>
        </div>
    <?php endif; ?>

    <?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description', '')) != '') || $this->params->get('login_image') != '') : ?>
        <div class="com-users-login__description login-description prose lg:prose-lg pb-4">
        <?php endif; ?>

        <div class="text-center">
            <?php if ($this->params->get('logindescription_show') == 1) : ?>
                <?php echo $this->params->get('login_description'); ?>
            <?php endif; ?>
        </div>

        <?php if ($this->params->get('login_image') != '') : ?>
            <?php echo HTMLHelper::_('image', $this->params->get('login_image'), empty($this->params->get('login_image_alt')) && empty($this->params->get('login_image_alt_empty')) ? false : $this->params->get('login_image_alt'), ['class' => 'com-users-login__image login-image']); ?>
        <?php endif; ?>

        <?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description', '')) != '') || $this->params->get('login_image') != '') : ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo Route::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="com-users-login__form form-validate " id="com-users-login__form">

        <fieldset>
            <?php echo $this->form->renderFieldset('credentials', ['class' => 'com-users-login__input']); ?>

            <?php foreach ($this->extraButtons as $button) :
                $dataAttributeKeys = array_filter(array_keys($button), function ($key) {
                    return substr($key, 0, 5) == 'data-';
                });
            ?>
                <div class="com-users-login__submit control-group">
                    <div class="controls">
                        <button type="button" class="btn btn--secondary w-full <?php echo $button['class'] ?? '' ?>" <?php foreach ($dataAttributeKeys as $key) : ?> <?php echo $key ?>="<?php echo $button[$key] ?>" <?php endforeach; ?> <?php if ($button['onclick']) : ?> onclick="<?php echo $button['onclick'] ?>" <?php endif; ?> title="<?php echo Text::_($button['label']) ?>" id="<?php echo $button['id'] ?>">
                            <?php if (!empty($button['icon'])) : ?>
                                <span class="<?php echo $button['icon'] ?>"></span>
                            <?php elseif (!empty($button['image'])) : ?>
                                <?php echo HTMLHelper::_('image', $button['image'], Text::_($button['tooltip'] ?? ''), [
                                    'class' => 'icon',
                                ], true) ?>
                            <?php elseif (!empty($button['svg'])) : ?>
                                <?php echo $button['svg']; ?>
                            <?php endif; ?>
                            <?php echo Text::_($button['label']) ?>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="com-users-login__submit control-group pt-1">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">
                        <?php echo Text::_('JLOGIN'); ?>
                    </button>
                </div>
            </div>

            <?php $return = $this->form->getValue('return', '', $this->params->get('login_redirect_url', $this->params->get('login_redirect_menuitem', ''))); ?>
            <input type="hidden" name="return" value="<?php echo base64_encode($return); ?>">
            <?php echo HTMLHelper::_('form.token'); ?>
        </fieldset>
    </form>

    <div class="com-users-login__options list-group mt-8">
        <a class="card px-4 py-2 rounded-b-none com-users-login__reset list-group-item" href="<?php echo Route::_('index.php?option=com_users&view=reset'); ?>">
            <?php echo Text::_('COM_USERS_LOGIN_RESET'); ?>
        </a>
        <a class="card px-4 py-2 rounded-t-none<?php if ($usersConfig->get('allowUserRegistration')) : ?> rounded-b-none<?php endif; ?> com-users-login__remind list-group-item" href="<?php echo Route::_('index.php?option=com_users&view=remind'); ?>">
            <?php echo Text::_('COM_USERS_LOGIN_REMIND'); ?>
        </a>
        <?php if ($usersConfig->get('allowUserRegistration')) : ?>
            <a class="card px-4 py-2 rounded-t-none com-users-login__register list-group-item" href="<?php echo Route::_('index.php?option=com_users&view=registration'); ?>">
                <?php echo Text::_('COM_USERS_LOGIN_REGISTER'); ?>
            </a>
        <?php endif; ?>
    </div>
</div>
