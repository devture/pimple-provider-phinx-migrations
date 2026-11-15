<?php
namespace Devture\PimpleProvider\PhinxMigrations\ConsoleCommand;

use Phinx\Console\Command\Create as PhinxCreate;

class Create extends PhinxCreate {

	use ConfigOptionsTrait;

	protected function configure(): void {
		parent::configure();

		$this->setName('migrations:create');
	}

}
