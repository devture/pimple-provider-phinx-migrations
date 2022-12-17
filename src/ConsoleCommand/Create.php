<?php
namespace Devture\PimpleProvider\PhinxMigrations\ConsoleCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Phinx\Console\Command\Create as PhinxCreate;
use Devture\PimpleProvider\PhinxMigrations\Config\Config;

class Create extends PhinxCreate {

	protected $configOptions;

	public function __construct($name = null, $configOptions = null) {
		parent::__construct($name);

		$this->configOptions = $configOptions;
	}

	protected function loadConfig(InputInterface $input, OutputInterface $output): void {
		$config = Config::loadConfig($this->configOptions);

		$this->setConfig($config);
	}

	protected function configure(): void {
		parent::configure();

		$this->setName('migrations:create');
	}

}
