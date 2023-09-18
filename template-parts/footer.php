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


<footer id="mastfooter" class="main-footer">
    <div class="container max-width-adaptive-lg">
        <?php if ($this->countModules('footer')) : ?>
            <nav role="navigation">
                <jdoc:include type="modules" name="footer" style="none" />
            </nav>
        <?php endif ?>
    </div>
</footer>