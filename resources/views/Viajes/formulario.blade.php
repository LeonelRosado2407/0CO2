@extends('app.Master')
@section('titulo')
Agregar un viaje 
@endsection

@section('contenido')
<div id="app" class="row">
	<div class="col-md-12 col-xs-12 col-sm-12">
		<form enctype="multipart form-data" action="{{action('ViajesController@save')}}" method="POST">
          {{csrf_field()}}
			<div class="form-group">
				<input type="hidden" class="form-control" value="{{$viajes->id_Viajes}}" name="id_Viajes">
				<input type="hidden" class="form-control" value="{{$viajes->id_Chofer}}" name="id_Chofer">
			</div>
			<div class="form-group">
				<label class="form-label">Viaje</label>
				<input type="text" name="viaje" class="form-control" v-model="viaje">
			</div>
			<div class="form-group">
				<label class="form-label">Fecha de llegada </label>
				<vuejs-datepicker 
				input-class="form-control"
				placeholder="selecciona la fecha"
				format="yyyy-MM-dd"
				:language="lenguaje"
				v-model="llegada"
				name="llegada"
				></vuejs-datepicker>
			</div>
			<div class="form-group">
				<label class="form-label">Atencion Inicial </label>
				<vuejs-datepicker 
				input-class="form-control"
				placeholder="selecciona la fecha"
				format="yyyy-MM-dd"
				:language="lenguaje"
				v-model="inicial"
				name="atencion_inical"
				></vuejs-datepicker>
			</div>
			<div class="form-group">
				<label class="form-label">Atencion Final</label>
				<vuejs-datepicker 
				input-class="form-control"
				placeholder="selecciona la fecha"
				format="yyyy-MM-dd"
				:language="lenguaje"
				v-model="final"
				name="atencion_final"
				></vuejs-datepicker>
			</div>
			<div class="form-group">
				<label class="form-label">Servicio</label>
				<select class="form-control" name="id_Servicio" v-model="id_Servicio">
					<option v-for="servi in servicio" :value="servi.id_Servicio">@{{servi.Nombre_Servicio}}</option>
				</select>
			</div>
			<div class="form-group">
				<label class="form-label">Aeropuerto</label>
				<select class="form-control" name="id_Aeropuerto" v-model="id_Aeropuerto">
					<option v-for="aero in aeropuerto" :value="aero.id_Aeropuerto">@{{aero.Nombre_Aeropuerto}}</option>
				</select>
			</div>
<!-- 			<div>
				<label class="form-label">Chofer</label>
				<input type="text" name="chofer" v-model="chofer" class="form-control">
			</div> -->
			<div v-if="bandera==1" class="alert alert-warning" role="alert">
            @{{mensaje}}
         	</div>
			<input type="submit" @click="validar_formulario($event)" class="btn btn-success" name="operacion" value="{{$operacion}}">
          	<!-- <button class="btn btn-success" type="submit">{{$operacion}}</button> -->
         	 @if($operacion=='Editar')
          	<input type="submit"  @click="confirmacion($event)" class="btn btn-danger" name="operacion" value="Eliminar">
          	@endif
          	<input type="submit" class="btn btn-warning" name="operacion" value="Cancelar">
		</form>
	</div>
</div>
@endsection

@section('javscript')
<script src="{{asset('public/vuejs-datepicker.min.js')}}"></script>
<script src="{{asset('public/es.js')}}"></script>
@endsection

@section('script')
<script type="text/javascript">
	new Vue({
		el:'#app'
		,data:{
			llegada:'{{$viajes->Fecha_llegada}}'
			,viaje:'{{$viajes->Clave_viaje}}'
			,chofer:'{{$viajes->id_Chofer}}'
			,servicio:<?php echo json_encode($servicios_nombre); ?>
			,aeropuerto:<?php echo json_encode($aeropuertos_nombre);?>
			,id_Servicio:'{{$viajes->id_Servicio}}'
			,id_Aeropuerto:'{{$viajes->id_Aeropuerto}}'
			,inicial:'{{$viajes->atencion_inical}}'
			,final:'{{$viajes->atencion_final}}'
			,bandera:0
			,mensaje:''
			,lenguaje:vdp_translation_es.js
		}
		,methods:{
			validar_formulario: function(event){
	          this.bandera = 0;
	          this.mensaje = '';
	          //vamos a prender la this.bandera si un campo no está bien llenado
	          if (this.viaje==''){
	            this.bandera = 1;
	            this.mensaje += "El nombre del viaje no puede estar vacio "; 
	          }
	          if (this.inicial==''){
	            this.bandera = 1;
	            this.mensaje += "La atencion inical no puede estar vacio "; 
	          }
	          if (this.final==''){
	            this.bandera = 1;
	            this.mensaje += "La atencion final no puede estar vacio "; 
	          }
	          if (this.llegada==''){
	            this.bandera = 1;
	            this.mensaje += "La fecha de llegada no puede estar vacio "; 
	          }

	          if (this.id_Servicio==''){
	            this.bandera = 1;
	            this.mensaje += "El servicio no puede estar vacio "; 
	          }
	          if (this.id_Aeropuerto==''){
	            this.bandera = 1;
	            this.mensaje += "El aeropuerto no puede estar vacio "; 
	          }
	           if (this.chofer==''){
	            this.bandera = 1;
	            this.mensaje += "El chofer no puede estar vacio "; 
	          }

	          if (this.bandera == 1){
	            event.preventDefault(); // con esta linea de codigo evitamos que envie informacion
          		}
        	}
        	,confirmacion:function(event){
        		if (!confirm("¿Desea eliminar el Viaje?")) {
        			event.preventDefault();
        		}
        	}
		}
		,components:{
			vuejsDatepicker
		}
	})
</script>
@endsection