<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    public static $todo;
    public static function create($request) {
        self::$todo = new Todo;
        self::$todo->name = $request['name'];
        self::$todo->save();
        return self::$todo;
    }

    public static function updateTodo($todoId,$todoName)
    {
        self::$todo = Todo::find($todoId);
        self::$todo->name = $todoName;
        self::$todo->save();
        return self::$todo;
    }
}
