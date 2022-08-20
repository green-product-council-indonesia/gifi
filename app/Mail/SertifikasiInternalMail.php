<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SertifikasiInternalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nama_bujt, $nama_ruas)
    {
        $this->nama_bujt = $nama_bujt;
        $this->nama_ruas = $nama_ruas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notif@gtri.or.id')
            ->subject('Data Sertifikasi Green Toll Road Indonesia')->view('components.sertifikasi-internal-mail')->with(
                [
                    'nama_bujt' => $this->nama_bujt,
                    'nama_ruas' => $this->nama_ruas,
                ]
            );
    }
}
