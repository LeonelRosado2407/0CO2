@extends('app.Master')
@section('titiulo')
Listado de Vehiculos
@endsection

@section('contenido')
  <div class="row">
    <div class="col-md-4 col-xs-4 col-sm-12">
      <form action="{{action('VehiculoController@formulario')}}" method="POST">
        {{csrf_field()}}
         <button class="btn btn-success">Agregar</button>
      </form>
    </div>
    <div class="col-md-4 col-xs-4 col-sm-12">
      <div>
        <form action="{{action('BienvenidaController@mostrar')}}" method="GET">
          {{csrf_field()}}
          <button class="btn btn-primary">Inicio</button>
        </form>
      </div>
    </div>
    <div class="col-md-4 col-xs-4 col-sm-12">
      <div>
        <form action="{{action('BuscadorController@index')}}" method="GET" >
          {{csrf_field()}}
          <button class="btn btn-warning">Buscar</button>
        </form>
      </div>
    </div>
  </div>
  <div id="app" class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
      <table class="table table-bordered">
        <tr class="warning">
          <th>Modelo</th>
          <th>Marca</th>
          <th>Placa</th>
          <th>Año</th>
          <th>Foto</th>
          <th>Chofer</th>
        </tr>
         <tr class="active" v-for="elemento in Vehiculo">
          <!-- para generar la liga creamos un nuevo atributo  y en el atributo pondremos que el backend genere la liga, después solo  agregamops el id
            otra cosa que podemos hacer es que un campo de html sea dinamico con el vue poniendole al campo ':' ejemplo: :href.
            para poder llenar los datos de la tabal con vue hacemos como con el backend, solo que le agregamos el arroba y la sintaxis cambia a javascript. ejemplo: @{{elemento.Descripcion}}-->
          <td><a :href="url_editar+'?id_Vehiculo='+elemento.id_Vehiculo">@{{elemento.Modelo}}</a></td>
          <td>@{{elemento.Marca}}</td>
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
          Vehiculo:<?php echo json_encode($Vehiculos_listado);?> //con esto hacemos que el array backend se convierta a json para usarlo en javascript.
          ,url_editar:'{{action("VehiculoController@formulario")}}' //aca generamos la liga con el backend.

        }
        ,methods:{}
      })
  </script>
@endsection
