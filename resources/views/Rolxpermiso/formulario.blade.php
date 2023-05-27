@extends('app.Master')
@section('titulo')
Permisos del rol
@endsection

@section('contenido')
<div id="app" class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<h3 class="card-title"> Permisos </h3>
		<form action="{{action('RolxpermisoController@save')}}" method="POST">
			{{csrf_field()}}
			<input type="hidden" name="id_rol" value="{{$rol->id_rol}}">
			<table class="table table-bordered">
				<tr v-for="elemento in permiso">
					<td>
						<input type="checkbox" name="id_permiso[]" :checked="elemento.asignado" :value="elemento.id_permiso">
					</td>
					<td>@{{elemento.nombre}}</td>
				</tr>
			</table>

			<button class="btn btn-success">Guardar</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<form action="{{action('RolController@listado')}}">
			<button class="btn btn-warning">Cancelar</button>
		</form>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	new Vue({
		el:'#app'
		,data:{
			permiso:<?php echo json_encode($permiso); ?>
		}
		,methods:{}
	})
</script>
@endsection