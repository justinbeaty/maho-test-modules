# Maho Test Modules

Small modules for testing various functions of Maho Commerce. Powered by [Satis](https://github.com/composer/satis).

[Visit the repository homepage!](https://justinbeaty.github.io/maho-test-modules/)

## Usage

First enable this repository with the following command:

```sh
composer config repositories.maho-test-modules composer https://justinbeaty.github.io/maho-test-modules/
```

Or manually by adding to your composer.json:

```json
{
    "name": "your/project",
    "repositories": [
        { "type": "composer", "url": "https://justinbeaty.github.io/maho-test-modules/" }
    ]
}
```

Then you can require any of the modules:

```sh
composer require basic/mod
```

## Building

To build the Satis frontend, run:

```sh
composer run-script build
```
