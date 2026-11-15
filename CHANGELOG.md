# (2026-11-15) Version 2.0.0

- Requires Symfony Console 8 (removed `Application::add()`; the commands are registered with `addCommand()`), and with it PHP 8.4 and Phinx 0.16.12 or newer. Use version 1 with Symfony Console 7 or older.
- The commands' constructors are now `__construct(?string $name, array $configOptions)`: both arguments are required (the service provider passes them, so typical usage is unchanged).
- `Config::fromArray()` and `Config::loadConfig()` now always return a `Config` (`new self`), even when called on a subclass, whose constructor and overrides they no longer use.
- Types throughout.

# (2022-12-17) Version 1

Initial release based on [devture/silex-db-migrations-bundle](https://github.com/devture/silex-db-migrations-bundle)
