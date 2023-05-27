@extends('app.Master')

@section('titulo')

Listado Destinos

@endsection

@section('contenido')
<div class="row">
  <div class="col-md-6 col-xs-6 col-sm-12">
    <form action="{{action('DestinoController@formulario')}}" method="POST">
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
      <tr class="danger">
        <th>Destino</th>
        <th>Direccion</th>
      </tr>
        <tr class="active" v-for="elemento in destinos">
          <!-- para generar la liga creamos un nuevo atributo  y en el atributo pondremos que el backend genere la liga, después solo  agregamops el id
            otra cosa que podemos hacer es que un campo de html sea dinamico con el vue poniendole al campo ':' ejemplo: :href.
            para poder llenar los datos de la tabal con vue hacemos como con el backend, solo que le agregamos el arroba y la sintaxis cambia a javascript. ejemplo: @{{elemento.Descripcion}}-->
        <td><a :href="url_editar+'?id_Destinos='+elemento.id_Destinos">@{{elemento.Nombre_Destino}}</a></td>
        <td>@{{elemento.Ubicacion_Destino}}</td>
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
      destinos:<?php echo json_encode($Destino_listado);?> //con esto hacemos que el array backend se convierta a json para usarlo en javascript.
      ,url_editar:'{{action("DestinoController@formulario")}}' //aca generamos la liga con el backend.
    }
    ,methods:{}
  })
</script>
@endsection