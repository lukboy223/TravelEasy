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

        // The primary key for the model (if different from the default 'id')
        protected $primaryKey = 'InvoiceNumber';
    
        // The attributes that are mass assignable
        protected $fillable = [
            'InvoiceNumber', 
            'InvoiceDate', 
            'AmountExclVAT', 
            'VAT', 
            'AmountIncVAT', 
            'InvoiceStatus',
        ];
    
        // The attributes that should be hidden for arrays (e.g., sensitive information)
        protected $hidden = [];
    
        // The attributes that should be cast to native types
        protected $casts = [
            'InvoiceDate' => 'datetime',  // Assuming you want to treat this as a date
            'VAT' => 'float',             // If VAT is a numeric field
            'AmountExclVAT' => 'float',
            'AmountIncVAT' => 'float',
        ];
    
        // You can also add relationships here if needed in the future
        // For example, if invoices have many items, you can define that here:
        // public function items()
        // {
        //     return $this->hasMany(Item::class);
        // }
}
