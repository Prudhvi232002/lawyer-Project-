<?php

namespace lawadvisor\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use lawadvisor\LaravelInstaller\Events\LaravelInstallerFinished;
use lawadvisor\LaravelInstaller\Helpers\EnvironmentManager;
use lawadvisor\LaravelInstaller\Helpers\FinalInstallManager;
use lawadvisor\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param \lawadvisor\LaravelInstaller\Helpers\InstalledFileManager $fileManager
     * @param \lawadvisor\LaravelInstaller\Helpers\FinalInstallManager $finalInstall
     * @param \lawadvisor\LaravelInstaller\Helpers\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelInstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
