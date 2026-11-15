<?php
namespace Devture\PimpleProvider\PhinxMigrations\ConsoleCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Devture\PimpleProvider\PhinxMigrations\Config\Config;

/**
 * Makes a Phinx command load its configuration from the service provider's options,
 * instead of from a configuration file.
 */
trait ConfigOptionsTrait {

	/** @var array<string, mixed> */
	protected array $configOptions;

	/**
	 * @param array<string, mixed> $configOptions
	 */
	public function __construct(?string $name, array $configOptions) {
		parent::__construct($name);

		$this->configOptions = $configOptions;
	}

	protected function loadConfig(InputInterface $input, OutputInterface $output): void {
		$config = Config::loadConfig($this->configOptions);

		$this->setConfig($config);
	}

}
