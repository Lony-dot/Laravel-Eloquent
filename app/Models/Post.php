<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'body', 'date'];

    // protected $table = 'postagens';
    // protected $primaryKey = 'id_postagem';
    // protected $keyType = 'string';
    // protected $incrementing = false; //desabilita a incrementação default, que incrementa automáticamente um id
    // protected $timestamps = true; //desabilita o timestamps, creat_at, update_at
    // const CREATED_AT = 'data_criacao'; //Método que modifica o nome default de uma tabela com created_at
    // const UPDATE_AT = 'data_atualização'; // Método que modifica o nome default de uma tabela com update_at
    // protected $dateFormat = 'd/m/Y';
    // protected $connection = 'pgsql'; //Alterna a conexão de banco de dados
    // protected $attributes = [
    //     'active' => true
    // ];
}
