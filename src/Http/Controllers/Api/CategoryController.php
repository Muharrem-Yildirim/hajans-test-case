<?php

namespace MuharremYildirim\HajansTestCase\Http\Controllers\Api;

use Rakit\Validation\Validator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use MuharremYildirim\HajansTestCase\Core\Container;
use MuharremYildirim\HajansTestCase\Core\Logger;
use MuharremYildirim\HajansTestCase\Models\Category;
use MuharremYildirim\HajansTestCase\Http\Middlewares\BasicAuthenticationMiddleware;

class CategoryController
{
    public $middlewareBefore = [
        BasicAuthenticationMiddleware::class
    ];

    private Category $category;
    private Validator $validator;
    private Logger $logger;

    public function __construct()
    {
        $this->category = Container::instance()->get(Category::class);
        $this->validator = Container::instance()->get(Validator::class);
        $this->logger = Container::instance()->get(Logger::class);
    }

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            if ($request->query->get('includeProducts', false) == 'true') {
                $categories = $this->category->includeRelations(['products'])->all();
            } else {
                $categories = $this->category->all();
            }

            return new JsonResponse([
                'success' => true,
                'count' => count($categories),
                'data' => $categories
            ]);
        } catch (\Throwable $e) {
            $this->logger->get()->error($e);

            return new JsonResponse([
                'error' => true,
                'message' => exceptionMessage($e)
            ], 500);
        }
    }

    /**
     * show
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = $this->category->first($id);

            if (empty($category)) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Category not found.'
                ], 404);
            }

            return new JsonResponse([
                'success' => true,
                'data' => $category->toArray()
            ], 404);
        } catch (\Throwable $e) {
            $this->logger->get()->error($e);

            return new JsonResponse([
                'error' => true,
                'message' => exceptionMessage($e)
            ], 500);
        }
    }

    /**
     * delete
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $affectedRows = $this->category->delete($id);

            if ($affectedRows == 0) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Category not found.'
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

    /**
     * post
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function post(Request $request): JsonResponse
    {
        try {
            $validation = $this->validator->make($request->request->all(), [
                'name' => 'required|max:255',
                'description' => 'required',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Validation error.',
                    'errors' => $validation->errors()->toArray()
                ], 422);
            }

            $model = (new Category())->fill($validation->getValidData())->save();

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

    /**
     * put
     *
     * @param  int $id
     * @param  Request $request
     * @return JsonResponse
     */
    public function put(int $id, Request $request): JsonResponse
    {
        try {
            $validation = $this->validator->make($request->request->all(), [
                'name' => 'max:255',
                'description' => 'nullable',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Validation error.',
                    'errors' => $validation->errors()->toArray()
                ], 422);
            }

            if (!$this->category->setPrimaryKey($id)->exists()) {
                return new JsonResponse([
                    'error' => true,
                    'message' => 'Category not found.'
                ], 404);
            }

            $model = (new Category())->setPrimaryKey($id)->fill(unsetNulls($validation->getValidData()))->update();

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
