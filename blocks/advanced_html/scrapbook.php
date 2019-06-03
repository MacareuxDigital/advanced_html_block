<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<div id="AdvancedHTMLBlock<?=intval($bID)?>" class="advanced_html_block" style="max-height:300px; overflow:auto">
<?php echo \Concrete\Package\AdvancedHtmlBlock\Block\AdvancedHtml\Controller::xml_highlight($content); ?>
</div>
