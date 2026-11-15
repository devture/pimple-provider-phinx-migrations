<?php
namespace Devture\PimpleProvider\PhinxMigrations\ConsoleCommand;

use Phinx\Console\Command\Rollback as PhinxRollback;

class Rollback extends PhinxRollback {

	use ConfigOptionsTrait;

	protected function configure(): void {
		parent::configure();

		$this->setName('migrations:rollback');
	}

}
