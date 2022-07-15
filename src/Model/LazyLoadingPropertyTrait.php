<?php

namespace DMT\Insolvency\Model;

trait LazyLoadingPropertyTrait
{
    public function __get($key)
    {
        if (!property_exists($this, $key)) {
            throw new \InvalidArgumentException(sprintf('%s does not exists on %s', $key, get_class($this)));
        }

        if ($this->$key instanceof \Closure) {
            $this->$key = call_user_func($this->$key);
        }

        return $this->$key;
    }
}