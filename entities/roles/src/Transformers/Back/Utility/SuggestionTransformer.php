<?php

namespace InetStudio\ACL\Roles\Transformers\Back\Utility;

use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;
use InetStudio\AdminPanel\Base\Transformers\BaseTransformer;

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
     * Устанавливаем тип.
     *
     * @param  string  $type
     */
    public function setType(string $type = ''): void
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
