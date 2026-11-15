<?php
namespace Devture\PimpleProvider\PhinxMigrations\ConsoleCommand;

use Phinx\Console\Command\Test as PhinxTest;

class Test extends PhinxTest {

	use ConfigOptionsTrait;

	protected function configure(): void {
		parent::configure();

		$this->setName('migrations:test');
	}

}
