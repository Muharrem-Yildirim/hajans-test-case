<?php

namespace MuharremYildirim\HajansTestCase\Core;

use MuharremYildirim\HajansTestCase\Traits\Fillable;

class Model extends MySQL
{
    use Fillable;

    protected $table = null;
    protected $query = null;
    protected $primaryKey = 'id';
    protected $fillable = [];

    public function query($sql, $params = [])
    {
        $statment = $this->connection->prepare($sql);
        $statment->execute($params);
        return $statment;
    }

    public function first($id)
    {
        $statment = $this->query(sprintf(
            '%s WHERE `%s`.`%s` = :id',
            $this->query,
            $this->table,
            $this->primaryKey
        ), ['id' => $id]);

        $model = (new static())->setPrimaryKey($id)->fill($statment->fetch());
        return $model;
    }

    public function all($filter = [])
    {
        $keys =  array_keys($filter);
        $sql = $this->query;

        if (!empty($filter)) {
            $sql .= ' WHERE ' . implode(' AND ', array_map(function ($key) use ($filter) {
                return $filter[$key];
            }, $keys));
        }

        $statment = $this->query($sql);

        $products = [];

        foreach ($statment->fetchAll() as $product) {
            $products[] = (new static())->setPrimaryKey($product['id'])->fill($product)->toArray();
        }

        return $products;
    }

    public function save()
    {
        if (property_exists($this, $this->primaryKey) && !empty($this->{$this->primaryKey})) {
            return self::update();
        }

        $keys =  implode(',', array_keys($this->getFillables()));
        $values = array_values($this->getFillables());

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            $keys,
            implode(',', array_fill(0, count(array_values($this->getFillables())), '?'))
        );

        $statment = $this->connection->prepare($sql);
        $statment->execute($values);

        $id = $this->connection->lastInsertId();
        $this->{$this->primaryKey} = (int)$id;

        return $this;
    }

    public function update()
    {
        $keys =  array_keys($this->getFillables());
        $values = array_values($this->getFillables());

        $sql = sprintf(
            'UPDATE %s SET %s WHERE `%s`.`%s` = ?',
            $this->table,
            implode(', ', array_map(function ($key) {
                return $key . '=?';
            }, $keys)),
            $this->table,
            $this->primaryKey
        );
        $statment = $this->connection->prepare($sql);
        $statment->execute(array_merge($values, [
            $this->getPrimaryKey()
        ]));

        return $this;
    }

    public function delete($id)
    {
        $sql = sprintf(
            'DELETE FROM %s WHERE `%s`.`%s` = :id',
            $this->table,
            $this->table,
            $this->primaryKey,
        );

        $statment = $this->connection->prepare($sql);
        $statment->execute(['id' => $id]);

        return $statment->rowCount();
    }

    public function reload()
    {
        return $this->first($this->getPrimaryKey());
    }

    public function toArray()
    {
        return $this;
    }
}
