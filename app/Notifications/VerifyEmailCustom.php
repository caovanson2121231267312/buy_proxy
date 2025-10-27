<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use App\Mail\VerifyEmailStyled;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailCustom extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    // public function toMail(object $notifiable): MailMessage
    // {
    //     $verifyUrl = $this->verificationUrl($notifiable);

    //     return (new MailMessage)
    //         ->subject('Xác nhận Email của bạn - ' . config('app.name'))
    //         ->greeting('Xin chào ' . $notifiable->name . ' 👋')
    //         ->line('Cảm ơn bạn đã đăng ký tài khoản tại hệ thống của chúng tôi.')
    //         ->line('Để kích hoạt tài khoản, vui lòng xác thực email bằng cách nhấn nút bên dưới:')
    //         ->action('Xác nhận Email', $verifyUrl)
    //         ->line('Nếu bạn không đăng ký tài khoản này, vui lòng bỏ qua email này.')
    //         ->salutation('Trân trọng, ' . config('app.name'));
    // }

    public function toMail($notifiable)
    {
        $verifyUrl = $this->verificationUrl($notifiable);

        return (new VerifyEmailStyled($notifiable, $verifyUrl))
                ->to($notifiable->email);
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }
}
