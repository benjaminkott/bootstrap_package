<?php

namespace Deployer;

/*
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2015 Benjamin Kott, http://www.bk2k.info
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 */

require 'recipe/common.php';

// TYPO3
desc('Prepare Bootstrap Package');
task('typo3:prepare', function () {
    run('rm -rf {{release_path}}/../tmp');
    run('mkdir -p {{release_path}}/../tmp/extensions/bootstrap_package');
    run('mv {{release_path}}/{,.[^.]}* {{release_path}}/../tmp/extensions/bootstrap_package');
    run('mkdir -p {{release_path}}/extensions');
    run('mv {{release_path}}/../tmp/extensions {{release_path}}');
    run('rm -rf {{release_path}}/../tmp');
});
desc('Finish TYPO3 Deployment');
task('typo3:finish', function () {
    run('cd {{release_path}} && {{bin/php}} ./bin/typo3cms install:fixfolderstructure');
    run('cd {{release_path}} && {{bin/php}} ./bin/typo3cms database:updateschema');
    run('cd {{release_path}} && {{bin/php}} ./bin/typo3cms language:update');
    run('cd {{release_path}} && {{bin/php}} ./bin/typo3cms cache:flush');
});

// Main
 task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'typo3:prepare',
    'deploy:shared',
    'deploy:vendors',
    'deploy:symlink',
    'typo3:finish',
    'deploy:unlock',
    'cleanup',
])->desc('Deploy your project');
after('deploy', 'success');

// Shared Directories and Files
set('shared_dirs', [
    'web/fileadmin',
    'web/typo3temp',
    'web/uploads'
]);
set('shared_files', [
    'composer.json',
    'web/.htaccess',
    'web/typo3conf/LocalConfiguration.php',
    'web/typo3conf/PackageStates.php'
]);

// Set Writeable files
set('writable_dirs', [
    'web/fileadmin',
    'web/typo3temp',
    'web/typo3conf',
    'web/uploads'
]);

// Misc
set('allow_anonymous_stats', false);

// Hosts
host(getenv('DEPLOYER_HOST'))
    ->set('repository', 'https://github.com/benjaminkott/bootstrap_package')
    ->user(getenv('DEPLOYER_USER'))
    ->port('22')
    ->set('keep_releases', '3')
    ->set('bin/php', getenv('DEPLOYER_PHP'))
    ->set('deploy_path', '~/html/{{application}}')
    ->set('application', getenv('DEPLOYER_APPLICATION'))
    ->set('ssh_type', 'native')
    ->set('http_user', getenv('DEPLOYER_USER'))
    ->set('bin/composer', getenv('DEPLOYER_COMPOSER'));
