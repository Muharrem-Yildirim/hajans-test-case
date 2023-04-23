<?php

namespace MuharremYildirim\HajansTestCase\Models;

use MuharremYildirim\HajansTestCase\Core\Model;
use MuharremYildirim\HajansTestCase\Enums\StockStatus;

/** 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $category_id
 * @property string $category
 * @property double $price
 * @property string $image_url
 * @property string $color
 * @property string $size
 * @property string $weight
 * @property int $stock_count
 */
class Product extends Model
{
    protected $query = 'SELECT products.*, ifnull(stock_count,0) as stock_count, categories.name as `category` FROM products 
        LEFT JOIN stocks ON products.id = stocks.product_id
        LEFT JOIN categories ON products.category_id = categories.id';

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'image_url',
        'color',
        'size',
        'weight',
        'stock_count',
    ];

    /**
     * updateStock
     *
     * @param  int|null $stock
     * @return Stock|null
     */
    private function updateStock(int|null $stock): Stock|null
    {
        return (new Stock())->fill([
            'product_id' => $this->id,
            'stock_count' => $stock
        ])->save();
    }

    /**
     * save
     *
     * @return Product|null
     */
    public function save(): Product|null
    {
        $stock = null;

        if (isset($this->stock_count)) {
            $stock = $this->stock_count;
            unset($this->stock_count);
        }

        parent::save();

        if (!is_null($stock)) {
            $this->updateStock($stock);
        }

        return $this;
    }

    /**
     * update
     *
     * @return Product|null
     */
    public function update(): Product|null
    {
        return $this->save();
    }

    /**
     * filterables
     *
     * @return array
     */
    public function filterables(): array
    {
        return [
            'name' => [
                'column' => 'products.name',
                'value' => function ($value) {
                    return sprintf('products.name LIKE \'%s\'', $value);
                }
            ],
            'description' => [
                'column' => 'products.description',
                'value' => function ($value) {
                    return sprintf('products.description LIKE \'%s\'', $value);
                }
            ],
            'color' => [
                'column' => 'products.color',
                'value' => function ($value) {
                    return sprintf('products.color LIKE \'%s\'', $value);
                }
            ],
            'image_url' => [
                'column' => 'products.image_url',
                'value' => function ($value) {
                    return sprintf('products.image_url LIKE \'%s\'', $value);
                }
            ],
            'size' => [
                'column' => 'products.size',
                'value' => function ($value) {
                    return sprintf('products.size LIKE \'%s\'', $value);
                }
            ],
            'weight' => [
                'column' => 'products.weight',
                'value' => function ($value) {
                    return sprintf('products.weight LIKE \'%s\'', $value);
                }
            ],
            'category' => [
                'column' => 'categories.name',
                'value' => function ($value) {
                    return sprintf('categories.name LIKE \'%s\'', $value);
                }
            ],
            'category_id' => [
                'column' => 'categories.id',
                'value' => function ($value) {
                    return sprintf('categories.id = \'%s\'', $value);
                }
            ],
            'stock' => [
                'column' => 'stocks.stock_count',
                'value' => function ($value) {
                    return sprintf('stocks.stock_count = \'%s\'', $value);
                }
            ],
            'stock_status' => [
                'column' => 'stocks.stock_count',
                'value' => function ($value) {
                    if ($value == StockStatus::IN_STOCK) {
                        return 'stocks.stock_count > 0';
                    } else if ($value == StockStatus::LOW_STOCK) {
                        return 'stocks.stock_count <= 5';
                    } else if ($value == StockStatus::OUT_OF_STOCK) {
                        return 'stocks.stock_count <= 0';
                    }

                    return '';
                }
            ],
        ];
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category,
            ],
            'price' => $this->price,
            'image_url' => $this->image_url,
            'color' => $this->color,
            'size' => $this->size,
            'weight' => $this->weight,
            'stock' => $this->stock_count,
        ];
    }
}
