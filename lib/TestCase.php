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
    use MockApplicationTrait;
    
    /**
     * @var bool    The application mockup is teared down before the first test of this test case 
     */
    protected $autoTearDownMockApplicationFirst = false;

    /**
     * @var bool Yii Mock Application gets teared down after each test automatically
     */
    protected $autoTearDownMockApplication = true;
    
    /**
     * @var int Number of tests performed.
     */
    protected $testCounter = 1;
    
    /**
     * Called before the first test
     * 
     * This method is called by [[setUp]] before the first test of this TestCase is performed
     * 
     * If [[$autoTearDownMockApplicationFirst]] is set to ``true``, an already created
     * application mockup is destroyed by calling [[tearDownMockApplication]]
     */
    protected function setUpFirst()
    {
        if ($this->autoTearDownMockApplicationFirst && \Yii::$app) {
            $this->tearDownMockApplication();
        }
    }

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
        if ($this->testCounter < 2) {
            $this->setupFirst();
        }
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
        $this->testCounter++;
    }


}
