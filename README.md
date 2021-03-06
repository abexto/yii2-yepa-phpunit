Simple PHPUnit-Helper for Yii2
==============================

Andreas Prucha, [Abexto - Helicon Software Development](http://www.helicon.co.at)

** ATTENTION: UNDER DEVELOPMENT **

This Yii2-Extension provides an easy way to write PhpUnit-Tests for Yii2.

It's main purpose is to provide an easy way to create Test-Cases for Yii2-Extensions, 
but it can also be used for Yii2-Applications. 

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

**NOTE:** Currently this extension is not registered to composer, thus the git repository must be specified
in composer.json:

```
    "repositories": [
        {
            "type": "vcs",
            "url":  "https://github.com/abexto/yii2-yepa-phpunit.git"
        }
    ]
```

Add

```
"abexto/yii2-yepa-phpunit": "*"
```

to the require-dev section of your `composer.json` file.

**NOTE:** Since test-suites are usually just used in a development environment, it's recommended to use
the "require-dev" section, which just if composer is called wth the --dev option. 


How to use
------------

The following description assumes that you want to create a test-suite for your Yii2-Extension.
The following directory structure is used in this example

`lib`: All regular component classes go there
`tests`: The PHPUnit-Tests for the extension
  `unit`: Test Cases
  `_output`: Test output directory
  `bootstrap.php`: Bootstrap file for the test cases
`composer.json`: Composer file


For simple test cases create a file named `bootstrap.php` in the tests directory with the following content:

```
require_once __DIR__.'/../vendor/abexto/yii2-yepa-phpunit/autoload.php';
\abexto\yepa\phpunit\Bootstrap::init('__DIR__');

```

ATTENTION: If you use another directory structure make sure, that the path is correct.

If you want to use namespaces in your test suite, it's recommended to add the following section
to your composer.json:


```
  "autoload-dev": {
    "psr-4": {
      "myapp\tests\": "tests"
    }
  }
```

In this example composer adds the namespace `\myapp\tests\` to the autoloader.

**ATTENTION:** Do not forget to run composer update --dev to apply the autoloader for the test suite.

Create a subdirectory for the Test-Cases, e.g. `unit` and add a class file, e.g. `MyTest.php`.

Assuming the namespace of the example above, the file should look like:

```
namespace myapp\tests\unit;

class MyTest extends \abexto\yepa\phpunit\TestCase
{

  public function testFoo()
  {
  }

}
```

Inside your test case you can create a Yii2-Application mockup by calling

`$this->mockConsoleApplication($configurationArray)` or 
`$this->mockWebApplication($configurationArray)`

You need to pass an configuration-array as usually used in Yii2-Applications.

After creating an application mockup, the Yii application instance can be accessed as usual via `\Yii::$app`.

If an Yii2 Application inststance is required in all tests of the test class, it's feasible to 
override `setUpBeforeClass()`

Example:

```
namespace myapp\tests\unit;

class MyTest extends \abexto\yepa\phpunit\TestCase
{

    public function setUpBeforeClass()
    {
      $this->mockConsoleApplication([]);  // Pass your configuration here
    } 


}
```
