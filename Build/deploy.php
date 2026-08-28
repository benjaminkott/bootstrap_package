<?php

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Deployer;

require 'recipe/common.php';

desc('Move the repository into the extension folder of the document root');
task('typo3:prepare', function () {
    cd('{{release_path}}');
    run('mkdir -p extensions/bootstrap_package');
    run('find . -mindepth 1 -maxdepth 1 -name extensions -prune -o -exec mv -t extensions/bootstrap_package {} +');
});

desc('Install the root .htaccess of the deployed TYPO3 version');
task('typo3:htaccess', function () {
    cd('{{release_path}}');
    run('cp vendor/typo3/cms-install/Resources/Private/FolderStructureTemplateFiles/root-htaccess web/.htaccess');
});

desc('Finish TYPO3 Deployment');
task('typo3:finish', function () {
    cd('{{release_path}}');
    run('{{bin/php}} ./bin/typo3 extension:setup');
    run('{{bin/php}} ./bin/typo3 cache:flush');
    run('{{bin/php}} ./bin/typo3 cache:warmup');
    run('{{bin/php}} ./bin/typo3 upgrade:run');
});

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:setup',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'typo3:prepare',
    'deploy:shared',
    'deploy:vendors',
    'typo3:htaccess',
    'deploy:symlink',
    'typo3:finish',
    'deploy:unlock',
    'deploy:cleanup',
    'deploy:success',
]);

// If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Deploy the branch that is checked out, not the default branch of the remote.
set('branch', function () {
    return runLocally('git rev-parse --abbrev-ref HEAD');
});

// The document root requires this package as dev-master from a path repository,
// and composer reads that version from the git metadata of the release. Archiving
// leaves none behind, which resolves the package as dev-main.
set('update_code_strategy', 'clone');

set('shared_dirs', [
    'config',
    'web/fileadmin',
    'web/typo3temp',
    'web/uploads',
]);
set('shared_files', [
    'composer.json',
    'web/typo3conf/AdditionalConfiguration.php',
    'web/typo3conf/LocalConfiguration.php',
    'web/typo3conf/PackageStates.php',
]);
set('writable_dirs', [
    'config',
    'web/fileadmin',
    'web/typo3temp',
    'web/typo3conf',
    'web/uploads',
]);

host(getenv('SSH_HOST'))
    ->setRemoteUser(getenv('SSH_USER'))
    ->setPort(22)
    ->setDeployPath('~/html/{{application}}')
    ->set('application', 'bootstrappackage')
    ->set('repository', 'https://github.com/benjaminkott/bootstrap_package')
    ->set('keep_releases', 2)
    ->set('bin/php', 'php')
    ->set('bin/composer', 'composer')
    ->set('http_user', getenv('SSH_USER'));
