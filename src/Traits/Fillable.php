<?php

namespace MuharremYildirim\HajansTestCase\Traits;

trait Fillable
{
    /**
     * fill
     *
     * @param  array $data
     * @return self
     */
    public function fill(array $data): self
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * isFillable
     *
     * @param  string $key
     * @return boolean
     */
    public function isFillable($key): bool
    {
        if (!property_exists($this, 'fillable')) {
            return false;
        }

        return in_array($key, $this->fillable);
    }

    /**
     * getFillables
     *
     * @return array
     */
    public function getFillables(): array
    {
        if (!property_exists($this, 'fillable')) {
            return [];
        }

        $values = [];

        foreach ($this->fillable as $field) {
            if (property_exists($this, $field)) {
                $values[$field] = $this->$field;
            }
        }

        return $values;
    }

    public function setPrimaryKey($value)
    {
        $this->{$this->primaryKey} = (int)$value;

        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->{$this->primaryKey};
    }
}
