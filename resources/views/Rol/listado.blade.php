@extends('app.Master')

@section('titulo')
Listado de Roles
@endsection


@section('contenido')
<div class="row">
	<div class="col-md-6 col-xs-6 col-sm-6">
		<form action="{{action('RolController@formulario')}}"	method="POST">
        	{{csrf_field()}}
			<button class="btn btn-success">Agregar</button>
		</form>
	</div>
	<div class="col-md-6 col-xs-6 col-sm-6">
		<form action="{{action('BienvenidaController@mostrar')}}" method="GET">
        	{{csrf_field()}}
			<button class="btn btn-primary">Inicio</button>
		</form>
	</div>
</div>
<div id="app" class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<table class="table table-bordered">
			<tr class="active">
				<th>Nombre</th>
				<th>&nbsp;</th>
			</tr>
			<tr v-for="elemento in rol">
				<td><a :href="url_editar + '?id_rol='+ elemento.id_rol">@{{elemento.nombre}}</a></td>
				<td><a :href="url_permiso +'?id_rol='+elemento.id_rol">permisos</a> </td>
			</tr>
		</table>
	</div>
</div>
@endsection


@section('script')
<script type="text/javascript">
	new Vue({
		el:'#app',
		data:{
			rol:<?php echo json_encode($rol); ?>
			,url_editar:'{{action("RolController@formulario")}}'
			,url_permiso:'{{action("RolxpermisoController@formulario")}}'
		},
		methods:{}
	})
</script>
@endsection