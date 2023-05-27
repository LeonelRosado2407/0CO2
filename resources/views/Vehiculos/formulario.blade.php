@extends('app.Master')
@section('estilo')
<style type="text/css">
      #dropzone{
        border-radius: 5px;
        padding: 40px;
        border-style: dashed;
      }
      .inactivo{
        background-color: #ade8f4;
        border-color: #023e8a;
      }
      .conarchivo{
        background-color: #d8f3dc;
        border-color: #2c6e49;
      }
      .leave{
        background-color: #fff3b0;
        border-color: #ffa200;
      }
      .invalido{
        background-color:#FFCCBC;
        border-color:#D84315 ;
      }
      #foto{
        display: none;
      }
      #carga_file{
        cursor: pointer;
      }
    </style>
@endsection

@section('titulo')
Registro de Vehículos
@endsection

@section('contenido')
    <div id="app" class="row">
      <div class="col-md-12 col-xs-12 col-sm-12">
        <!--con el codigo enctype="multiplataform/form-data habilitamos la posibiladad de subir archivos " -->
        <form enctype="multipart/form-data" action="{{action('VehiculoController@save')}}" method="POST">
          {{csrf_field()}}
            <!-- esta funcion es para que no mande error de token -->
          <div class="form-group">
            <!--ahora ligaremos los campos para que vue pueda tener control de ellos, para eso usamos el v-model="" -->
            <input type="hidden" class="form-control" value="{{$vehiculo->id_Vehiculo}}" name="id_Vehiculo">

            <div class="form-group">
              <label class="form-label" for="">Marca</label>
              <input type="text" class="form-control" v-model="marca" name="marca">
            </div>

            <div class="form-group">
              <label class="form-label" for="">Modelo</label>
              <input type="text" class="form-control" v-model="modelo" name="modelo">
            </div>

            <div class="form-group">
              <label class="form-label" for="">Placa</label>
              <input type="text" class="form-control" v-model="placa" name="placa">
            </div>

            <div class="form-group">
              <label class="form-label" for="">Año</label>
             <input type="text" class="form-control" v-model="year" name="año">
            </div>
            <div class="form-group">
              <label class="form-label" for="">Chofer</label>
             <!-- <input type="text" class="form-control" v-model="id_Chofer" name="idChofer" > -->
             <select class="form-control" v-model="id_Chofer" name="idChofer">
               <option  v-for="choferes in chofer" :value="choferes.id_Chofer" >@{{choferes.Nombres}}</option>
             </select>
            </div>

            <div class="form-group">
              <input type="file" 
                id="foto" 
                @change="onchange"
                ref="validacion"
                class="form-control" 
                name="foto"
                 
                >
              <div id="dropzone"
                @dragover="sobre($event)"
                @dragleave="fuera($event)" 
                @drop="drop($event)"
                :class="clase" 
                >
                Por favor de arrastrar el archivo o hacer click  <label class="form-label" id="carga_file" for="foto"><strong>Aquí</strong></label>
                <div v-show="nombre_archivo!=''">
                  <span>@{{nombre_archivo}}</span> <a @click="remove" href="#">Quitar</a>
                </div>
              </div>
              <img v-show="foto!=''" :src="url_image" width="200">
              
            </div>
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
        marca:'{{$vehiculo->Marca}}' //con esto ligamos el v-model creando una variable que tenga el mismo nombre que usamos en el v-model y como ya le dimos control a vue le quietamos el control al backend quitando el value del input y poniendo que aca en la variable el backend genere el dato que queremos mostrar
      ,modelo:'{{$vehiculo->Modelo}}'
      ,placa:'{{$vehiculo->Placa}}'
      ,year:'{{$vehiculo->Year}}'
      ,id_Chofer:'{{$vehiculo->id_Chofer}}'
      ,bandera:0
      ,chofer:<?php echo json_encode($chofer); ?>
      ,mensaje:''
      ,foto:'{{$vehiculo->Foto}}'
      // ,id_Chofer:'{{$vehiculo->id_Chofer}}'
      ,url_image:'{{URL::to("/")}}/'+'{{$vehiculo->Foto}}'
      ,nombre_archivo:''
      ,Tipos_permitidos:["image/jpeg","image/png","image/webp","image/bmp"]
      ,clase:{
        inactivo: true
        ,conarchivo: false
        ,leave:false
        ,invalido:false
      }
    }
      ,methods:{
        remove:function(){
          this.$refs.validacion.value='';
          this.nombre_archivo='';
          this.url_image='';
        },
        validar_formulario: function(event){
          this.bandera = 0;
          this.mensaje = '';
          //vamos a prender la this.bandera si un campo no está bien llenado
          if (this.marca==''){
            this.bandera=1;
            this.mensaje += "El campo Marca no puede estar vacio ";
          }
          if (this.modelo==''){
            this.bandera = 1;
            this.mensaje += "El campo Modelo no puede estar vacio "; 
          }

          if (this.placa==''){
            this.bandera=1;
            this.mensaje += "El campo Placa no puede estar vacio ";
          }
          
          //para validar numeros 
          if(this.year==''){
            this.bandera=1;
            this.mensaje += "El capo Año no puede estar vacio ";
          }
          else{
            temporal = parseInt(this.year);
            if(Number.isInteger(temporal)){
              if(temporal>2023 || temporal<1970){
                this.bandera=1;
                this.mensaje += "En el campo Año no esta entre 1970 y 2023 ";
              }
            }
            else{
            this.bandera=1;
            this.mensaje += "En el campo Año tiene que ser de tipo numerico ";
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
        },
        sobre:function(event){
          event.preventDefault();
          this.clase.leave=true;
          this.clase.invalido=false;
          this.clase.conarchivo=false;
          this.clase.inactivo=false;
        },

        fuera:function(event){
          event.preventDefault();
          this.clase.leave=false;
          this.clase.conarchivo=false;
          this.clase.invalido=false;
          this.clase.inactivo=true;
        },

        drop:function(event){
          event.preventDefault();
          this.$refs.validacion.files=event.dataTransfer.files;
          this.clase.leave=false;
          this.clase.conarchivo=true;
          this.clase.inactivo=true;
          this.clase.inactivo=false;
          this.onchange();
        },
        onchange:function(){
          ultimo = this.$refs.validacion.files.length-1;
          if(this.Tipos_permitidos.indexOf(this.$refs.validacion.files[ultimo].type)!=-1){
            this.nombre_archivo = this.$refs.validacion.files[ultimo].name;
            this.url_image=URL.createObjectURL(this.$refs.validacion.files[ultimo]);
            
          }
          else{
            this.clase.leave=false;
            this.clase.conarchivo=false;
            this.clase.inactivo=false;
            this.clase.invalido=true;
            alert('no se admite el archivo');
          }
          
        }
      }
    })
  </script>
@endsection
