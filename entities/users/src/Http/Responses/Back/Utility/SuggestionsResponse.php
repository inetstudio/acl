<?php

namespace InetStudio\ACL\Users\Http\Responses\Back\Utility;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;

/**
 * Class SuggestionsResponse.
 */
class SuggestionsResponse implements SuggestionsResponseContract, Responsable
{
    /**
     * @var array
     */
    private $suggestions;

    /**
     * @var string
     */
    private $type;

    /**
     * SuggestionsResponse constructor.
     *
     * @param Collection $suggestions
     * @param string $type
     */
    public function __construct(Collection $suggestions, string $type)
    {
        $this->suggestions = $suggestions;
        $this->type = $type;
    }

    /**
     * Возвращаем подсказки.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        $resource = (app()->makeWith(
            'InetStudio\ACL\Users\Contracts\Transformers\Back\SuggestionTransformerContract', [
            'type' => $this->type,
        ]))->transformCollection($this->suggestions);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        $transformation = $manager->createData($resource)->toArray();

        if ($this->type == 'autocomplete') {
            $data['suggestions'] = $transformation['data'];
        } else {
            $data['items'] = $transformation['data'];
        }

        return response()->json($data);
    }
}
