# Database Migrations services wrapped in a Pimple Service Provider

This is a [Pimple](https://github.com/silexphp/Pimple) Service Provider which provides database migrations console commands, powered by [Phinx](https://phinx.org/).


## Configuration

```php
$dbMigrationsConfig = [
	'environments' => [
		'default_database' => 'development',
		'development' => [
			'adapter' => 'mysql',
			'charset'=> 'utf8',
			'collation' => 'utf8_general_ci',
			'uri' => 'username:password@localhost/db_name',
		],
		'paths' => [
			'migrations' => 'migrations',
		],
		'migrations_base_path' => '/path/to/migrations-directory-parent',
	],
];
```


## Usage

```php
$container = new \Pimple\Container();

$container['console'] = function () use ($container) {
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
