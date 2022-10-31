<div class="">

    <a href="/" style="color: black;">
        <h5 class="pb-0 mb-0"><strong>Mi chat en vivo</strong></h5>
    </a>

   
    <div class="form-group">
        <label for="usuario"><strong>Usuario</strong></label>
        <input 
            type="text" 
            wire:model="usuario" 
            class="form-control" 
            id="usuario">                
        
     
        @error("usuario") 
            <small class="text-danger">{{ $message }}</small> 
        @else 
            <small class="text-muted">Tu nombre: {{$usuario}}</small> 
        @enderror
    </div>

    <div class="form-group">
        <label for="mensaje"><strong>Mensaje</strong></label>
        <input type="text" 
            wire:model="mensaje" 
            wire:keydown.enter="enviarMensaje"                         
            class="form-control" 
            id="mensaje">
        
        @error("mensaje") 
            <small class="text-danger">{{ $message }}</small> 
        @else 
            <small class="text-muted">Escribe tu mensaje y teclea <code>ENTER</code> para enviarlo</small> 
        @enderror
    </div>
        
    <div wire:offline class="alert alert-danger text-center">
        <strong>Se ha perdido la conexión a Internet</strong>
    </div>
    
    <div class="row">
        <div class="col-6">
           
            <div style="position: absolute;"
            class="alert alert-success collapse" 
            role="alert" 
            id="avisoSuccess"       
            >Se ha enviado</div>        
        </div>    
        <div class="col-6 pt-2 text-right">
            <button 
                class="btn btn-primary" 
                wire:click="enviarMensaje"
                wire:loading.attr="disabled"
                wire:offline.attr="disabled"            
            >Enviar Mensaje</button>
        </div>        
    </div>
    
    <script>
                 
        
        $( document ).ready(function() {
            window.livewire.on('enviadoOK', function () {
                $("#avisoSuccess").fadeIn("slow");                
                setTimeout(function(){ $("#avisoSuccess").fadeOut("slow"); }, 3000);                                
            });
        });
        
    </script>

</div>

