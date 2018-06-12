<?php

namespace InetStudio\ACL\Users\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\ACL\Users\Contracts\Mail\NewUserMailContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;

/**
 * Class NewUserMail.
 */
class NewUserMail extends Mailable implements NewUserMailContract
{
    use SerializesModels;

    protected $user;

    /**
     * NewUserMail constructor.
     *
     * @param UserModelContract $user
     */
    public function __construct(UserModelContract $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        $subject = config('app.name').' | '.((config('users.mails.subject')) ? config('users.mails.subject') : 'Новый user');
        $headers = (config('users.mails.headers')) ? config('users.mails.headers') : [];

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to(config('users.mails.to'), '')
            ->subject($subject)
            ->withSwiftMessage(function ($message) use ($headers) {
                $messageHeaders = $message->getHeaders();

                foreach ($headers as $header => $value) {
                    $messageHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.acl.users::mails.user', ['user' => $this->user]);
    }
}
