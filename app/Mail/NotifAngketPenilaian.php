<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifAngketPenilaian extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($perusahaan, $brand)
    {
        $this->perusahaan = $perusahaan;
        $this->brand = $brand;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notif@gpci.or.id')
            ->view('components.notif-angket-penilaian')
            ->subject('Informasi Upload Dokumen Angket Penilaian')
            ->with(
                [
                    'nama_perusahaan' => $this->perusahaan,
                    'nama_brand' => $this->brand
                ]
            );
    }
}
