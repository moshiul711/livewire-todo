<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Contracts\Service\Attribute\Required;

class TodoList extends Component
{
    use WithPagination;
    public $name,$data=[],$search,$editingTodoId,$editingTodoName;
    public function create(){
        $this->validate([
            'name' => 'required|min:5|max:50|unique:todos,name'
        ]);

        $this->data = [
            'name' => $this->name
        ];

        Todo::create($this->data);
        $this->reset(['name']);
        session()->flash('message','Todo Created');
    }

    public function delete($todoId)
    {
        Todo::find($todoId)->delete();
    }

    public function toggle($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function edit($todoId)
    {
        $this->editingTodoId = $todoId;
        $this->editingTodoName = Todo::find($todoId)->name;
    }

    public function cancelUpdate()
    {
        $this->reset('editingTodoId','editingTodoName');
    }

    public function update()
    {
        $this->validate(['editingTodoName' => 'required|min:5|max:50|unique:todos,name']);
        Todo::updateTodo($this->editingTodoId,$this->editingTodoName);
        $this->cancelUpdate();
    }
    public function render()
    {
        return view('livewire.todo-list',[
            'todos' => Todo::latest()->where('name', 'LIKE','%'. $this->search .'%')->paginate(5)
        ]);
    }
}
