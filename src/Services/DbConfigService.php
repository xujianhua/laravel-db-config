<?php
/**
 * Created by PhpStorm.
 * User: HavenShen
 * Date: 15/12/22
 * Time: 下午3:25
 */

namespace Jani\DbConfig\Services;

use Cache;
use HavenShen\YunpianSMS\Services\Model\Config;

class DbConfigService
{
    public function __construct()
    {
    }
    public function has($key)
    {

        list($namespace, $new_key) = $this->splitNamespaceAndKey($key);
        return Config::select(['value'])->Where("key", "=", $new_key)->Where("namespace", "=", $namespace)->first() !== null;
    }
    public function set($key, $value)
    {
        list($namespace, $new_key) = $this->splitNamespaceAndKey($key);

        if($this->has($key)){
            Config::Where("key", "=", $new_key)
                ->Where("namespace", "=", $namespace)
                ->update(['value' => $value]);
        }else{
            $config            = new Config();
            $config->namespace = $namespace;
            $config->key       = $new_key;
            $config->value     = $value;
            $config->save();
        }
        \Cache::forever($namespace . '::' .$new_key, $value);
        return $this;
    }

    public function get($key, $default = null)
    {
        if(\Cache::has($key)){
            return \Cache::get($key);
        }
        if ($this->has($key)) {
            list($namespace, $new_key) = $this->splitNamespaceAndKey($key);

            $value = Config::select(['value'])->Where("key", "=", $new_key)->Where("namespace", "=", $namespace)->first()->value;
            return $value;
        }

        return $default;
    }

    public function delete($key)
    {
        list($namespace, $new_key) = $this->splitNamespaceAndKey($key);
        Config::Where("key", "=", $new_key)
            ->Where("namespace", "=", $namespace)
            ->delete();
        Cache::forget($namespace . '::' .$new_key);
    }

    /**
     * @param string $key
     *
     * @return string[]
     */
    protected function splitNamespaceAndKey($key)
    {
        if (strpos($key, '::') !== false) {
            list($namespace, $key) = explode('::', $key, 2);
            return [$namespace, $key];
        }
        return ['', $key];
    }


}