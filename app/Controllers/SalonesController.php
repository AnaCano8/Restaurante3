<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SalonModel;


class SalonesController extends BaseController
{
    
     protected $helpers=['form'];
    public function index()
    {
        $model=new SalonModel();
        $data['salones']=$model->findAll();
        
        return view('salones/salonesListView',$data);
    }
    
    public function nuevo()
    {
        
        return view('salones/salonesNewView');
    }
    
    
     public function crear()
    {
		 if (session('role') !== 'Administrador') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado');
    }
       
         $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[salones.nombre]',
             'errors'=>[
                 'required'=>'Debes introducir un nombre',
                 'is_unique'=>'El nombre del salon ya existe',
             ]
         ],
			 'capacidad'=>[
             'rules'=>'required[salones.capacidad]',
             'errors'=>[
                 'required'=>'Debes introducir la capacidad',
             ]
         ],
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new SalonModel();
        $nombre=$this->request->getvar('nombre');
		$capacidad=$this->request->getvar('capacidad');
         
         $newData=[
             'nombre'=>$nombre,
			 'capacidad'=>$capacidad,
			 'created_at'=>date("Y-m-d h:i:s"),
             'updated_at'=>date("Y-m-d h:i:s")
         ];
         
         $model->save($newData);
         $this->registrarAuditoria('Creación de salon: ' . $nombre);
         
          return redirect()->to('/salones');
    }
    
    public function editar()
    {
		if (session('role') !== 'Administrador') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado');
    }
        $model=new SalonModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('salones/salonesEditView',$data);
    }
    
    public function actualizar()
    {
       
         $rules=[
         'nombre'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes introducir un nombre',
				 'is_unique'=>'El nombre ya existe',
               
             ]
         ],
			 'capacidad'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debe introducir la capacidad',
             ]
         ],
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new SalonModel();
		
        $id=$this->request->getvar('id');
        $nombre=$this->request->getvar('nombre');
		$capacidad=$this->request->getvar('capacidad');
        $model->where('id',$id)
            ->set([
				  'nombre'=>$nombre,
				  'capacidad'=>$capacidad,
				  'updated_at'=>date("Y-m-d h:i:s")
				  ])
            ->update();
		$this->registrarAuditoria('Actualización de salon: ' . $nombre);
         
         
          return redirect()->to('/salones');
    }
   
    
     public function delete()
    {
        $model=new SalonModel();
        $id=$this->request->getvar('id');
       
        $model->where('id', $id)->delete();
		 $this->registrarAuditoria('Eliminación de salon con ID: ' . $id);
         return redirect()->to('/salones');
    }
}
