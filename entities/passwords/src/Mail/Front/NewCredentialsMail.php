<?php

namespace InetStudio\ACL\Passwords\Mail\Front;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Passwords\Contracts\Mail\Front\NewCredentialsMailContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;

/**
 * Class NewCredentialsMail.
 */
class NewCredentialsMail extends Mailable implements NewCredentialsMailContract
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
     * NewCredentialsMail constructor.
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
            ->subject(config('acl.passwords.mails.new_credentials_subject') ?? 'Новые данные для доступа')
            ->view('admin.module.acl.passwords::mails.new_credentials', [
                'password' => $this->password,
                'user' => $this->user,
            ]);
    }
}
