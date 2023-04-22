<?php

namespace MuharremYildirim\HajansTestCase\Models;

use MuharremYildirim\HajansTestCase\Core\Model;

/** 
 * @property int $id
 * @property int $product_id
 * @property int $stock_count
 */
class Stock extends Model
{
    protected $query = 'SELECT * FROM stocks';

    protected $table = 'stocks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'stock_count'
    ];

    public function save()
    {
        $this->query(
            'INSERT INTO stocks (product_id, stock_count) VALUES (:product_id, :stock_count) 
                ON DUPLICATE KEY UPDATE stock_count = VALUES(`stock_count`)',
            [
                'product_id' => $this->product_id,
                'stock_count' => empty($this->stock_count) ? 0 : $this->stock_count
            ]
        );
    }
}
