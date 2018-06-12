<?php

namespace InetStudio\ACL\Permissions\Transformers\Back;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Transformers\Back\SuggestionTransformerContract;

/**
 * Class SuggestionTransformer.
 */
class SuggestionTransformer extends TransformerAbstract implements SuggestionTransformerContract
{
    /**
     * @var string
     */
    private $type;

    /**
     * SuggestionTransformer constructor.
     *
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Подготовка данных для отображения в выпадающих списках.
     *
     * @param PermissionModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(PermissionModelContract $item): array
    {
        if ($this->type && $this->type == 'autocomplete') {
            return [
                'value' => $item->display_name,
                'data' => [
                    'id' => $item->id,
                ],
            ];
        } else {
            return [
                'id' => $item->id,
                'name' => $item->display_name,
            ];
        }
    }

    /**
     * Обработка коллекции объектов.
     *
     * @param $items
     *
     * @return FractalCollection
     */
    public function transformCollection($items): FractalCollection
    {
        return new FractalCollection($items, $this);
    }
}
