# Database Migrations services wrapped in a Pimple Service Provider

This is a [Pimple](https://github.com/silexphp/Pimple) Service Provider which provides database migrations console commands, powered by [Phinx](https://phinx.org/).


## Versions

Version 2 requires Symfony Console 8, and with it PHP 8.4 and Phinx 0.16.12 or newer (the first Phinx to support Console 8): it registers the commands with `Application::addCommand()`, as Console 8 removed `Application::add()`.
For Symfony Console 7 or older, use version 1.


## Configuration

```php
$dbMigrationsConfig = [
	'environments' => [
		'default_environment' => 'development',
		'development' => [
			'adapter' => 'mysql',
			'charset'=> 'utf8',
			'collation' => 'utf8_general_ci',
			// username:password@host[:port]/database. An environment whose uri is null is left out.
			'uri' => 'username:password@localhost/db_name',
		],
	],
	'paths' => [
		// Phinx resolves relative paths from the working directory, so an absolute path is safer.
		'migrations' => '/path/to/migrations',
	],
	// Given to Phinx as its configuration file path (Phinx's %%PHINX_CONFIG_DIR%% is its parent directory).
	'migrations_base_path' => '/path/to/app',
];
```


## Usage

```php
$container = new \Pimple\Container();

$container['console'] = function () use ($container, $dbMigrationsConfig) {
	$console = new \Symfony\Component\Console\Application();

	// Register some other console commands here

	// Register the services provided by this service provider
	$container->register(new \Devture\PimpleProvider\PhinxMigrations\ServiceProvider($dbMigrationsConfig));

	// Attach the console commands provided by this service provider with this console instance
	$container['devture_phinx_migrations.attach_commands_to_console']($console);

	return $console;
};

$container['console']->run();
```
