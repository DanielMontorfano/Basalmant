@extends('layouts.plantilla')
@section('title', 'Ordenes sobre' . " " . $equipo->codEquipo)
@section('css')
{{-- https://datatables.net/ **IMPORTANTE PLUG IN PARA LAS TABLAS --}}
{{-- Para que sea responsive se agraga la tercer libreria --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">
@endsection

@section('content')

{{-- comment --}}
<h1></h1>
{{-- https://datatables.net/ **IMPORTANTE PLUG IN PARA LAS TABLAS --}}
{{-- <a href="/Equipos/crear" > Crear curso</a> **Laravel no recomienda direccionar asi--}}


<div class="card" STYLE="background: linear-gradient(to right,#495c5c,#030007);">

  <div class="card-header" STYLE="background: linear-gradient(to right,#1e2020,#030007);">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link" href="{{route('equipos.show', $equipo->id)}}">Ficha</a>
      </li>
      <li class="nav-item">
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('fotos.show', $equipo->id)}}">Fotos</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('equipos.index')}}">Historial</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('equipos.index')}}">Protocolo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('equipos.index')}}">Plan</a>
      
      <li class="nav-item">
        <a class="nav-link" href="{{route('equipos.index')}}">Documentos</a>
      </li>
      <li class="nav-item" >
        <a class="nav-link" href={{route('equipos.edit', $equipo->id)}}>Editar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" style="background-color: #1e2020;" aria-current="true"  href={{route('ordentrabajo.list', $equipo->id)}}>OT</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="{{route('equipos.index')}}">Descargar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('equipos.index')}}">Imprimir</a>
      </li>
      

    </ul>
  </div>
  
  <h6 STYLE="text-align:center; font-size: 30px;
  background: -webkit-linear-gradient(rgb(1, 103, 71), rgb(239, 236, 217));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;">Listado de ordenes de {{$equipo->codEquipo}}</h6>

  

<div class="card-body "  style="max-width: 95;">
<div class="text-white card-body "  style="max-width: 95;">
<p ><a  class="text-white " href={{route('ordentrabajo.createorden', $equipo->id)}}> Crear Orden de trabajo</a></p> 
<div class="dropdown">
  <a title="Reportes" class=" fa-solid fa-screwdriver-wrench btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="{{ route('ordentrabajo.createorden', $equipo->id) }}">Crear una orden</a>
        <a class="dropdown-item" href="{{ route('ordentrabajo.edit', $equipo->id) }}">Cerrar una orden</a>
        <a class="dropdown-item" href="{{ route('historialTodos', $equipo->id) }}">Ambos</a>
      </div>
</div>
<br>



<table id="listado" class="table table-striped table-success  table-hover border-4" >
    <thead class="table-dark" >
        <td>Nº de Orden</td>
        <td>Solicitante/Receptor</td>
        <td>Fecha de apertura</td>
        <td>Estado</td>
        <td>Fecha de cierre</td>
        
       
    <tbody>
      @foreach ($ots_e as $ot)
      <tr>
        <td><a title="{{$ot->det1}}" href="{{route('ordentrabajo.show', $ot->id)}}">{{$ot->id}}</a></td>
        <td>{{$ot->solicitante}}/{{$ot->asignadoA}}</td>
        <td>{{$ot->created_at}}</td>
        <td> <a href="{{route('ordentrabajo.showCerrar', $ot->id)}}">{{$ot->estado}}</a></td>
        <td>{{$ot->updated_at}}</td>
    
      </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
{{-- Para hacer resposive necesito agregar las 2 ultimas librerias --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"</script>
<script>src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"</script>




<script>
    $(document).ready(function () {
    $('#equipos').DataTable({
      
      reponsive: true,
      autoWidth: false,
      
      "language": {
            "lengthMenu": "Mostrar _MENU_",
            "zeroRecords": "No se encontró ningún registro - disculpe",
            "info": "Viendo _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrados desde _MAX_ total registros)",
            "search":"Buscar:",
            "paginate":{
            "next":"Siguiente",
            "previous":"Anterior"
          }

        }
    });
});
</script>



@endsection


