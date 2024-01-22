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


<header class="f-header bg-white relative js-f-header w-full h-[--f-header-height] z-[3] <?php echo ((bool)$templateparams['stickyHeader']) ?  'f-header--sticky' : null; ?>" data-element="header">
    <div class="f-header__mobile-content w-full-p-1 lg:w-full-p-2 mx-auto max-w-big">
        <a href="<?php echo $this->baseurl; ?>/" class="f-header__logo">
            <?php if ((bool)$templateparams['brand']) : ?>
                <?php echo $logo; ?>
            <?php endif; ?>
        </a>

        <button class="anim-menu-btn js-anim-menu-btn f-header__nav-control js-tab-focus" aria-label="Toggle menu">
            <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
        </button>
    </div>

    <div class="f-header__nav" role="navigation">
        <div class="f-header__nav-grid lg:justify-between w-full-p-1 lg:w-full-p-2 mx-auto max-w-big">
            <div class="f-header__nav-logo-wrapper grow">
                <a href="<?php echo $this->baseurl; ?>/" class="f-header__logo">
                    <?php if ((bool)$templateparams['brand']) : ?>
                        <?php echo $logo; ?>
                    <?php endif; ?>
                </a>
            </div>


            <?php if ($this->countModules('main-menu', true)) : ?>
                <jdoc:include type="modules" name="main-menu" style="none" />
            <?php endif ?>

        </div>
    </div>
</header>