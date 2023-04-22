<?php

namespace MuharremYildirim\HajansTestCase\Services;

class FilterService
{
    public function generateFilter($model, $params)
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
