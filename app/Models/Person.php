<?php
// filepath: /C:/Users/bilag/Herd/TravelEasy/app/Models/Person.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    // table people 
    protected $table = 'people';

    protected $fillable = [
        'Firstname', 'Infix', 'Lastname', 'Birthdate', 'Isactive', 'Note', 'DateCreated', 'DateChanged'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'PeopleId');
    }
}