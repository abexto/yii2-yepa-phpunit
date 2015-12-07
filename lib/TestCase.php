<?php

/*
 * Copyright (c) 2015, Andreas Prucha, Abexto - Helicon Software Development
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace abexto\yepa\phpunit;

/**
 * Base PHP-Unit TestCase for Yii2 Applications
 * 
 * Yii2 Application Mockups can be created by calling {@link mockApplication()}
 * 
 * In order to initialize a mock application automatically, you can set {@link $autoSetUpMockApplication} to 
 * <code>true</code> and override {@link setUpMockApplication()}
 * 
 * if {@link $autoTearDownMockApplication} is set to <code>true</code>, the Yii mock application will
 * be destroyed after every test. 
 *
 * @author Andreas Prucha, Helicon Software Development
 */
class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var bool Yii Mock Application gets teared down after each test automatically
     */
    protected $autoTearDownMockApplication = true;

    /**
     * Called before each test for preparation
     * 
     * <b>Hint:</b>
     * If a Yii mock application is required in all tests, it can be set up here by calling
     * <code>
     * <?php
     * if (!\Yii::$app) {
     *     $this->mockConsoleApplication([/* Your config array{@*}/]);
     * }
     * ?>
     * </code>
     * 
     * If {@link $autoTearDownMockApplication} is set to true, the mock application instance will
     * be destroyed after each test.
     * 
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * {@inheritDoc}
     * 
     * Automatically destroys the Yii mock application if {@link $autoTearDownMockApplication} is set to <code>TRUE</code>
     * 
     */
    protected function tearDown()
    {
        if ($this->autoTearDownMockApplication) {
            $this->tearDownMockApplication();
        }
        parent::tearDown();
    }

    /**
     * Returns the default configuration for all Yii mock applications
     */
    protected function getMockApplicationDefaultConfig()
    {
        if (!defined('ABEXTO_YEPA_PHPUNIT_TEST_DIR'))
        {
            throw new \Exception('ABEXTO_YEPA_PHPUNIT_TEST_DIR is not defined');
        }
        return [
            'id' => 'testapp',
            'basePath' => ABEXTO_YEPA_PHPUNIT_TEST_DIR,
            'vendorPath' => ABEXTO_YEPA_PHPUNIT_VENDOR_DIR,
            'runtimePath' => ABEXTO_YEPA_PHPUNIT_TEST_DIR.'/_output/runtime',
            'aliases' => [
                '@testsroot' => ABEXTO_YEPA_PHPUNIT_TEST_DIR,
            ]
        ];
    }

    /**
     * Destroys the current Mock Application instance
     */
    protected function tearDownMockApplication()
    {
        \Yii::$app = null;
    }

    /**
     * Override this function in order to let {@link setUp()} create a Yii Mock Application
     * 
     * <b>Example:</b>
     * <pre>
     * <code>
     *      protected function setUpMockApplication()
     *      {
     *          self::mockConsoleApplication($myConfigurationArray);
     *      }
     * </code>
     * </pre>
     */
    protected function setUpMockApplication()
    {
        $this->fail('Override ' . __CLASS__ . '::' . __METHOD__);
    }

    /**
     * Creates a Yii2 Application if necessary instance and sets Yii::$app
     * 
     * @param type $config Configuration array 
     * @param type $appClass Yii2 Application class to use
     * @param bool $recreate Set to true in order to destroy the previous instance
     */
    protected function mockApplication($config = [], $appClass, $recreate = false)
    {
        if (\Yii::$app && !$recreate) {
            $this->fail('Yii mock application is already initialized');
        }
        if ($recreate) {
            \Yii::$app = null;
        }
        new $appClass(\yii\helpers\ArrayHelper::merge($this->getMockApplicationDefaultConfig(), $config));
    }

    /**
     * Creates a Yii2 Web Application if necessary instance and sets Yii::$app
     * 
     * @param type $config
     * @param bool $recreate Set to true in order to destroy the previous instance
     */
    protected function mockWebApplication($config = [], $recreate = false)
    {
        $this->mockApplication($config, '\yii\web\Application', $recreate);
    }

    /**
     * Creates a Yii2 Console Application if necessary instance and sets Yii::$app
     * 
     * @param type $config
     * @param bool $recreate Set to true in order to destroy the previous instance
     */
    protected function mockConsoleApplication($config = [], $recreate = false)
    {
        $this->mockApplication($config, '\yii\console\Application', $recreate);
    }

}
