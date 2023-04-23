<?php

namespace MuharremYildirim\HajansTestCase\Services;

use MuharremYildirim\HajansTestCase\Core\Model;

class FilterService
{
    /**
     * generateFilter
     *
     * @param  Model $model
     * @param  array $params
     * @return array
     */
    public function generateFilter(Model $model, array $params): array
    {
        $filter = [];

        $filterables = $model->filterables();

        foreach ($params as $key => $value) {
            if (array_key_exists($key, $filterables)) {
                if (is_callable($filterables[$key]['value'])) {
                    $value = $filterables[$key]['value']($value);
                }

                if (!empty($value)) {
                    $filter[$filterables[$key]['column']] = $value;
                }
            }
        }

        return $filter;
    }
}
