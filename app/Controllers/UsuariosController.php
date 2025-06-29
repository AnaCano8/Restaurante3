<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\RoleModel;
use App\Models\UsuarioModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UsuariosController extends BaseController
{
    
     protected $helpers=['form','comprobar'];
    public function index()
    {
        $model=new UsuarioModel();
        $data['usuarios']=$model->findAll();
        
        return view('usuarios/usuariosListView',$data);
    }
    
    public function nuevo()
    {
        
        $options=array();
        $options['']="--Select--";
        
        $modelRole=new RoleModel();
        $roles=$modelRole->findAll();
        foreach($roles as $role){
            $options[$role["id"]]=$role["role"];
        }
        $data["optionsRoles"]=$options;
        
        return view('usuarios/usuariosNewView',$data);
    }
    
    
     public function crear()
    {
       
        if (session('role') !== 'Administrador') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado');
    }
         
         $rules=[
         'usuario'=>[
             'rules'=>'required|is_unique[usuarios.usuario]',
             'errors'=>[
                 'required'=>'Debes introducir un usuario',
                 'is_unique'=>'El nombre del usuario ya existe',
             ]
         ],
          'id_roles'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes seleccionar un role',
             ]
         ],  
      'password'=>[
             'password'=>'required',
             'errors'=>[
                 'required'=>'Debes introducir una contraseña',
             ]
         ],  
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
          //SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1
        $model=new UsuarioModel();
        $id_roles=$this->request->getvar('id_roles');
         $usuario=$this->request->getvar('usuario');
         $password=md5($this->request->getvar('password'));
         $email=$this->request->getvar('email');
         
         $newData=[
             'id_roles'=>$id_roles
             ,'usuario'=>$usuario
             ,'password'=>$password
             ,'email'=>$email
             ,'created_at'=>date("Y-m-d h:i:s")
             ,'updated_at'=>date("Y-m-d h:i:s")
         ];
         
         $model->save($newData);
         $this->registrarAuditoria('Creación de usuario: ' . $usuario);
         
          return redirect()->to('/usuarios');
    }
    
    public function editar()
    {
		if (session('role') !== 'Administrador') {
        return redirect()->to('/')->with('error', 'Acceso no autorizado');
    }
		
        $model=new UsuarioModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
         $options=array();
        $options['']="--Select--";
        
        $modelRole=new RoleModel();
        $roles=$modelRole->findAll();
        foreach($roles as $role){
            $options[$role["id"]]=$role["role"];
        }
        $data["optionsRoles"]=$options;
        
        return view('usuarios/usuariosEditView',$data);
    }
    
    public function actualizar()
    {
       
         $rules=[
         'usuario'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes introducir un usuario',
                 'is_unique'=>'El nombre del usuario ya existe',
             ]
         ],
          'id_roles'=>[
             'rules'=>'required',
             'errors'=>[
                 'required'=>'Debes seleccionar un role',
             ]
         ],  
      'password'=>[
             'password'=>'required',
             'errors'=>[
                 'required'=>'Debes introducir una contraseña',
             ]
         ],  
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new UsuarioModel();
        $id=$this->request->getvar('id');    
        $id_roles=$this->request->getvar('id_roles');
         $usuario=$this->request->getvar('usuario');
         $password=md5($this->request->getvar('password'));
         $email=$this->request->getvar('email');
        $model->where('id',$id)
            ->set(['id_roles'=>$id_roles,'usuario'=>$usuario,'password'=>$password,'email'=>$email,'updated_at'=>date("Y-m-d h:i:s")])
            ->update();
		$this->registrarAuditoria('Actualización de usuario: ' . $usuario);
         
         
          return redirect()->to('/usuarios');
    }
   
    
     public function delete()
    {
        $model=new UsuarioModel();
        $id=$this->request->getvar('id');
       
       if ($model->where('id', $id)->delete()) {
    $this->registrarAuditoria('Eliminación de usuario con ID: ' . $id);
    echo 1;
} else {
    echo 0;
}
        // return redirect()->to('/roles');
    }
    
    public function exportar()
    {
        $model=new UsuarioModel();
        $usuarios=$model->findAll();
        //`id_roles`, `usuario`, `password`, `email`
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
        
            $sheet->setCellValue('A1', 'Role');
            $sheet->setCellValue('B1', 'usuario');
            $sheet->setCellValue('C1', 'password');
            $sheet->setCellValue('D1', 'email');
            $count=2;
            foreach($usuarios as $usuario){
                $sheet->setCellValue('A'.$count, $usuario['id_roles']);
                $sheet->setCellValue('B'.$count, $usuario['usuario']);
                $sheet->setCellValue('C'.$count, $usuario['password']);
                $sheet->setCellValue('D'.$count, $usuario['email']);
                $count++;
            }
        
        
        $writer = new Xlsx($spreadsheet);
            $writer->save('usuarios.xlsx');
            header("Content-Type:   application/vnd.ms-excel");
            header("Content-Disposition:attachment; filename=usuarios.xlsx");
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate");
            header("Content-Length: ".filesize("usuarios.xlsx"));
            flush();
            readfile("usuarios.xlsx");
		$this->registrarAuditoria('Exportación de usuarios');
            exit;
        
            
    }
    
     
}
