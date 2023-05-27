@extends('app.Master')

@section('titulo')
Listado de Choferes
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-6 col-xs-6 col-sm-12">
      <form action="{{action('ChoferController@formulario')}}" method="POST">
        {{csrf_field()}}
        <button class="btn btn-success">Agregar</button>
      </form>
    </div>
    <div class="col-md-6 col-xs-6 col-sm-12">
      <div>
        <form action="{{action('BienvenidaController@mostrar')}}" method="GET">
          {{csrf_field()}}
          <button class="btn btn-primary">Inicio</button>
        </form>
      </div>
    </div>
  </div>
  <div id="app" class="row">
    <div class="col-md-12 col-xs-12 col-sm-12">
      <table class="table table-bordered">
        <tr class="success">
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Edad</th>
          <th>CURP</th>
          <th>&nbsp;</th>
        </tr>
         <tr class="active" v-for="elemento in Chofer">
          <!-- para generar la liga creamos un nuevo atributo  y en el atributo pondremos que el backend genere la liga, después solo  agregamops el id
            otra cosa que podemos hacer es que un campo de html sea dinamico con el vue poniendole al campo ':' ejemplo: :href.
            para poder llenar los datos de la tabal con vue hacemos como con el backend, solo que le agregamos el arroba y la sintaxis cambia a javascript. ejemplo: @{{elemento.Descripcion}}-->
          <td><a :href="url_editar+'?id_Chofer='+elemento.id_Chofer">@{{elemento.Nombres}}</a></td>
          <td>@{{elemento.Apellidos}}</td>
          <td>@{{elemento.Edad}}</td>
          <td>@{{elemento.CURP}}</td>
          <td>
            <a :href="url_viajes+'?id_Chofer='+elemento.id_Chofer">Viajes</a>
          </td>
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
          Chofer:<?php echo json_encode($Chofer_listado);?> //con esto hacemos que el array backend se convierta a json para usarlo en javascript.
          ,url_editar:'{{action("ChoferController@formulario")}}' //aca generamos la liga con el backend.
          ,url_viajes:'{{action("ViajesController@listado")}}'
        }
        ,methods:{}
      })
  </script>
@endsection
  