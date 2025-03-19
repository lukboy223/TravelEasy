<?php
// filepath: /C:/Users/bilag/Herd/TravelEasy/app/Models/Customer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'PeopleId', 'RelationNumber', 'Isactive', 'Note', 'DateCreated', 'DateChanged'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'PeopleId');
    }
}