<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\MenuModel;


class MenusController extends BaseController
{
    
     protected $helpers=['form'];
    public function index()
    {
        $model=new MenuModel();
        $data['menus']=$model->findAll();
        
        return view('menus/menusListView',$data);
    }
    
    public function nuevo()
    {
        
        return view('menus/menusNewView');
    }
    
    
     public function crear()
    {
		 if (session('role') !== 'Administrador') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado');
    }
       
         $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[menus.nombre]',
             'errors'=>[
                 'required'=>'Debes introducir un nombre',
                 'is_unique'=>'El nombre del menu ya existe',
             ]
         ],
			 'tipo_evento'=>[
             'rules'=>'required[menus.tipo_evento]',
             'errors'=>[
                 'required'=>'Debes introducir un tipo de evento',
             ]
         ],
			 'descripcion'=>[
             'rules'=>'required[menus.descripcion]',
             'errors'=>[
                 'required'=>'Debes introducir la descripcion',
             ]
         ],
			 'precio'=>[
             'rules'=>'required[menus.precio]',
             'errors'=>[
                 'required'=>'Debes introducir el precio',
             ]
         ],
           
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new MenuModel();
        $nombre=$this->request->getvar('nombre');
		$descripcion=$this->request->getvar('descripcion');
		$precio=$this->request->getvar('precio');
         
         $newData=[
             'nombre'=>$nombre,
             'tipo_evento'=>$tipo_evento,
			 'descripcion'=>$descripcion,
			 'precio'=>$precio,
			 'created_at'=>date("Y-m-d h:i:s"),
             'updated_at'=>date("Y-m-d h:i:s")
         ];
         
         $model->save($newData);
         
         $this->registrarAuditoria('Creación de menú: ' . $nombre);
          return redirect()->to('/menus');
    }
    
    public function editar()
    {
		if (session('role') !== 'Administrador') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado');
    }
        $model=new MenuModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('menus/menusEditView',$data);
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
			 'descripcion'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debe introducir la descripcion',
             ]
         ],
			 'tipo_evento'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debe introducir un tipo de evento',
             ]
         ],
			 'precio'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debe introducir el precio',
             ]
         ],
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new MenuModel();
		
        $id=$this->request->getvar('id');
        $nombre=$this->request->getvar('nombre');
		$tipo_evento=$this->request->getvar('tipo_evento');
		$descripcion=$this->request->getvar('descripcion');
		$precio=$this->request->getvar('precio');
        $model->where('id',$id)
            ->set([
				  'nombre'=>$nombre,
				  'descripcion'=>$descripcion,
				  'tipo_evento'=>$tipo_evento,
				  'precio'=>$precio,
				  'updated_at'=>date("Y-m-d h:i:s")
				  ])
            ->update();
		$this->registrarAuditoria('Actualización de menú: ' . $nombre);
         
         
          return redirect()->to('/menus');
    }
   
    
     public function delete()
    {
        $model=new MenuModel();
        $id=$this->request->getvar('id');
       
        $model->where('id', $id)->delete();
		 $this->registrarAuditoria('Eliminación de menú con ID: ' . $id);
         return redirect()->to('/menus');
    }
	public function filtrarPorTipo($tipo_evento)
{
    $model = new MenuModel();
    $menus = $model->where('tipo_evento', $tipo_evento)->findAll();
    return $this->response->setJSON($menus);
}
}
