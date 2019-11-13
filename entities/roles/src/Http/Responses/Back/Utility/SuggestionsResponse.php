<?php

namespace InetStudio\ACL\Roles\Http\Responses\Back\Utility;

use League\Fractal\Manager;
use Illuminate\Http\Request;
use InetStudio\ACL\Roles\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\AdminPanel\Base\Contracts\Serializers\SimpleDataArraySerializerContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
use InetStudio\ACL\Roles\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;

/**
 * Class SuggestionsResponse.
 */
class SuggestionsResponse implements SuggestionsResponseContract
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
     * Возвращаем подсказки для поля.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $search = $request->get('q', '') ?? '';
        $type = $request->get('type', '') ?? '';

        $items = $this->utilityService->getSuggestions($search);

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
