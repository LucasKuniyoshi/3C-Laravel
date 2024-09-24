<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testamento extends Model
{
    use HasFactory;

    protected $fillable = [ 'nome' ];

    //public $timeStamp = false; //caso n queira declarar a data de criação da tabela
}
