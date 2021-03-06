<?php

namespace InetStudio\ACL\Users\Http\Responses\Front\Social;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\RedirectToProviderResponseContract;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\SocialServiceContract;

/**
 * Class RedirectToProviderResponse.
 */
class RedirectToProviderResponse implements RedirectToProviderResponseContract
{
    /**
     * @var SocialServiceContract
     */
    protected $socialService;

    /**
     * AskEmailResponse constructor.
     *
     * @param  SocialServiceContract  $socialService
     */
    public function __construct(SocialServiceContract $socialService)
    {
        $this->socialService = $socialService;
    }

    /**
     * Возвращаем ответ при активации пользователя.
     *
     * @param  Request  $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        $data = $request->all();
        $provider = $request->route('provider', '');

        $response = $this->socialService->redirect($data, $provider);

        return $response;
    }
}
