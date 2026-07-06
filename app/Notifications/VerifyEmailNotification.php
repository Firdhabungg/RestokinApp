<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends BaseVerifyEmail
{
    // ⚠️  JANGAN tambahkan ShouldQueue di sini!
    // Vercel adalah serverless — tidak ada queue worker.
    // Email harus dikirim secara sinkronus (synchronous).

    /**
     * Build the mail representation of the notification.
     */
    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject('Verifikasi Alamat Email Anda — StokInApp')
            ->greeting('Halo!')
            ->line('Terima kasih telah mendaftar di **StokInApp**.')
            ->line('Klik tombol di bawah ini untuk memverifikasi alamat email Anda dan mengaktifkan akun.')
            ->action('Verifikasi Email Saya', $url)
            ->line('Link verifikasi ini akan kedaluwarsa dalam **60 menit**.')
            ->line('Jika Anda tidak membuat akun ini, abaikan email ini — tidak ada tindakan yang perlu dilakukan.')
            ->salutation('Salam, Tim StokInApp');
    }
}
