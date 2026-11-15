<?php
namespace Devture\PimpleProvider\PhinxMigrations\ConsoleCommand;

use Phinx\Console\Command\Migrate as PhinxMigrate;

class Migrate extends PhinxMigrate {

	use ConfigOptionsTrait;

	protected function configure(): void {
		parent::configure();

		$this->setName('migrations:migrate');
	}

}
