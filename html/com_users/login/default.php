<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var \Joomla\Component\Users\Site\View\Login\HtmlView $this */

$cookieLogin = $this->user->get('cookieLogin');
?>


<div>
    <?php if (!empty($cookieLogin) || $this->user->get('guest')) : ?>
        <?php echo $this->loadTemplate('login'); ?>
    <?php else : ?>
        <?php echo $this->loadTemplate('logout'); ?>
    <?php endif ?>
</div>