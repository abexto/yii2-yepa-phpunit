<?php

/*
 * Copyright (c) 2015, Andreas Prucha, Helicon Software Development
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

namespace helicon\hcyii2\tests\phpunit\unit;

/**
 * Description of Yii2TestCaseTest
 *
 * @author Andreas Prucha, Helicon Software Development
 */
class TestCaseTest extends \helicon\hcyii2\phpunit\TestCase
{
    
    public function testAutoTearDownTrueByDefault()
    {
        $this->assertTrue($this->autoTearDownMockApplication);
    }
    
    
    public function testMockApplication()
    {
        self::mockApplication([], '\\yii\web\\Application');
        $this->assertInstanceOf('\\yii\web\\Application', \Yii::$app);
    }
    
    public function testMockWebApplication()
    {
        $this->mockWebApplication([]);
        $this->assertInstanceOf('\\yii\web\\Application', \Yii::$app);
    }
    
    public function testMockConsoleApplication()
    {
        self::mockConsoleApplication([]);
        $this->assertInstanceOf('\\yii\console\\Application', \Yii::$app);
    }
    
    public function testAutoTearDownMockApplication()
    {
        $this->assertNull(\Yii::$app);
    }
    
    public function testSetAutoTearDownToFalse1()
    {
        self::mockConsoleApplication([]);
        $this->autoTearDownMockApplication = false;
    }
    
    public function testSetAutoTearDownToFalse2()
    {
        $this->assertNotNull(\Yii::$app);
    }
    
    public function testRuntimeAliasExists()
    {
        $this->assertNotFalse(\Yii::getAlias('@runtime', false));
    }
    
    
    
    
    
    
}
