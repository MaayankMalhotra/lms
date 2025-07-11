<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WebinarCertificateMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $enrollment;
    public $certificatePath;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $enrollment
     * @param  string $certificatePath
     */
    public function __construct($enrollment, $certificatePath)
    {
        $this->enrollment = $enrollment;
        $this->certificatePath = $certificatePath;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Webinar Certificate')
                    ->view('admin.webinar.webinar-certificate') ;
                    // ->attach($this->certificatePath, [
                    //     'as' => 'webinar_certificate.jpg',
                    //     'mime' => 'image/jpeg',
                    // ]);
    }
}
