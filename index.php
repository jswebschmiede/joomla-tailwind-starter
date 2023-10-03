<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.joomla-codyhouse-starter
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Language\Text;

defined('_JEXEC') or die;

include_once JPATH_THEMES . '/' . $this->template . '/logic.php'; ?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>

<body class="<?php echo $option
                    . ($home ? ' home' . $task : ' site')
                    . ' view-' . $view
                    . ($layout ? ' layout-' . $layout : ' no-layout')
                    . ($task ? ' task-' . $task : ' no-task')
                    . ($itemid ? ' itemid-' . $itemid : '')
                    . ($pageclass ? ' ' . $pageclass : '')
                    . ($this->direction == 'rtl' ? ' rtl' : '');
                ?>">
    <?php if ($templateparams["pagePreloader"] == 1) : ?>
        <div class="spinner-wrapper fixed inset-0 bg-white z-50 visible transition flex justify-center items-center" id="loader">
            <div class="circle-loader circle-loader--v2" role="alert">
                <p class="circle-loader__label"><?php echo Text::_("TPL_JCS_PRELOADER_TEXT"); ?></p>
                <div aria-hidden="true">
                    <svg class="circle-loader__svg" width="48" height="48" viewBox="0 0 48 48">
                        <circle class="circle-loader__base" cx="24" cy="24" r="19" fill="none" stroke="currentColor" stroke-width="2" />
                        <circle class="circle-loader__fill" cx="24" cy="24" r="19" fill="none" stroke="currentColor" stroke-width="2" />
                    </svg>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div id="page" class="site">

        <?php require(JPATH_THEMES . '/' . $this->template . '/template-parts/header.php') ?>

        <?php if ($this->countModules('header')) : ?>

            <jdoc:include type="modules" name="header" style="none" />

        <?php endif ?>

        <div id="content" class="site-content">

            <?php if ($this->countModules('content-1')) : ?>
                <section id="content-1" class="content-1">
                    <jdoc:include type="modules" name="content-1" style="default" />
                </section>
            <?php endif ?>


            <div class="container pt-24 reveal-fx reveal-fx--translate-up">
                <jdoc:include type="message" />
                <jdoc:include type="component" />
            </div>

            <?php if ($this->countModules('content-2')) : ?>
                <section id="content-2" class="content-2">
                    <jdoc:include type="modules" name="content-2" style="default" />
                </section>
            <?php endif ?>

            <?php if ($this->countModules('content-3')) : ?>
                <section id="content-3" class="content-3">
                    <jdoc:include type="modules" name="content-3" style="default" />
                </section>
            <?php endif ?>

            <?php if ($this->countModules('content-4')) : ?>
                <section id="content-4" class="content-4">
                    <jdoc:include type="modules" name="content-4" style="default" />
                </section>
            <?php endif ?>

            <?php if ($this->countModules('content-5')) : ?>
                <section id="content-5" class="content-5">
                    <jdoc:include type="modules" name="content-5" style="default" />
                </section>
            <?php endif ?>

            <?php if ($this->countModules('content-6')) : ?>
                <section id="content-6" class="content-6">
                    <jdoc:include type="modules" name="content-6" style="default" />
                </section>
            <?php endif ?>
            <?php if ($this->countModules('content-7')) : ?>
                <section id="content-7" class="content-7">
                    <jdoc:include type="modules" name="content-7" style="default" />
                </section>
            <?php endif ?>
            <?php if ($this->countModules('content-8')) : ?>
                <section id="content-8" class="content-8">
                    <jdoc:include type="modules" name="content-8" style="default" />
                </section>
            <?php endif ?>
            <?php if ($this->countModules('content-9')) : ?>
                <section id="content-9" class="content-9">
                    <jdoc:include type="modules" name="content-9" style="default" />
                </section>
            <?php endif ?>
        </div>

        <?php require(JPATH_THEMES . '/' . $this->template . '/template-parts/footer.php') ?>
    </div>

    <?php if ($templateparams["backTop"] == 1) : ?>
        <div class='progress-wrap fixed bottom-5 right-5 2xl:right-12 bg-white h-[3rem] w-[3rem] opacity-0 translate-y-[5px] invisible
        rounded-[9999px] flex items-center justify-center transition-all z-40 cursor-pointer'>
            <svg class='svg-content' width='100%' height='100%' viewBox='-1 -1 102 102'>
                <path class="stroke-primary box-border transition-all stroke-[5px]" fill='none' d='M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98' style='transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 0.351157;'></path>
            </svg>

            <div class='progress-wrap__icon items-center justify-center absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-center text-primary transition-all'>
                <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='h-6 w-6 feather feather-arrow-up'>
                    <line x1='12' y1='19' x2='12' y2='5'></line>
                    <polyline points='5 12 12 5 19 12'></polyline>
                </svg>
            </div>
        </div>
    <?php endif; ?>

    <jdoc:include type="modules" name="debug" />
</body>

</html>
