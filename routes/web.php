<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  
                           //Ruta Bienvenida
   Route::get('/Bienvenida/Inicio','BienvenidaController@mostrar');

Route::group(['middleware'=> 'auth'], function (){
                        //Ruta Servicios
   Route::get('/catalogos/Servicios/listado','ServiciosController@listado')->middleware('candado2:Servicio') ;
   //Route::post('/Servicios/formulario','ServiciosController@formulario');  Esta es una ruta que solo admite un tipo de metodo}
   //Esta ruta ya admite los dos metodos
   Route::match(array('GET','POST'),'/catalogos/Servicios/formulario','ServiciosController@formulario')->middleware('candado2:Servicio'); 
   Route::post('/catalogos/Servicios/save','ServiciosController@save')->middleware('candado2:Servicio');

                        //Ruta Aeropuertos
   Route::get('/catalogos/Aeropuerto/listado','AeropuertoController@listado')->middleware('candado2:Aeropuerto');
   Route::match(array('GET','POST'),'/catalogos/Aeropuerto/formulario','AeropuertoController@formulario')->middleware('candado2:Aeropuerto'); 
   Route::post('/catalogos/Aeropuerto/save','AeropuertoController@save')->middleware('candado2:Aeropuerto');

                        //Ruta Vehiculos
   Route::get('/catalogos/Vehiculo/listado','VehiculoController@listado')->middleware('candado2:Vehiculos');
   Route::match(array('GET','POST'),'/catalogos/Vehiculo/formulario','VehiculoController@formulario')->middleware('candado2:Vehiculos'); 
   Route::post('/catalogos/Vehiculo/save','VehiculoController@save')->middleware('candado2:Vehiculos');

                        //Ruta Choferes
   Route::get('/Bienvenido/Chofer','ChoferController@listado')->middleware('candado2:Chofer');
   Route::get('/catalogos/Chofer/listado','ChoferController@listado')->middleware('candado2:Chofer');
   Route::match(array('GET','POST'),'/catalogos/Chofer/formulario','ChoferController@formulario')->middleware('candado2:Chofer'); 
   Route::post('/catalogos/Chofer/save','ChoferController@save')->middleware('candado2:Chofer');

                           //Ruta Destinos
   Route::get('/catalogos/Destino/listado','DestinoController@listado')->middleware('candado2:Destinos');
   Route::match(array('GET','POST'),'/catalogos/Destino/formulario','DestinoController@formulario')->middleware('candado2:Destinos'); 
   Route::post('/catalogos/Destino/save','DestinoController@save')->middleware('candado2:Destinos');

                        //Ruta Viajes
   Route::get('/catalogos/Viajes/listado','ViajesController@listado');
   Route::match(array('GET','POST'),'/catalogos/Viajes/formulario','ViajesController@formulario'); 
   Route::post('/catalogos/Viajes/save','ViajesController@save');

                        //Ruta Aeropuerto_servicio
   Route::get('/catalogos/Aeropuerto/servicios','Aeropuerto_servicioController@formulario');
   Route::post('/catalogos/Aeropuerto/servicios/save','Aeropuerto_servicioController@save');
});      
                        //Ruta Rol
   Route::get('/catalogos/rol/listado','RolController@listado');
   Route::match(array('GET','POST'),'/catalogos/rol/formulario','RolController@formulario'); 
   Route::post('/catalogos/rol/save','RolController@save');

                        //Ruta PErmisos
   Route::get('/catalogos/permiso/listado','PermisoController@listado');
   Route::match(array('GET','POST'),'/catalogos/permiso/formulario','PermisoController@formulario'); 
   Route::post('/catalogos/permiso/save','PermisoController@save');

                        //Ruta Rolxpermiso
   Route::get('catalogos/rol/permisos','RolxpermisoController@formulario');
   Route::post('catalogos/rol/permisos/save','RolxpermisoController@save');

                    //Ruta de fotos
   Route::get('fotos/{nombre_foto}','VehiculoController@mostrarfoto');

                        //Ruta Faker
   Route::get('/dbup/chofer','DbUpController@Chofer');
   Route::get('/dbup/pruebas','DbUpController@pruebas');
   Route::get('/dbup/vehiculos','DbUpController@vehiculos');
   // Route::get('/dbup/BoViaje','DbUpController@viaje_bo');

                        //Rutas Buscador
   Route::match(array('Get','Post'),'/Buscador','BuscadorController@index');

                        //Ruta Plantilla master
   Route::get('/Template/Demo',function(){
      return view('app.Master');
   });

   //Ruta de ejemnplo para el formulario de registro de usuarios
   Route::get('/test_registro',function(){
      return view('auth.register');
   });

                        //Ruta Registro de Usuarios
   Route::get('/usuarios/registro','Auth\RegisterController@formulario_usuarios');
   Route::post('/usuarios/registro/save','Auth\RegisterController@register');

   // Auth::routes();

                        //Rutas Autoregistro
   Route::get('/registrate',function(){
      return view('auth.autoregistro');
   });

  
                        //Ruta Login

   Route::get('/Manage', 'Auth\LoginController@showLoginForm')->name('login');
   Route::get('/', 'Auth\LoginController@showLoginForm');
   Route::post('login', 'Auth\LoginController@login');


   Route::get('/home', 'HomeController@index')->name('home');
   Route::get('/Bienvenido/Cliente','CLienteController@perfil');

   Route::get('/pruebabo','DemoController@prueba_bo');
