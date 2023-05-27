@extends('app.Master')
@section('titulo')
servicios del aeropuerto {{$aeropuerto->Nombre_Aeropuerto}}
@endsection

@section('contenido')
<div id="app" class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<h3 class="card-title">Servicios</h3>
		<form action="{{action('Aeropuerto_servicioController@save')}}" method="POST">
          {{csrf_field()}}
          <input type="hidden" name="id_Aeropuerto" value="{{$aeropuerto->id_Aeropuerto}}">
			<table class="table table-bordered">
				<tr v-for="elemento in servicios">
					<td>
						<input type="checkbox" :checked="elemento.asignado" name="id_Servicio[]" :value="elemento.id_Servicio">
					</td>
					<td>@{{elemento.Nombre_Servicio}}</td>
				</tr>
			</table>
			<button class="btn btn-success">Guardar</button>
		</form>
	</div>
	<div class="row">
		<div class="col-md-12 col-xs-12 col-sm-12">
			<form action="{{action('AeropuertoController@listado')}}">
				<button class="btn btn-warning "> Cancelar </button>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	new Vue({
		el:'#app'
		,data:{
			servicios:<?php echo json_encode($servicios);?>
		}
		,methods:{}
	})
</script>
@endsection
