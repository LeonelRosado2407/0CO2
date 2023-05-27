@extends('app.Master')

@section('titulo')
Registro de Usuarios
@endsection

@section('contenido')
<div id="app" class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
       <form action="{{action('Auth\RegisterController@register')}}" method="POST">
          {{csrf_field()}}
           <input type="hidden" name="id_Usuario">
           <div class="form-group">
               <label class="form-label">Email</label>
               <input type="text" name="email" class="form-control">
           </div>
           <div class="form-group">
               <label class="form-label">Password</label>
               <input type="password" name="password" value="" class="form-control">
           </div>
           <div class="form-group">
               <label class="form-label"> Rol </label>
               <select class="form-control" name="id_rol">
                   <option value="1">Administrador</option>
                   <option value="2">Chofer</option>
                   <option value="3">Cliente</option>
               </select>
           </div>
           <input type="submit" name="operacion" class="btn btn-success" value="Registrar">
           <input type="submit" name="operacion" class="btn btn-warning" value="Cancelar">
       </form> 
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    new Vue({
        el:'#app'
        ,data:{}
        ,methods:{}
    })
</script>
@endsection
