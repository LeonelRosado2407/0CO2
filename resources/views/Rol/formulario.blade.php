@extends('app.Master')

@section('titulo')
Fromulario de Roles
@endsection


@section('contenido')
<div id="app" class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<form action="{{action('RolController@save')}}" method="POST">
			{{csrf_field()}}
			<div class="form-group">
				<input type="hidden" class="form-control" value="{{$rol->id_rol}}" name="id_rol">
				<label class="form-label">Nombre del Rol</label>
				<input type="text" class="form-control" v-model="nombre" name="nombre">
			</div>
			<div v-if="bandera==1" class="alert alert-warning" role="alert">
            @{{mensaje}}
          </div><div v-if="bandera==1" class="alert alert-warning" role="alert">
            @{{mensaje}}
          </div>
          	<input type="submit" @click="validar_formulario($event)" class="btn btn-success" name="operacion" value="{{$operacion}}">
          	@if($operacion =='Editar')
			<input type="submit" @click="confirmacion($event)" class="btn btn-warning" name="operacion" value="Eliminar">
			@endif
			<input type="submit" class="btn btn-danger" name="operacion" value="Cancelar">
		</form>
	</div>
</div>
@endsection


@section('script')
<script type="text/javascript">
	new Vue({
		el:'#app',
		data:{
			nombre:'{{$rol->nombre}}'
			,bandera:0
			,mensaje:''
		},
		methods:{
			validar_formulario:function(event){
				this.bandera = 0;
				this.mensaje = '';
				if (this.nombre == '') 
				{
					this.bandera = 1;
					this.mensaje+='El campo Nombre no puede estar vacio'
				}

				if (this.bandera ==1)
				{
					event.preventDefault();
				}
			},
			confirmacion:function(event){
				if (!confirm("Desea eliminar el Rol?")){
					event.preventDefault();
				}
			}
		}	
	})	
</script>
@endsection