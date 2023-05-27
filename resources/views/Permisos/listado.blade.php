@extends('app.Master')

@section('titulo')
Listado de permisos
@endsection

@section('contenido')
<div class="row">
	<div class="col-md-6 col-xs-6 col-sm-6">
		<form action="{{action('PermisoController@formulario')}}"	method="POST">
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
<div class="row" id="app">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<table class="table table-bordered">
			<tr class="active">
				<th>Permiso</th>
          		<th>Clave</th>
			</tr>
			<tr v-for="elemento in permiso">

          		<td><a :href="url_editar +'?id_permiso='+elemento.id_permiso">@{{elemento.nombre}}</a></td>
				<td>@{{elemento.Clave}}</td>
			</tr>
		</table>
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	new Vue({
		el:'#app'
		,data:{
			permiso:<?php echo json_encode($permiso); ?>
			,url_editar:'{{action("PermisoController@formulario")}}'
		}
		,methods:{}
	})
</script>
@endsection