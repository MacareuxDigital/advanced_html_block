<?php
defined('C5_EXECUTE') or die("Access Denied.");
$content = $content ?? null;
?>

<p>
    <button id="ccm-block-advanced-html-page-selector" type="button" class="btn btn-primary btn-xs"><?php echo t('Insert Page Link'); ?></button>
    <button id="ccm-block-advanced-html-inline-file-selector" type="button" class="btn btn-primary btn-xs"><?php echo t('Insert File Inline Link'); ?></button>
    <button id="ccm-block-advanced-html-download-file-selector" type="button" class="btn btn-primary btn-xs"><?php echo t('Insert File Download Link'); ?></button>
    <button id="ccm-block-advanced-html-base-url" type="button" class="btn btn-primary btn-xs"><?php echo t('Insert Base URL'); ?></button>
</p>
<div id="ccm-block-advanced-html-value"><?=htmlspecialchars($content,ENT_QUOTES,APP_CHARSET)?></div>
<textarea style="display: none" id="ccm-block-advanced-html-value-textarea" name="content"></textarea>

<style type="text/css">
    #ccm-block-advanced-html-value {
        width: 100%;
        border: 1px solid #eee;
        height: 490px;
    }
</style>

<script type="text/javascript">
    $(function() {
        var editor = ace.edit("ccm-block-advanced-html-value");
        editor.setTheme("ace/theme/eclipse");
        editor.getSession().setMode("ace/mode/html");
        refreshTextarea(editor.getValue());
        editor.getSession().on('change', function() {
            refreshTextarea(editor.getValue());
        });
        
        $('#ccm-block-advanced-html-page-selector').on('click', function() {
            ConcretePageAjaxSearch.launchDialog(function(data) {
                editor.insert('{CCM:CID_' + data.cID + '}');
            });
        });
        
        $('#ccm-block-advanced-html-inline-file-selector').on('click', function() {
            ConcreteFileManager.launchDialog(function(data) {
                editor.insert('{CCM:FID_' + data.fID + '}');
            });
        });

        $('#ccm-block-advanced-html-download-file-selector').on('click', function() {
            ConcreteFileManager.launchDialog(function(data) {
                ConcreteFileManager.getFileDetails(data.fID, function(r) {
                    jQuery.fn.dialog.hideLoader();
                    var file = r.files[0];
                    editor.insert(file.urlDownload);
                })
                
            });
        });

        $('#ccm-block-advanced-html-base-url').on('click', function() {
            editor.insert('{CCM:BASE_URL}');
        });
    });

    function refreshTextarea(contents) {
      $('#ccm-block-advanced-html-value-textarea').val(contents);
    }
</script>
