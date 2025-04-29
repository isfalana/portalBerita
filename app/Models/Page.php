<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = "page";

    protected $primaryKey = "id_page";

    protected $fillable = ["judul_page", "isi_page", "status_page"];

}