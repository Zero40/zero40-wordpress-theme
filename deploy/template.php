<?php

/**
 * Deploy do tema
 */
return [
	'dev'     => [
		'remote'      => 'ftp://ftp.neopangea.com.br/wp-content/themes/zero40-wordpress-dev',
		'user'        => 'zero40@neopangea.com.br',
		'password'    => '=goxXTEeMebu',
		'local'       => '../',
		'test'        => true,
		'color'       => true,
		'ignore'      => '
			/.git
			/deploy
            .idea*
            README.md
            .gitignore
            /node_modules
            /sass
            package.json
            package-lock.json
		',
		'allowDelete' => true,
		'before'      => [
			function ( Deployment\Server $server, Deployment\Logger $logger, Deployment\Deployer $deployer ) {
				$logger->log( '>> Before' );
			},
		],
		'afterUpload' => [
			function ( Deployment\Server $server, Deployment\Logger $logger, Deployment\Deployer $deployer ) {
				$logger->log( '>> after upload - before renaming' );
			},
		],
		'after'       => [
			function ( Deployment\Server $server, Deployment\Logger $logger, Deployment\Deployer $deployer ) {
				$logger->log( '>> After' );
			}
		],
		'purge'       => [
//			'temp/',
		]
	],
	'log'     => __DIR__ . '/logs/plugin.log',
	'tempDir' => __DIR__ . '/temp',
	'colors'  => true,
];