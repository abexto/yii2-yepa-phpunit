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
 * Description of Bootstrap
 *
 * @author Andreas Prucha, Abexto - Helicon Software Development
 */
class Bootstrap
{
    
    /**
     * Initializes the Yii environment for PhpUnit Tests
     * 
     * - yii:       Php File containing the Yii class declaration 
     *              (Default: ABEXTO_YEPA_PHPUNIT_VENDOR_DIR . '/yiisoft/yii2/Yii.php')
     * - aliases:   Associative array of alias => path pairs. The following aliases are declared by default:
     *              -     
     *              
     * 
     * @param type $params
     */
    public static function init(array $params = [])
    {
        $params = array_merge(
                [
                    'yii' => ABEXTO_YEPA_PHPUNIT_VENDOR_DIR . '/yiisoft/yii2/Yii.php',
                    'aliases' => []
                ], $params
        );
        
        require_once(ABEXTO_YEPA_PHPUNIT_VENDOR_DIR . '/yiisoft/yii2/Yii.php');
        
    }
    
}
