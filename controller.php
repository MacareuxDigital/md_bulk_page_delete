<?php
/**
 * @author: Biplob Hossain <biplob.ice@gmail.com>
 */

namespace Concrete\Package\MdBulkPageDelete;

use Concrete\Core\Application\Application;
use Concrete\Core\Package\Package;
use Macareux\BulkPageDelete\Console\Command\MdPageDeleteCommand;

class Controller extends Package
{
    /**
     * @var string package handle
     */
    protected $pkgHandle = 'md_bulk_page_delete';

    /**
     * @var string required concrete5 version
     */
    protected $appVersionRequired = '8.0.0';

    /**
     * @var string package version
     */
    protected $pkgVersion = '0.0.1';

    /**
     * @var array Autoload custom classes
     */
    protected $pkgAutoloaderRegistries = [
        'src/Concrete' => '\Macareux\BulkPageDelete',
    ];

    /**
     * @return string Package name
     */
    public function getPackageName(): string
    {
        return t('Macareux Bulk Page Delete');
    }

    /**
     * @return string Package description
     */
    public function getPackageDescription(): string
    {
        return t('Delete pages and their child pages based on page path.');
    }

    public function on_start(): void
    {
        if (Application::isRunThroughCommandLineInterface()) {
            $this->registerCommands();
        }
    }

    private function registerCommands(): void
    {
        $console = $this->app->make('console');
        $console->add(new MdPageDeleteCommand());
    }
}
