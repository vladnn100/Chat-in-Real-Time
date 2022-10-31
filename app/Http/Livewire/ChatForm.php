<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\NuevoMensaje;

class ChatForm extends Component
{

    
    public $usuario;
    public $mensaje;

    
    private $faker;
    
    protected $updatesQueryString = ['usuario'];   
    
    protected $listeners = ['solicitaUsuario'];

    public function mount()
    {                
        
        $this->faker = \Faker\Factory::create();       

        
        $this->usuario = request()->query('usuario', $this->usuario) ?? $this->faker->name;                         

        
        $this->mensaje = $this->faker->realtext(20);
    }
    
    
    public function solicitaUsuario()
    {
        
        $this->emit('cambioUsuario', $this->usuario);
    }

    
    public function updatedUsuario()
    {
        
        $this->emit('cambioUsuario', $this->usuario);
    }

    
    public function updated($field)
    {
       
        $validatedData = $this->validateOnly($field, [
            'usuario' => 'required',
            'mensaje' => 'required',
        ]);
    }

    public function enviarMensaje()
    {                
        $validatedData = $this->validate([
            'usuario' => 'required',
            'mensaje' => 'required',
        ]);

        
        \App\Models\Chat::create([
            "usuario" => $this->usuario,
            "mensaje" => $this->mensaje
        ]);
        
        
        event(new \App\Events\NuevoMensaje($this->usuario, $this->mensaje));
        
        
        $this->emit('enviadoOK', $this->mensaje);
        
         
         $this->mensaje = '';
    
    }

    public function render()
    {
        return view('livewire.chat-form');
    }
}
