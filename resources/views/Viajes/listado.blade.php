@extends('app.Master')
@section('titulo')
Listado de Viajes de {{$chofer->Nombres}}
@endsection

@section('contenido')
<div class="row">
	<div class="col-md-6 col-xs-6 col-sm-12">
		<form action="{{action('ViajesController@formulario')}}" method="POST">
        {{csrf_field()}}
			<button class="btn btn-success">Agregar</button>
			<input type="hidden" name="id_Chofer" value="{{$chofer->id_Chofer}}">
		</form>
	</div>
	<div class="col-md-6 col-xs-6 col-sm-12">
		<form action="{{action('ChoferController@listado')}}" method="GET">
        {{csrf_field()}}
			<button class="btn btn-primary">Regresar</button>
		</form>
	</div>
</div>
<div id="app" class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<table class="table table-bordered">
			<tr>
				<th>Viaje</th>
				<th>Fecha de reservación</th>
				<th>Fecha de Llegada</th>
				<th>Servicio</th>
				<th>Aeropuerto</th>
				<th>Atencion inical</th>
				<th>Atencion final</th>
			</tr>
			<tr v-for="elemento in Viajes">
				<td><a :href="url_editar+'?id_Viajes='+elemento.id_Viajes">@{{elemento.Clave_viaje}}</a></td>
				<td>@{{elemento.Fecha_Reservacion |formato_fecha }}</td>
				<td>@{{elemento.Fecha_Llegada | formato_fecha}}</td>
				<td>@{{elemento.servicio}}</td>
				<td>@{{elemento.aeropuerto}}</td>
				<td>@{{elemento.inicial | formato_fecha }}</td>
				<td>@{{elemento.final | formato_fecha }}</td>
				<td>@{{elemento.hora_inicial}}</td>
				<td>@{{elemento.hora_final}}</td>

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
			Viajes:<?php echo json_encode($Viajes_listado)?>
			,url_editar:'{{action("ViajesController@formulario")}}'
		}
		,methods:{}
		,filters:{
			formato_fecha:function(fecha){
				datos=fecha.split('-');
				anio=datos[0];
				mes=datos[1];
				dia=datos[2];
				switch(mes)
				{
					case'01':
						mes = 'Enero';
					break;

					case '02':
						mes = 'Febrero';
					break;

					case '03':
						mes = 'Marzo';
					break;

					case '04':
						mes = 'Abril';
					break;

					case '05':
						mes = 'Mayo';
					break;

					case '06':
						mes = 'Junio';
					break;

					case '07':
						mes = 'Julio';
					break;

					case '08':
						mes = 'Agosto';
					break;

					case '09':
						mes = 'Septiembre';
					break;

					case '10':
						mes = 'Octubre';
					break;

					case '11':
						mes = 'Noviembre';
					break;

					case '12':
						mes = 'Diciembre';
					break;
				}

				cadena_fecha = dia + ' de ' +mes + ' de ' + anio;
				return cadena_fecha;
			}
		}
	})
</script>
@endsection