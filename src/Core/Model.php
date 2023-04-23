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
    protected $includedRelations = [];

    /**
     * query
     *
     * @param  string $sql
     * @param  array $params
     * @return PDOStatement|false
     */
    public function query($sql, $params = []): \PDOStatement|false
    {
        $statment = $this->connection->prepare($sql);
        $statment->execute($params);
        return $statment;
    }

    /**
     * first
     *
     * @param  int $id
     * @return Model|null
     */
    public function first(int $id): Model|null
    {
        $statment = $this->query(sprintf(
            '%s WHERE `%s`.`%s` = :id',
            $this->query,
            $this->table,
            $this->primaryKey
        ), ['id' => $id]);

        $result = $statment->fetch();

        if ($result == false) {
            return null;
        }

        $model = (new static())->setPrimaryKey($id)->fill($result);

        return $model;
    }

    /**
     * all
     *
     * @param  array $filter
     * @return array
     */
    public function all(array $filter = []): array
    {
        $keys =  array_keys($filter);
        $sql = $this->query;

        if (!empty($filter)) {
            $sql .= ' WHERE ' . implode(' AND ', array_map(function ($key) use ($filter) {
                return $filter[$key];
            }, $keys));
        }

        $statment = $this->query($sql);

        $models = [];

        foreach ($statment->fetchAll() as $model) {
            $models[] = (new static())->setPrimaryKey($model[$this->primaryKey])->fill($model)
                ->includeRelations($this->includedRelations)->toArray();
        }

        return $models;
    }

    /**
     * save
     *
     * @return Model|null
     */
    public function save(): Model|null
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

    /**
     * update
     *
     * @return Model|null
     */
    public function update(): Model|null
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

    /**
     * delete
     *
     * @param  int $id
     * @return int
     */
    public function delete(int $id): int
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

    /**
     * exists
     *
     * @return bool
     */
    public function exists(): bool
    {
        return $this->first($this->{$this->primaryKey}) != null;
    }

    /**
     * reload
     *
     * @return Model|null
     */
    public function reload(): Model|null
    {
        return $this->first($this->getPrimaryKey());
    }

    /**
     * toArray
     *
     * @return Model|array
     */
    public function toArray(): Model|array
    {
        return $this;
    }

    /**
     * filterables
     *
     * @return array
     */
    public function filterables(): array
    {
        return [];
    }

    /**
     * includeRelations
     *
     * @param  array $relations
     * @return Model|null
     */
    public function includeRelations(array $relations): Model|null
    {
        $this->includedRelations = array_merge($this->includedRelations, $relations);

        return $this;
    }

    /**
     * isRelationExist
     *
     * @param  string $relation
     * @return bool
     */
    public function isRelationExist(string $relation): bool
    {
        return in_array($relation, $this->includedRelations);
    }
}
