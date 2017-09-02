<?php
declare(strict_types=1);
namespace Helhum\Typo3NoSymlinkInstall\Composer;

/*
 * This file is part of the TYPO3 project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Composer\Script\Event;
use Helhum\Typo3ComposerSetup\Composer\InstallerScripts\RootDirectory;
use TYPO3\CMS\Composer\Plugin\Config;
use TYPO3\CMS\Composer\Plugin\Core\InstallerScriptsRegistration;
use TYPO3\CMS\Composer\Plugin\Core\ScriptDispatcher;

/**
 * Hook into Composer build to set up TYPO3 web directory with mirror strategy
 */
class InstallerScripts implements InstallerScriptsRegistration
{
    /**
     * @param Event $event
     * @param ScriptDispatcher $scriptDispatcher
     */
    public static function register(Event $event, ScriptDispatcher $scriptDispatcher)
    {
        $composer = $event->getComposer();
        $pluginConfig = Config::load($composer);
        $rootDir = $pluginConfig->get('root-dir');

        $scriptDispatcher->addInstallerScript(
            new RootDirectory($rootDir, RootDirectory::PUBLISH_STRATEGY_MIRROR),
            90
        );
    }
}
