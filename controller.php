<?php
namespace Concrete\Package\AdvancedHtmlBlock;

use Concrete\Core\Backup\ContentImporter;
use Concrete\Core\Package\PackageService;

class Controller extends \Concrete\Core\Package\Package
{
    protected $pkgHandle = 'advanced_html_block';
    protected $appVersionRequired = '9.0.0';
    protected $pkgVersion = '1.1';

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

    public function on_after_packages_start()
    {
        $app = $this->app;
        // Make it enable to import contents via Migration Tool
        $packageService = $app->make(PackageService::class);
        $migrationToolPackage = $packageService->getByHandle('migration_tool');
        if (is_object($migrationToolPackage) && $migrationToolPackage->isPackageInstalled()) {
            $blockPublisherManager = $this->app->make('migration/manager/publisher/block');
            if (is_object($blockPublisherManager)) {
                $blockPublisherManager->extend('advanced_html', function () use ($app) {
                    return $app->make('PortlandLabs\Concrete5\MigrationTool\Publisher\Block\ContentPublisher');
                });
            }
        }
    }
}