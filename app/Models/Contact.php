<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;  // Pastikan import Notifiable

class Contact extends Model
{
    use Notifiable;  // Menggunakan trait Notifiable untuk mendukung notifikasi

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
    ];

    // Menambahkan metode routeNotificationForMail untuk memberitahu ke email mana notifikasi dikirim
    public function routeNotificationForMail()
    {
        return $this->email;  // Menggunakan alamat email yang ada di field 'email' pada Contact
    }
}
