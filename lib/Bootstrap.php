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
 * Initializes the phpunit-environment for yii
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
class Bootstrap
{
    /**
     * @var string  Test directory. This value is set in [[init()]].
     */
    public static $testPath = null;

    /**
     * @var string  Yii application Base path  
     */
    public static $basePath = null;
    
    /**
     * @var string Runtime path
     */
    public static $runtimePath = null;
    
    /**
     * @var string Vendor path
     */
    public static $vendorPath = null;
    
    /**
     * @var array Default aliases
     */
    public static $aliases = [];
    
    /**
     * Initializes the Yii environment for PhpUnit Tests
     * 
     * - basePath       Base path used for mockup applications. This value is used for [[static::$basePath]] (Defaults to testPath)
     * - vendorPath     The directory that stores vendor files 
     *                  (Defaults to the value of the global ABEXTO_YEPA_PHPUNIT_VENDOR_DIR define)  
     * - runtimePath    Runtime directory used for tests (Defaults to "_output/runtime" in the test directory)
     * - yii:           Php File containing the Yii class declaration. If this parameter is set to
     *                  `false`, the file is *not* loaded 
     *                  (Default: '/yiisoft/yii2/Yii.php' in the vendor directory)
     * - aliases:       Associative array of alias => path pairs.
     * - yiiEnv:        Value for YII_ENV *if* not already defined (Default is `"test"`)
     * - yiiDebut       Value for YII_DEBUG *if* not already defined (Default is `true`) 
     *              -     
     * The following aliases are defined automatically if not automatically declared:
     * 
     * @param string    Test directory. If your bootstrap-file is located
     *                  in the tests root directory, pass `['testRoot' => __DIR__]`
     * @param type $params
     */
    public static function init($testPath, array $params = [])
    {
        static::$testPath = $testPath;
        
        static::$basePath = (isset($params['basePath']) ? $params['basePath'] : static::$testPath);
        static::$aliases = (isset($params['aliases']) ? $params['aliases'] : []);
        static::$vendorPath = (isset($params['vendorPath']) ? $params['vendorPath'] : ABEXTO_YEPA_PHPUNIT_VENDOR_DIR);
        static::$runtimePath = (isset($params['runtimePath']) ? $params['runtimePath'] : static::$testPath.'/_output/runtime');
        
        if (!isset($params['yii']) || $params['yii'] !== false) {
            require_once(isset($params['yii']) ? $params['yii'] : static::$vendorPath.'//yiisoft/yii2/Yii.php');
        }
    }
    
}
