<?php
namespace Devture\PimpleProvider\PhinxMigrations;

class ServiceProvider implements \Pimple\ServiceProviderInterface {

	private $config;

	public function __construct(array $config) {
		$this->config = $config;
	}

	public function register(\Pimple\Container $container) {
		$config = $this->config;

		$container['devture_phinx_migrations.console_command.create'] = function () use ($config) {
			return new ConsoleCommand\Create(null, $config);
		};

		$container['devture_phinx_migrations.console_command.migrate'] = function () use ($config) {
			return new ConsoleCommand\Migrate(null, $config);
		};

		$container['devture_phinx_migrations.console_command.rollback'] = function () use ($config) {
			return new ConsoleCommand\Rollback(null, $config);
		};

		$container['devture_phinx_migrations.console_command.status'] = function () use ($config) {
			return new ConsoleCommand\Status(null, $config);
		};

		$container['devture_phinx_migrations.console_command.test'] = function () use ($config) {
			return new ConsoleCommand\Test(null, $config);
		};

		$container['devture_phinx_migrations.attach_commands_to_console'] = function () use ($container) {
			return function (\Symfony\Component\Console\Application $application) use ($container): void {
				$application->add($container['devture_phinx_migrations.console_command.create']);
				$application->add($container['devture_phinx_migrations.console_command.migrate']);
				$application->add($container['devture_phinx_migrations.console_command.rollback']);
				$application->add($container['devture_phinx_migrations.console_command.status']);
				$application->add($container['devture_phinx_migrations.console_command.test']);
			};
		};
	}

}
