<?php

namespace InetStudio\ACL\Users\Http\Responses\Front\Social;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\SocialServiceContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\AskEmailResponseContract;

/**
 * Class RedirectToProviderResponse.
 */
class RedirectToProviderResponse implements AskEmailResponseContract
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
        $provider = $request->route('provider', '');

        $response = $this->socialService->redirect($provider);

        return $response;
    }
}
