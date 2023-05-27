@extends('app.Master')

@section('estilo')

@endsection

@section('titulo')
Buscador 
@endsection

@section('contenido')
<div class="row">
	<div class="col-md-6 col-xs-6 col-sm-6">
		<form  action="{{action('BuscadorController@index')}}" method="POST">
			{{csrf_field()}}
				<div class="form-group">
					<label>Buscar</label>
					<input class="form-control" type="text" name="criterio" value="{{$criterio}}">
				</div>
				<button class="btn btn-success">Buscar</button>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-xs-6 col-sm-6">
		<form action="{{action('VehiculoController@listado')}}">
			<button class="btn btn-success"> Regresar al listado </button>
		</form>
	</div>
</div>
<div id="app" class="row">
	<div v-if="registro.length!=0" class="col-md-12 col-xs-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel panel-heading">
				<h3>Búsqueda rápida</h3>
			</div>
			<div class="panel panel-body" >
				<div class="form-group">
					<label>Marca</label>
					<select class="form-control" v-model="tipo_marca">
						<option v-for="marca in filtro_marca" :value="marca">@{{marca}}</option>
					</select>
				</div>
				<div class="form-group">
					<label>Modelo</label>
					<select class="form-control" v-model="tipo_modelo">
						<option v-for="modelo in filtro_modelo" :value="modelo">@{{modelo}}</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div v-if="registro.length!=0" class="col-md-12 col-xs-12 col-sm-12">
		<h1>Resultado de Búsquedas</h1>
		<table class="table table-condensed">
			<tr>
				<td>Marca</td>
				<td>Modelo</td>
				<td>Placa</td>
				<td>Año</td>
				<td>Foto</td>
				<td>Chofer</td>
			</tr>
			<tr v-for="elemento in registro_final">
				<td>@{{elemento.Marca}}</td>
				<td>@{{elemento.Modelo}}</td>
				<td>@{{elemento.Placa}}</td>
				<td>@{{elemento.Year}}</td>
				<td><img :src="'{{URL::to('/')}}/'+elemento.Foto" width="200"></td>
				<td>@{{elemento.Chofer}}</td>
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
				registro:<?php echo json_encode($registro);?>
				,tipo_marca:'Todos'
				,tipo_modelo:'Todos'
				,filtro_marca:[]
				,filtro_modelo:[]
			}
			,methods:{
				borrar:function(){
					this.registro_final.splice(0,this.registro_final.length);
				}
				
				,filtrar_toyota:function(){
					this.tipo_marca='Toyota';
					
				}
				,filtrar:function(){
					this.borrar();
					for(i=0;i < this.registro.length;i++){
						bandera=false;
						if(this.tipo_marca=='Todos'){
							bandera=true;
						}
						else{
							if (this.tipo_marca==this.registro[i].Marca){
								bandera=true;
							}
						}
						if (bandera){
							this.registro_final.push(this.registro[i]);
						}
					}	
				}
			}
			,computed:{
				registro_final:function(){
					lista=[];
					self=this;
					lista=this.registro.filter(function(item){
						bandera_marca=false;
						bandera_modelo=false;
						if(self.tipo_marca=='Todos'){
							bandera_marca=true;
						}
						else{
							if (self.tipo_marca==item.Marca) {
								bandera_marca=true;
							}
						}
						if(self.tipo_modelo=='Todos'){
							bandera_modelo=true;
						}
						else{
							if (self.tipo_modelo==item.Modelo) {
								bandera_modelo=true;
							}
						}
						return bandera_marca&&bandera_modelo;
					})
					return lista;
				}
			}
			,created()  {
				this.filtro_marca.push('Todos');
				this.filtro_modelo.push('Todos');
					for(i=0;i < this.registro.length;i++){
						if(this.filtro_marca.indexOf(this.registro[i].Marca)==-1){
							this.filtro_marca.push(this.registro[i].Marca);
						}
						if(this.filtro_modelo.indexOf(this.registro[i].Modelo)==-1){
							this.filtro_modelo.push(this.registro[i].Modelo);
						}
					}
				}
		})
	</script>
@endsection
		

	