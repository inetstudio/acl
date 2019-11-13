<?php

namespace InetStudio\ACL\Roles\Transformers\Back\Utility;

use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\AdminPanel\Base\Transformers\BaseTransformer;
use InetStudio\ACL\Roles\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;

/**
 * Class SuggestionTransformer.
 */
class SuggestionTransformer extends BaseTransformer implements SuggestionTransformerContract
{
    /**
     * @var string
     */
    protected $type;

    /**
     * SuggestionTransformer constructor.
     *
     * @param  string  $type
     */
    public function __construct(string $type = '')
    {
        $this->type = $type;
    }

    /**
     * Подготовка данных для отображения в выпадающих списках.
     *
     * @param  RoleModelContract  $item
     *
     * @return array
     */
    public function transform(RoleModelContract $item): array
    {
        return ($this->type == 'autocomplete')
            ? [
                'value' => $item['display_name'],
                'data' => [
                    'id' => $item['id'],
                ],
            ]
            : [
                'id' => $item['id'],
                'name' => $item['display_name'],
            ];
    }
}
