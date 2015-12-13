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
 * Description of MockApplicationTrait
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
trait MockApplicationTrait
{

    /**
     * Destroys the current Mock Application instance
     */
    protected function tearDownMockApplication()
    {
        \Yii::$app = null;
    }

    /**
     * Creates a Yii2 Application if necessary instance and sets Yii::$app
     * 
     * @param type $config Configuration array 
     * @param type $appClass Yii2 Application class to use
     * @param bool $recreate Set to true in order to destroy the previous instance
     * 
     * @throws \PHPUnit_Framework_Error if application mockup has already been created and $recreate is false
     */
    protected function mockApplication($config = [], $appClass, $recreate = false)
    {
        if (\Yii::$app && !$recreate) {
            throw new \PHPUnit_Framework_Error();
        }
        if ($recreate) {
            \Yii::$app = null;
        }
        new $appClass(\yii\helpers\ArrayHelper::merge([
                    'aliases' =>  Bootstrap::$aliases,
                    'id' => 'testapp',
                    'basePath' => Bootstrap::$basePath,
                    'vendorPath' => Bootstrap::$vendorPath,
                    'runtimePath' => Bootstrap::$runtimePath,
                        ], $config));
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
