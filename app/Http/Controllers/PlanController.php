<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Protocolo;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$equipos= Equipo::all();  //Trae todos los registro
        $plans= Plan::orderBy('id','desc')->get();//paginate();
        
       // return $equipos;   //Sirve para ver la consulta
        return view('plans.index',compact('plans')); //Envío todos los registro en cuestión.La consulta va sin simbolo de pesos
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //$equipo=Equipo::find($id);
        $plan= Plan::find($id); // Ver la linea de abajo alternativa
        $protocolos= Plan::find($id)->plansProtocolos; // otra alternativa: $repuestos= Equipo::find($id)->equiposRepuestos; en una sola linea. 
         foreach($protocolos as $protocolo){
                $proto_id= $protocolo->pivot->proto_id; //busco el id del protocolo relacionado
                $protocolosParciales= Protocolo::find( $proto_id); // traigo la coleccion de ese protocolo
                $ProtocoloP[]=array('codProto'=> $protocolosParciales->codigo, 'descripcion'=> $protocolosParciales->descripcion);
                // $protocolosParciales= Protocolo::find(1);
                //echo "este protocolo es:" .  $protocolosParciales->codigo;
                $tareas=$protocolosParciales->protocolosTareas; // traigo todas las tareas de ese protocolo
            foreach($tareas as $tarea){
                // echo $plan->id . "*" . $protocolo->codigo . "*" . $tarea->codigo .  "*" .  $tarea->descripcion . "<br>";
                    
                  $Tareas[] =array('cod'=>$protocolosParciales->codigo, 'codigoTar' => $tarea->codigo, 'descripcion' => $tarea->descripcion, $tarea->duracion);
               
            }
           
         }  
           // LAs lineas siguientes fueron de practica arrays//
           /*
           var_export ($ProtocoloP);
            echo "<br>";
            echo "<br>";
           var_export ($Tareas);
           echo "<br>";
           echo "<br>";
           
           foreach($ProtocoloP as $protocolo){
           //echo key($P);
           echo $protocolo['codProto'];
           $Proto=$protocolo['codProto'];
           echo "<br>";
           foreach($Tareas as $Tarea){
            if($Proto==$Tarea['cod']){   
            echo $Tarea['cod'] . $Tarea['codigoTar'];
            echo "<br>";
            }
            } 
                  
            }*/
            

           
          return view('plans.show', compact('plan','ProtocoloP', 'Tareas'));  
          return ; //$Tareas ;// $matriz2;



    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    $equipo=Equipo::find($id);
        $protosTodos=Protocolo::all();
        
        $plan=Plan::find($id);
        $protocolos= Plan::find($id)->plansProtocolos; //"plansProtocolos" Metodo perteneciente al modelo Plan
       // $fotosTodos=Equipo::find($id)->fotos; //Aqui hago referencia al Metodo fotos perteneciente al modelo Equipo que trae los registro del modelo fotos vinculados a este equipo
        //$repuesto=$equipo->equiposRepuestos;
        //foreach($repuestos as $repuesto){
            //<p>factura: {{ $entrada->factura }}</p>
            //<p>fecha entrada: {{ $entrada->fecha }}</p>
            //if($repuesto->pivot->cant )
           // if(!is_null($repuesto->pivot->cant)){
            //echo  $repuesto->pivot->cant . '***' .$repuesto->codigo . '<br>';
            //}
      //  }
        //return $tareas;
        return view('plans.edit', compact('equipo','plan','protocolos', 'protosTodos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
