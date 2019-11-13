<?php

namespace InetStudio\ACL\Passwords\Mail\Front;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Passwords\Contracts\Mail\Front\ResetMailContract;

/**
 * Class ResetMail.
 */
class ResetMail extends Mailable implements ResetMailContract
{
    use SerializesModels;

    /**
     * Токен.
     *
     * @var string
     */
    protected $token;

    /**
     * Пользователь.
     *
     * @var string
     */
    protected $user;

    /**
     * ResetPasswordTokenMail constructor.
     *
     * @param  string  $token
     * @param  UserModelContract  $user
     */
    public function __construct(string $token, UserModelContract $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject(config('acl.passwords.mails.subject') ?? 'Сброс пароля')
            ->view('admin.module.acl.passwords::mails.reset_password_token', [
                'token' => $this->token,
                'user' => $this->user,
            ]);
    }
}
