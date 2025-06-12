<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\RoleModel;


class RolesController extends BaseController
{
    
     protected $helpers=['form'];
    public function index()
    {
        $model=new RoleModel();
        $data['roles']=$model->findAll();
        
        return view('roles/rolesListView',$data);
    }
    
    public function nuevo()
    {
        
        return view('roles/rolesNewView');
    }
    
    
     public function crear()
    {
		 if (session('role') !== 'Administrador') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado');
    }
       
         $rules=[
         'role'=>[
             'rules'=>'required|is_unique[roles.role]',
             'errors'=>[
                 'required'=>'Debes introducir un role',
                 'is_unique'=>'El nombre del role ya existe',
             ]
         ],
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new RoleModel();
        $role=$this->request->getvar('role');
         
         $newData=[
             'role'=>$role
         ];
         
         $model->save($newData);
		 $this->registrarAuditoria('Creación de role: ' . $role);
         
         
          return redirect()->to('/roles');
    }
    
    public function editar()
    {
		if (session('role') !== 'Administrador') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado');
    }
        $model=new RoleModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('roles/rolesEditView',$data);
    }
    
    public function actualizar()
    {
       
         $rules=[
         'role'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes introducir un role',
               
             ]
         ],
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new RoleModel();
        $role=$this->request->getvar('role');
        $id=$this->request->getvar('id');
        $model->where('id',$id)
            ->set(['role'=>$role])
            ->update();
		$this->registrarAuditoria('Actualización de role: ' . $role);
         
         
          return redirect()->to('/roles');
    }
   
    
     public function delete()
    {
        $model=new RoleModel();
        $id=$this->request->getvar('id');
       
        $model->where('id', $id)->delete();
		 $this->registrarAuditoria('Eliminación del role con ID: ' . $id);
         return redirect()->to('/roles');
    }
}
