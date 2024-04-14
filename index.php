<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.joomla-codyhouse-starter
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Factory;
use Joomla\CMS\Layout\LayoutHelper;

defined('_JEXEC') or die;

require(JPATH_THEMES . '/' . $this->template . '/logic.php');

?>
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
        <?php echo LayoutHelper::render('joomla.ui.preloader'); ?>
    <?php endif; ?>

    <?php require(JPATH_THEMES . '/' . $this->template . '/template-parts/header.php') ?>

    <?php if ($this->countModules('header', true)) : ?>
        <jdoc:include type="modules" name="header" style="none" />
    <?php endif ?>

    <main data-element="content">
        <?php if ($this->countModules('content-1', true)) : ?>
            <section id="content-1" class="content-1">
                <jdoc:include type="modules" name="content-1" style="default" />
            </section>
        <?php endif ?>

        <?php if (Factory::getApplication()->getMessageQueue()) : ?>
            <div class="py-4">
                <jdoc:include type="message" />
            </div>
        <?php endif; ?>

        <div class="w-full-p-1 lg:w-full-p-2 mx-auto max-w-wide pt-12 lg:pt-24">
            <div class="prose sm:prose-md lg:prose-lg">
                <jdoc:include type="component" />
            </div>
        </div>

        <?php if ($this->countModules('content-2', true)) : ?>
            <section id="content-2" class="content-2">
                <jdoc:include type="modules" name="content-2" style="default" />
            </section>
        <?php endif ?>

        <?php if ($this->countModules('content-3', true)) : ?>
            <section id="content-3" class="content-3">
                <jdoc:include type="modules" name="content-3" style="default" />
            </section>
        <?php endif ?>

        <?php if ($this->countModules('content-4', true)) : ?>
            <section id="content-4" class="content-4">
                <jdoc:include type="modules" name="content-4" style="default" />
            </section>
        <?php endif ?>

        <?php if ($this->countModules('content-5', true)) : ?>
            <section id="content-5" class="content-5">
                <jdoc:include type="modules" name="content-5" style="default" />
            </section>
        <?php endif ?>

        <?php if ($this->countModules('content-6', true)) : ?>
            <section id="content-6" class="content-6">
                <jdoc:include type="modules" name="content-6" style="default" />
            </section>
        <?php endif ?>

        <?php if ($this->countModules('content-7', true)) : ?>
            <section id="content-7" class="content-7">
                <jdoc:include type="modules" name="content-7" style="default" />
            </section>
        <?php endif ?>
        <?php if ($this->countModules('content-8', true)) : ?>
            <section id="content-8" class="content-8">
                <jdoc:include type="modules" name="content-8" style="default" />
            </section>
        <?php endif ?>
        <?php if ($this->countModules('content-9', true)) : ?>
            <section id="content-9" class="content-9">
                <jdoc:include type="modules" name="content-9" style="default" />
            </section>
        <?php endif ?>
    </main>

    <?php require(JPATH_THEMES . '/' . $this->template . '/template-parts/footer.php') ?>

    <?php if ($templateparams["backTop"] == 1) : ?>
        <?php echo LayoutHelper::render('joomla.ui.backtop'); ?>
    <?php endif; ?>

    <jdoc:include type="modules" name="debug" />
</body>

</html>
