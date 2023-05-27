@extends('app.Master')

@section('titulo')
Agregar un permiso
@endsection

@section('contenido')
<div id="app" class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<form action="{{action('PermisoController@save')}}" method="POST">
          	{{csrf_field()}}
			<div class="form-group">
				<input type="hidden" value="{{$permiso->id_permiso}}" name="id_permiso">
				<label class="form-label">Permiso</label>
				<input class="form-control" type="text" v-model="nombre" name="nombre">
				<label class="form-label">Clave</label>
				<input class="form-control" type="text" v-model="clave" name="clave">
			</div>
			<div v-if="bandera==1" class="alert alert-warning" role="alert">
           		@{{mensaje}}
			</div>
          	<input type="submit" @click="validar_formulario($event)" class="btn btn-success" name="operacion" value="{{$operacion}}">
          	@if($operacion=='Editar')
          	<input type="submit"  @click="confirmacion($event)" class="btn btn-danger" name="operacion" value="Eliminar">
          	@endif
          	<input type="submit" class="btn btn-warning" name="operacion" value="Cancelar">

		</form>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    new Vue({
      el:'#app',
      data:{
        nombre:'{{$permiso->nombre}}'
      ,clave:'{{$permiso->Clave}}'
      ,bandera:0
      ,mensaje:''
      }
      ,methods:{
        validar_formulario: function(event){
          this.bandera = 0;
          this.mensaje = '';
          //vamos a prender la this.bandera si un campo no está bien llenado
          if (this.nombre==''){
            this.bandera = 1;
            this.mensaje += "El campo Permiso no puede estar vacio "; 
          }

          if (this.clave==''){
            this.bandera=1;
            this.mensaje += "El campo Clave no puede estar vacio ";
          }

          if (this.bandera == 1){
            event.preventDefault(); // con esta linea de codigo evitamos que envie informacion
          }
        },

        confirmacion:function(event){
          //con esto le decimos que cuando el usuario aprete cancelar se detenga el proceso.
          if(!confirm("¿Desea eliminar el permiso??")){
            event.preventDefault(); 
          }
        }
      }
    })
  </script>
@endsection