<?php
namespace Devture\PimpleProvider\PhinxMigrations\Config;

use Phinx\Config\Config as PhinxConfig;

class Config extends PhinxConfig {
	/**
	 * Create a new instance of the config class using a PHP array.
	 *
	 * @param array<string, mixed> $configArray
	 * @throws \RuntimeException
	 */
	public static function fromArray(array $configArray, string $appBasePath): self {
		return new self($configArray, $appBasePath);
	}

	/**
	 * Loads the configuration from the service provider's options.
	 *
	 * @param array<string, mixed> $configOptions
	 */
	public static function loadConfig(array $configOptions): self {
		$configArr = $configOptions;
		foreach($configArr['environments'] as $environment => $environmentData){
			if(!is_array($environmentData)) {
				continue;
			}

			//If no URI is specified for an environment, consider that environment disabled.
			if ($configArr['environments'][$environment]['uri'] === null) {
				unset($configArr['environments'][$environment]);
				continue;
			}

			$matches = null;
			if (!preg_match('/^([^:]+):([^@]+)@([^\/]+)\/(.+?)$/', $configArr['environments'][$environment]['uri'], $matches)) {
				throw new \Exception('Cannot parse database URI.');
			}
			list ($_fullMatch, $dbUsername, $dbPassword, $dbHost, $dbName) = $matches;

			$dbPort = 3306;
			if (preg_match('/^([^:]+):(\d+)$/', $dbHost, $dbHostMatches)) {
				$dbHost = $dbHostMatches[1];
				$dbPort = (int) $dbHostMatches[2];
			}

			$configArr['environments'][$environment]['name'] = $dbName;
			$configArr['environments'][$environment]['host'] = $dbHost;
			$configArr['environments'][$environment]['port'] = $dbPort;
			$configArr['environments'][$environment]['user'] = $dbUsername;
			$configArr['environments'][$environment]['pass'] = $dbPassword;

			unset($configArr['environments'][$environment]['uri']);

		}
		unset($configArr['migrations_base_path']);

		return self::fromArray($configArr, $configOptions['migrations_base_path']);
	}

}
