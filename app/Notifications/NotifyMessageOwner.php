<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotifyMessageOwner extends Notification
{
    use Queueable;
    public $user, $message;
    /**
     * Create a new notification instance.
     * $user is the person who sent the message
     * $message is the message that was sent to this user
     * @return void
     */
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database', 'firebase'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user'=> $this->user,
            'message' => $this->message,
        ];
    }

    /**
     * Save the notifaction to the database
     *
     */
    public function toDatabase($notifiable)
    {
        return [
            'user'=> $this->user,
            'message' => $this->message,
        ];
    }

    /**
     * Send notifaction to firebase
     */
    public function toFirebase($notifiable){
        // return (new \Liliom\Firebase\FirebaseMessage)
        //     ->notification([
        //         'title' => 'Notification title',
        //         'body' => 'Notification body',
        //         'sound' => '', // Optional
        //     'icon' => '', // Optional
        //     'click_action' => '' // Optional
        //     ])
        //     ->setData([
        //     'param' => 'zxy' // Optional
        // ])->setPriority('high'); // Default is 'normal'
        return;
    }

    /**
     * Send the firebase notifaction to this users device
     *
     * @return string|array
     */
    public function routeNotificationForFirebase()
    {
        return $this->device_tokens;
    }


}
