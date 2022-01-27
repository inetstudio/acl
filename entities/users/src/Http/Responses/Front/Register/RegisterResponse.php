<?php

namespace InetStudio\ACL\Users\Http\Responses\Front\Register;

use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\Register\RegisterResponseContract;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\RegisterServiceContract;
use InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract as MetaServiceContract;

/**
 * Class RegisterResponse.
 */
class RegisterResponse implements RegisterResponseContract
{
    /**
     * @var RegisterServiceContract
     */
    protected $registerService;

    /**
     * @var MetaServiceContract
     */
    protected $metaService;

    /**
     * ApproveEmailResponse constructor.
     *
     * @param  RegisterServiceContract  $registerService
     * @param  MetaServiceContract  $metaService
     */
    public function __construct(RegisterServiceContract $registerService, MetaServiceContract $metaService)
    {
        $this->registerService = $registerService;
        $this->metaService = $metaService;
    }

    /**
     * Возвращаем ответ при активации пользователя.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     *
     * @throws BindingResolutionException
     */
    public function toResponse($request)
    {
        $data = $request->all();

        $user = $this->registerService->register($data);

        event(new Registered($user));

        event(
            app()->make(
                'InetStudio\ACL\Users\Contracts\Events\Front\RegisteredEventContract',
                [
                    'user' => $user,
                    'password' => $data['password'] ?? '',
                ]
            )
        );

        if (config('acl.register.login_after_register')) {
            Session::flash('auth_event', 'regular_register_auth');
            Auth::login($user, true);
        } else {
            Session::flash('auth_event', 'regular_register_activate');
        }

        $result = [
            'success' => true,
            'message' => (config('acl.activations.enabled')) ? trans('admin.module.acl.activations::activation.activationStatus') : 'Пользователь успешно зарегистрирован',
        ];

        if ($request->ajax()) {
            return response()->json($result, 200);
        } else {
            return view('admin.module.acl.users::front.register', [
                'SEO' => $this->metaService->getAllTags(null),
                'registration' => $result,
            ]);
        }
    }
}
