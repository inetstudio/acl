<?php

namespace InetStudio\ACL\Users\Transformers\Back\Utility;

use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;
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
     * @param UserModelContract $item
     *
     * @return array
     */
    public function transform(UserModelContract $item): array
    {
        return ($this->type == 'autocomplete')
            ? [
                'value' => $item['name'],
                'data' => [
                    'id' => $item['id'],
                ],
            ]
            : [
                'id' => $item['id'],
                'name' => $item['name'],
            ];
    }
}
