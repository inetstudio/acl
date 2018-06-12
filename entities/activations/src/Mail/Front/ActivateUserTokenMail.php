<?php

namespace InetStudio\ACL\Activations\Mail\Front;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Activations\Contracts\Mail\Front\ActivateUserTokenMailContract;

/**
 * Class ActivateUserTokenMail.
 */
class ActivateUserTokenMail extends Mailable implements ActivateUserTokenMailContract
{
    use SerializesModels;

    /**
     * @var string
     */
    protected $token;

    /**
     * ActivateUserTokenMail constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject(config('acl.activations.mails.subject') ?? 'Активация аккаунта')
            ->view('admin.module.acl.activations::mails.activate_user_token', ['token' => $this->token]);
    }
}
