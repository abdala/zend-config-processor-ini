<?php
/*
 * This file is part of the La package.
 *
 * (c) Abdala Cerqueira <abdala.cerqueira@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace La\Config\Processor;

use Zend\Config\Config;
use Zend\Config\Processor\ProcessorInterface;
use Zend\Config\Exception;

class Ini implements ProcessorInterface
{
    public function process(Config $config)
    {
        if (isset($config->phpSettings)) {
            $this->setPhpSettings($config->phpSettings);
        }
    }
    
    public function processValue($value)
    {
        throw new Exception\RuntimeException('Not implemented');
    }
    
    public function setPhpSettings(Config $settings, $prefix = null)
    {
        foreach ($settings as $key => $value) {
            $key = $prefix . $key;
            
            if (is_scalar($value)) {
                ini_set($key, $value);
            } elseif (is_array($value)) {
                $this->setPhpSettings($value, $key . '.');
            }
        }
        return $this;
    }
}