<?php

namespace InetStudio\ACL\Users\Http\Responses\Back\Utility;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use InetStudio\AdminPanel\Base\Contracts\Serializers\SimpleDataArraySerializerContract;
use InetStudio\ACL\Users\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
use League\Fractal\Manager;
use InetStudio\ACL\Users\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;

/**
 * Class SuggestionsResponse.
 */
class SuggestionsResponse implements SuggestionsResponseContract, Responsable
{
    /**
     * @var UtilityServiceContract
     */
    protected $utilityService;

    /**
     * @var SuggestionTransformerContract
     */
    protected $transformer;

    /**
     * @var SimpleDataArraySerializerContract
     */
    protected $serializer;

    /**
     * CreateResponse constructor.
     *
     * @param  UtilityServiceContract  $utilityService
     * @param  SuggestionTransformerContract  $transformer
     * @param  SimpleDataArraySerializerContract  $serializer
     */
    public function __construct(
        UtilityServiceContract $utilityService,
        SuggestionTransformerContract $transformer,
        SimpleDataArraySerializerContract $serializer
    ) {
        $this->utilityService = $utilityService;
        $this->transformer = $transformer;
        $this->serializer = $serializer;
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
        $search = $request->get('q', '') ?? '';
        $type = $request->get('type', '') ?? '';
        $roles = $request->get('roles', []) ?? [];

        $items = $this->utilityService->getSuggestions($search, $roles);

        $this->transformer->setType($type);
        $resource = $this->transformer->transformCollection($items);

        $manager = new Manager();
        $manager->setSerializer($this->serializer);

        $transformation = $manager->createData($resource)->toArray();

        $data = [
            'suggestions' => [],
            'items' => [],
        ];

        if ($type == 'autocomplete') {
            $data['suggestions'] = $transformation;
        } else {
            $data['items'] = $transformation;
        }

        return response()->json($data);
    }
}
