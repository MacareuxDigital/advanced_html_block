<?php
namespace Concrete\Package\AdvancedHtmlBlock;

use \Concrete\Core\Backup\ContentImporter;

class Controller extends \Concrete\Core\Package\Package
{
    protected $pkgHandle = 'advanced_html_block';
    protected $appVersionRequired = '5.7.5';
    protected $pkgVersion = '0.9';

    public function getPackageDescription()
    {
        return t('HTML block with sitemap and file selector.');
    }

    public function getPackageName()
    {
        return t('Advanced HTML Block');
    }

    public function install()
    {
        $pkg = parent::install();

        $ci = new ContentImporter();
        $ci->importContentFile($pkg->getPackagePath() . '/config/install.xml');
    }
}