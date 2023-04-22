<?php

namespace MuharremYildirim\HajansTestCase\Http\Controllers\Api;

use Exception;
use Rakit\Validation\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use MuharremYildirim\HajansTestCase\Core\Container;
use MuharremYildirim\HajansTestCase\Core\Logger;
use MuharremYildirim\HajansTestCase\Models\Product;
use MuharremYildirim\HajansTestCase\Models\Category;
use MuharremYildirim\HajansTestCase\Services\FilterService;
use MuharremYildirim\HajansTestCase\Http\Middlewares\BasicAuthenticationMiddleware;

class ProductController
{
    public $middlewareBefore = [
        BasicAuthenticationMiddleware::class
    ];

    private Product $product;
    private Category $category;
    private Validator $validator;
    private FilterService $filterService;
    private Logger $logger;

    public function __construct()
    {
        $this->product = Container::instance()->get(Product::class);
        $this->category = Container::instance()->get(Category::class);
        $this->validator = Container::instance()->get(Validator::class);
        $this->filterService = Container::instance()->get(FilterService::class);
        $this->logger = Container::instance()->get(Logger::class);
    }

    public function index(Request $request)
    {
        try {
            $filter = $this->filterService->generateFilter($this->product, $request->query->all());

            $products = $this->product->all($filter);

            return new JsonResponse([
                'success' => true,
                'count' => count($products),
                'data' => $products
            ]);
        } catch (\Throwable $e) {
            $this->logger->get()->error(json_encode($request->request->all()));
            $this->logger->get()->error($e);

            return new JsonResponse([
                'error' => true,
                'message' => exceptionMessage($e)
            ], 500);
        }
    }

    public function show($id)
    {
        try {

            $product = $this->product->first($id);

            if (empty($product)) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Product not found.'
                ], 404);
            }

            return new JsonResponse([
                'success' => true,
                'data' => $product->toArray()
            ], 404);
        } catch (\Throwable $e) {
            $this->logger->get()->error($e);

            return new JsonResponse([
                'error' => true,
                'message' => exceptionMessage($e)
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $affectedRows = $this->product->delete($id);

            if ($affectedRows == 0) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Product not found.'
                ], 404);
            }

            return new JsonResponse([
                'success' => true,
            ], 204);
        } catch (\Throwable $e) {
            $this->logger->get()->error($e);

            return new JsonResponse([
                'error' => true,
                'message' => exceptionMessage($e)
            ], 500);
        }
    }

    public function post(Request $request)
    {
        try {
            $validation = $this->validator->make($request->request->all(), [
                'name' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required|numeric|in:' . implode(
                    ',',
                    array_column($this->category->all(), 'id')
                ),
                'price' => 'required|numeric',
                'image_url' => 'nullable|url',
                'color' => 'required|max:255',
                'size' => 'required|max:255',
                'weight' => 'required|numeric',
                'stock_count' => 'numeric|default:0',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Validation error.',
                    'errors' => $validation->errors()->toArray()
                ], 422);
            }

            $model = (new Product())->fill($validation->getValidData())->save();

            return new JsonResponse([
                'success' => true,
                'data' => $model->reload()->toArray()
            ], 200);
        } catch (\Throwable $e) {
            $this->logger->get()->error(json_encode($request->request->all()));
            $this->logger->get()->error($e);

            return new JsonResponse([
                'error' => true,
                'message' => exceptionMessage($e)
            ], 500);
        }
    }

    public function put($id, Request $request)
    {
        try {
            $validation = $this->validator->make($request->request->all(), [
                'name' => 'max:255',
                'description' => 'nullable',
                'category_id' => 'required|numeric|in:' . implode(
                    ',',
                    array_column($this->category->all(), 'id')
                ),
                'price' => 'numeric',
                'image_url' => 'url',
                'color' => 'max:255',
                'size' => 'max:255',
                'weight' => 'numeric',
                'stock_count' => 'numeric',

            ]);

            $validation->validate();

            if ($validation->fails()) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Validation error.',
                    'errors' => $validation->errors()->toArray()
                ], 422);
            }

            $model = (new Product())->setPrimaryKey($id)->fill(unsetNulls($validation->getValidData()))->update();

            if (is_null($model)) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Product not found.'
                ], 404);
            }

            return new JsonResponse([
                'success' => true,
                'data' => $model->reload()->toArray()
            ], 200);
        } catch (\Throwable $e) {
            $this->logger->get()->error(json_encode($request->request->all()));
            $this->logger->get()->error($e);

            return new JsonResponse([
                'error' => true,
                'message' => exceptionMessage($e)
            ], 500);
        }
    }
}
