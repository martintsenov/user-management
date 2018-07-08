<?php

namespace UserManagement\Entity;

trait ExchangeArrayTrait
{
    /**
     * Fills the object's properties with the provided data
     * @param  array  $data
     * @return $this
     */
    public function exchangeArray(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
        return $this;
    }

    /**
     * Provides array of object's properties.
     * The null values have been filtered out.
     * @return array
     */
    public function toArray()
    {
        return array_filter(get_object_vars($this), function ($val) {
            return null !== $val;
        });
    }

    /**
     * Provides array of object's properties
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
