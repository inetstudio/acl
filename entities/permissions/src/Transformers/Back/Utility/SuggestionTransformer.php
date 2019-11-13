<?php

namespace InetStudio\ACL\Permissions\Transformers\Back\Utility;

use InetStudio\AdminPanel\Base\Transformers\BaseTransformer;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;

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
     * @param  PermissionModelContract  $item
     *
     * @return array
     */
    public function transform(PermissionModelContract $item): array
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
