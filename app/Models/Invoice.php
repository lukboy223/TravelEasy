<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

        // Define the table associated with the model (if different from the default "invoices")
        protected $table = 'invoices';
        protected $fillable = 
        [
            'InvoiceNumber'
            ,'InvoiceDate'
            ,'AmountExclVAT'
            ,'VAT'
            ,'AmountIncVAT'
            ,'InvoiceStatus'
        ];

        // You can also add relationships here if needed in the future
        // For example, if invoices have many items, you can define that here:
        // public function items()
        // {
        //     return $this->hasMany(Item::class);
        // }
        public function booking()
        {
            return $this->belongsTo(Booking::class, 'booking_id');
        }
}
