<?php
namespace App\BlogModule\Table;

use App\BlogModule\Entity\Post;
use Cake\ORM\Table;

class PostsTable extends Table
{

    public function initialize(array $config)
    {
        $this->belongsTo('Categories');
        $this->setEntityClass(Post::class);
    }

}