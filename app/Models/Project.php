<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'creation_date',
        'published',
        'cover',
        'type_id'

    ];

    protected $appends = [
        'full_cover_url'
    ];

    public function getFullCoverUrlAttribute(){
        $fullCoverUrl= null;

        if($this->cover){

            $fullCoverUrl = asset('storage/'.$this->cover);

            return $fullCoverUrl;

        }
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class)
                    ->withTimestamps();

    }

}
