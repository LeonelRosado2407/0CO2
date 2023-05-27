@extends('app.Master')

@section('estilo')

@endsection

@section('titulo')

@endsection

@section('contenido')
<div class="row">
      <div  class="col-md-12 col-xs-12 col-sm-12" >
        <div class="text-center">
        <img src="{{asset('public/logo_scelc2022.png')}}" class="img-thumbnail" alt="Responsive image">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <div class="jumbotron" >
          <h1 class="text-center"><strong>Bienvenidos al proyecto 0 CO2</strong></h1>
          <h4 class="text-center"><strong>0 CO2</strong> es un proyecto con el objetivo de reducir las emisiones de co2 en la atmósfera, usando carros híbridos y/o elécrticos para el transporte de personas del aeropuerto a un destino en concreto</h4>
        </div>
        <div class="alert alert-info" role="alert">
          <p class="text-center"><strong> Haga click en un botón para acceder a las tablas. :3</strong></p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-1">
        
      </div>

      <div class="col-md-2">
        <div class="thumbnail">
          <img src="{{asset('public/logos/servicios.jpg')}}" alt="..." width="200">
        <div class="caption">
          <h3>Servicios</h3>
          <form action="{{action('ServiciosController@listado')}}" method="GET">
            {{csrf_field()}}
            <button class="btn btn-primary">Servicios</button>
          </form>
        </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="thumbnail">
          <img src="{{asset('public/logos/logo_a.png')}}" alt="..." width="200">
          <div class="caption">
            <h3>Aeropuertos</h3>
            <form action="{{action('AeropuertoController@listado')}}" method="GET">
              {{csrf_field()}}
              <button class="btn btn-primary">Aeropuerto</button>
            </form>
          </div>
        </div>      
      </div>

      <div class="col-md-2">
        <div class="thumbnail">
          <img src="{{asset('public/logos/chofer.png')}}" alt="..." width="200">
          <div class="caption">
            <h3>Choferes</h3>
            <form action="{{action('ChoferController@listado')}}" method="GET">
              {{csrf_field()}}
              <button class="btn btn-primary">Choferes</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="thumbnail">
          <img src="{{asset('public/logos/destino.png')}}" alt="..." width="200">
          <div class="caption">
            <h3>Destinos</h3>
            <form action="{{action('DestinoController@listado')}}" method="GET">
             {{csrf_field()}}
              <button class="btn btn-primary">Destinos</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="thumbnail">
          <img src="{{asset('public/logos/vehiculo.png')}}" alt="..." width="200">
          <div class="caption">
            <h3>Vehículos</h3>
            <form action="{{action('VehiculoController@listado')}}" method="GET">
              {{csrf_field()}}
              <button class="btn btn-primary">Vehículos</button>
            </form>
          </div>
        </div>
      </div>

       <div class="col-md-1">
        
      </div>

    </div>
    <div class="row">
      <div  class="col-md-12 col-xs-12 col-sm-12" >
        <div class="text-center">
          <img  src="{{asset('public/logo utm.png')}}" class="img-thumbnail" alt="Responsive image">
        </div>
        <p  class="text-center">
          Proyecto creado por el alumno Noé Leonel Rosado Quintal de la <strong>Universidad Tecnológica Metropolitana</strong>
          en la carrera de Entornos Virtuales y Negocios Digitales, en compañia del Maestro Elias Marrufo
        </p>
      </div>
    </div>
@endsection
    