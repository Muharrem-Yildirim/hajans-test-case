<?php

namespace MuharremYildirim\HajansTestCase\Models;

use MuharremYildirim\HajansTestCase\Core\Model;
use MuharremYildirim\HajansTestCase\Core\Container;
use MuharremYildirim\HajansTestCase\Services\FilterService;

/** 
 * @property int $id
 * @property string $name
 * @property string $description
 */
class Category extends Model
{
    protected $query = 'SELECT * FROM categories';

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
    ];
    private Product $product;
    private FilterService $filterService;

    public function __construct()
    {
        parent::__construct();
        $this->product = Container::instance()->get(Product::class);
        $this->filterService = Container::instance()->get(FilterService::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'products' => $this->product->all(
                $this->filterService->generateFilter(
                    $this->product,
                    ['category_id' => $this->id]
                )
            ),
        ];
    }
}
