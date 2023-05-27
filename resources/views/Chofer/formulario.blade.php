@extends('app.Master')

@section('titulo')
Registro Choferes
@endsection

@section('contenido')
<div id="app" class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <form action="{{action('ChoferController@save')}}" method="POST">
          {{csrf_field()}}
            <!-- esta funcion es para que no mande error de token -->
          <div class="form-group">
            <!--ahora ligaremos los campos para que vue pueda tener control de ellos, para eso usamos el v-model="" -->
            <input type="hidden" class="form-control" value="{{$chofer->id_Chofer}}" name="id_Chofer">
            <label class="form-label" for="">Nombres</label>
            <input type="text" class="form-control" v-model="nombres" name="nombres">
            <label class="form-label" for="">Apellidos</label>
            <input type="text" class="form-control" v-model="apellidos" name="apellidos">
            <label class="form-label" for="">Edad</label>
            <input type="text" class="form-control" v-model="edad" name="edad">
            <label class="form-label" for="">CURP</label>
            <input type="text" class="form-control" v-model="curp" name="curp">
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
        nombres:'{{$chofer->Nombres}}' //con esto ligamos el v-model creando una variable que tenga el mismo nombre que usamos en el v-model y como ya le dimos control a vue le quietamos el control al backend quitando el value del input y poniendo que aca en la variable el backend genere el dato que queremos mostrar
      ,apellidos:'{{$chofer->Apellidos}}'
      ,edad:'{{$chofer->Edad}}'
      ,curp:'{{$chofer->CURP}}'
      ,bandera:0
      ,mensaje:''
      }
      ,methods:{
        validar_formulario: function(event){
          this.bandera = 0;
          this.mensaje = '';
          //vamos a prender la this.bandera si un campo no está bien llenado
          if (this.nombres==''){
            this.bandera=1;
            this.mensaje += "El campo Nombres no puede estar vacio ";
          }
          if (this.apellidos==''){
            this.bandera = 1;
            this.mensaje += "El campo Apellidos no puede estar vacio "; 
          }

          if (this.edad==''){
            this.bandera=1;
            this.mensaje += "El campo Edad no puede estar vacio ";
          }
          else{
            temporal = parseInt(this.edad);
            if(!Number.isInteger(temporal)){
              this.bandera=1;
              this.mensaje += "En el campo Edad tiene que ser de tipo numerico ";
            }
          }

          if (this.curp==''){
            this.bandera=1;
            this.mensaje += "El campo CURP no puede estar vacio ";
          }
          
          if (this.bandera == 1){
            event.preventDefault(); // con esta linea de codigo evitamos que envie informacion
            console.log(this.bandera)
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
    
