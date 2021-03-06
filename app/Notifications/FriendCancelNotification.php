<?php

namespace STS\Notifications;

use  STS\Services\Notifications\BaseNotification;
use  STS\Services\Notifications\Channels\MailChannel;
use  STS\Services\Notifications\Channels\PushChannel;
use  STS\Services\Notifications\Channels\DatabaseChannel;

class FriendCancelNotification extends BaseNotification
{
    protected $via = [DatabaseChannel::class, MailChannel::class, PushChannel::class];

    public function toEmail($user)
    {
        return [
            'title' => $this->getAttribute('from')->name.'ha dejado de ser tu amigo',
            'email_view' => 'friends_email',
            'type' => 'cancel',
        ];
    }

    public function toString()
    {
        return $this->getAttribute('from')->name.' ha dejado de ser tu amigo';
    }

    public function getExtras()
    {
        return [
            'type' => 'friends',
        ];
    }

    public function toPush($user, $device)
    {
        $from = $this->getAttribute('from');

        return [
            'message' => $from->name.' ha dejado de ser tu amigo',
            'url' => 'friend',
            'extras' => [
                'id' => $from->id,
            ],
        ];
    }
}
