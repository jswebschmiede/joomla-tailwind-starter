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


<header class="f-header relative js-f-header" data-element="header">
    <div class="f-header__mobile-content w-full-p-1 lg:w-full-p-2 mx-auto max-w-wide">
        <a href="<?php echo $this->baseurl; ?>/" class="f-header__logo">
            <?php if ($templateparams['brand'] == 1) : ?>
                <?php echo $logo; ?>
            <?php endif; ?>
        </a>

        <button class="anim-menu-btn js-anim-menu-btn f-header__nav-control js-tab-focus" aria-label="Toggle menu">
            <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
        </button>
    </div>

    <div class="f-header__nav" role="navigation">
        <div class="f-header__nav-grid lg:justify-between w-full-p-1 lg:w-full-p-2 mx-auto max-w-wide">
            <div class="f-header__nav-logo-wrapper">
                <a href="<?php echo $this->baseurl; ?>/" class="f-header__logo">
                    <?php if ($templateparams['brand'] == 1) : ?>
                        <?php echo $logo; ?>
                    <?php endif; ?>
                </a>
            </div>

            <ul class="f-header__list">
                <?php if ($this->countModules('main-menu', true)) : ?>
                    <jdoc:include type="modules" name="main-menu" style="none" />
                <?php endif ?>
            </ul>
        </div>
    </div>
</header>