<?php
namespace Devture\PimpleProvider\PhinxMigrations\ConsoleCommand;

use Phinx\Console\Command\Status as PhinxStatus;

class Status extends PhinxStatus {

	use ConfigOptionsTrait;

	protected function configure(): void {
		parent::configure();

		$this->setName('migrations:status');
	}

}
