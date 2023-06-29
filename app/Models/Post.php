<?php

namespace App\Models;

use App\Accessors\DefaultAccessors;
use App\Scopes\YearScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;

class Post extends Model
{
    use HasFactory, SoftDeletes, DefaultAccessors;

    protected $fillable = ['user_id', 'title', 'body', 'date'];

     protected $casts = [
         'date' => 'datetime:d/m/Y',
         'active' => 'boolean'
     ];

     protected static function booted()
     {
        // static::addGlobalScope('year', function (Builder $builder) {
        //     $builder->whereYear('date', now()->year);
        // });
        static::addGlobalScope(new YearScope);
     }

     public function scopeLastWeek($query)
     {
        return $this->whereDate('date', '>=', now()->subDays(4))
                    ->whereDate('date', '<=', now()->subDays(1));
     }

     public function scopeToday($query)
     {
        return $this->whereDate('date', now());
     }

     public function scopeBetween($query, $firstDate, $lastDate)
     {
        $firstDate = Carbon::make($firstDate)->format('Y-m-d');
        $lastDate  = Carbon::make($lastDate)->format('Y-m-d');
        return $this->whereDate('date', '>=', $firstDate)
                    ->whereDate('date', '<=', $lastDate);
     }


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


    //  public  function getTitleAttribute($value)
    //  {
    //     return strtoupper($value);
    //  }

    //  public  function getTitleAndBodyAttribute($value)
    //  {
    //     return $this->title . ' - ' . $this->body;
    //  }

    //  public function getDateAttribute($value)
    //  {
    //     return Carbon::make($value)->format('Y/m/d');
    //  }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::make($value)->format('Y-m-d');
    }

}
