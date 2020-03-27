<?php

namespace InetStudio\ACL\Users\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Users\Contracts\Mail\CredentialsMailContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;

/**
 * Class CredentialsMail.
 */
class CredentialsMail extends Mailable implements CredentialsMailContract
{
    use SerializesModels;

    /**
     * Новый пароль.
     *
     * @var string
     */
    protected $password;

    /**
     * Пользователь.
     *
     * @var string
     */
    protected $user;

    /**
     * CredentialsMail constructor.
     *
     * @param  string  $password
     * @param  UserModelContract  $user
     */
    public function __construct(string $password, UserModelContract $user)
    {
        $this->password = $password;
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
            ->subject(config('acl.users.mails.credentials_subject') ?? 'Данные для доступа')
            ->view('admin.module.acl.users::mails.credentials', [
                'password' => $this->password,
                'user' => $this->user,
            ]);
    }
}
