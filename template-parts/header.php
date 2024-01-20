<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.joomla-codyhouse-starter
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>


<header data-element="header">
    <div class="w-full-p-1 lg:w-full-p-2 max-w-big mx-auto">
        <?php if ($templateparams['brand'] == 1) : ?>
            <div data-element="navbar-brand">
                <a data-element="brand-logo" href="<?php echo $this->baseurl; ?>/">
                    <?php echo $logo; ?>
                </a>
                <?php if ($templateparams['siteDescription']) : ?>
                    <div data-element="site-description"><?php echo htmlspecialchars($templateparams['siteDescription']); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>


        <?php if ($this->countModules('main-menu')) : ?>
            <jdoc:include type="modules" name="main-menu" style="none" />
        <?php endif ?>
    </div>
</header>