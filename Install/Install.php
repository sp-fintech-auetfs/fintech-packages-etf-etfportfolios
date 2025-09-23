<?php

namespace Apps\Fintech\Packages\Etf\Portfolios\Install;

use Apps\Fintech\Packages\Etf\Portfolios\Install\Schema\EtfPortfolios;
use Apps\Fintech\Packages\Etf\Portfolios\Install\Schema\EtfPortfoliosPerformancesChunks;
// use Apps\Fintech\Packages\Etf\Portfolios\Install\Schema\EtfPortfoliosStrategies;
use Apps\Fintech\Packages\Etf\Portfolios\Model\AppsFintechEtfPortfolios;
use Apps\Fintech\Packages\Etf\Portfolios\Model\AppsFintechEtfPortfoliosPerformancesChunks;
// use Apps\Fintech\Packages\Etf\Portfolios\Model\AppsFintechEtfPortfoliosStrategies;
use System\Base\BasePackage;
use System\Base\Providers\ModulesServiceProvider\DbInstaller;

class Install extends BasePackage
{
    protected $databases;

    protected $dbInstaller;

    public function init()
    {
        $this->databases =
            [
                'apps_fintech_etf_portfolios'  => [
                    'schema'        => new EtfPortfolios,
                    'model'         => new AppsFintechEtfPortfolios
                ],
                // 'apps_fintech_etf_portfolios_strategies'  => [
                //     'schema'        => new EtfPortfoliosStrategies,
                //     'model'         => new AppsFintechEtfPortfoliosStrategies
                // ],
                'apps_fintech_etf_portfolios_performances_chunks'  => [
                    'schema'        => new EtfPortfoliosPerformancesChunks,
                    'model'         => new AppsFintechEtfPortfoliosPerformancesChunks
                ]
            ];

        $this->dbInstaller = new DbInstaller;

        return $this;
    }

    public function install()
    {
        $this->preInstall();

        $this->installDb();

        $this->postInstall();

        return true;
    }

    protected function preInstall()
    {
        return true;
    }

    public function installDb()
    {
        $this->dbInstaller->installDb($this->databases);

        return true;
    }

    public function postInstall()
    {
        //Do anything after installation.
        return true;
    }

    public function truncate()
    {
        $this->dbInstaller->truncate($this->databases);
    }

    public function uninstall($remove = false)
    {
        if ($remove) {
            //Check Relationship
            //Drop Table(s)
            $this->dbInstaller->uninstallDb($this->databases);
        }

        return true;
    }
}