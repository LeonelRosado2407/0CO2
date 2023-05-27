@extends('app.Master')
@section('titulo')
Registro de Servicios
@endsection


@section('contenido')
<div id="app" class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <form action="{{action('ServiciosController@save')}}" method="POST">
          {{csrf_field()}}
            <!-- esta funcion es para que no mande error de token -->
          <div class="form-group">
            <!--ahora ligaremos los campos para que vue pueda tener control de ellos, para eso usamos el v-model="" -->
            <input type="hidden" class="form-control" value="{{$servicio->id_Servicio}}" name="id_Servicio">
            <label class="form-label" for="">Servicio</label>
            <input type="text" class="form-control" v-model="servicio" name="servicio">
            <label class="form-label" for="">Descripcion</label>
            <input type="text" class="form-control" v-model="descripcion" name="Descripcion">
            <label class="form-label" for="">Precio</label>
            <input type="text" class="form-control" v-model="precio" name="Precio">
          </div>
          <!-- con el @click le decimos a vue que cuando el usuario haga click en el boton vue haga algo, en este caso usaremos la funcion de validar a la cual le debemos pasar por datos el $event  que ojo no es backend es algo de vue.-->
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


@section('script')
<script type="text/javascript">
    new Vue({
      el:'#app',
      data:{
        servicio:'{{$servicio->Nombre_Servicio}}' //con esto ligamos el v-model creando una variable que tenga el mismo nombre que usamos en el v-model y como ya le dimos control a vue le quietamos el control al backend quitando el value del input y poniendo que aca en la variable el backend genere el dato que queremos mostrar
      ,descripcion:'{{$servicio->Descripcion}}'
      ,precio:'{{$servicio->Precio}}'
      ,bandera:0
      ,mensaje:''
      }
      ,methods:{
        validar_formulario: function(event){
          this.bandera = 0;
          this.mensaje = '';
          //vamos a prender la this.bandera si un campo no está bien llenado
          if (this.servicio==''){
            this.bandera = 1;
            this.mensaje += "El campo Servicio no puede estar vacio "; 
          }

          if (this.descripcion==''){
            this.bandera=1;
            this.mensaje += "El campo Descripcion no puede estar vacio ";
          }
          //para validar numeros 
          if(this.precio==''){
            this.bandera=1;
            this.mensaje += "El capo Precio no puede estar vacio ";
          }
          else{
            temporal = parseInt(this.precio);
            if(!Number.isInteger(temporal)){
              this.bandera=1;
              this.mensaje += "En el campo precio se debe poner un valor numérico ";

            }
          }

          if (this.bandera == 1){
            event.preventDefault(); // con esta linea de codigo evitamos que envie informacion
          }
        },

        confirmacion:function(event){
          //con esto le decimos que cuando el usuario aprete cancelar se detenga el proceso.
          if(!confirm("¿Desea eliminar el servicio?")){
            event.preventDefault(); 
          }
        }
      }
    })
  </script>
@endsection
    