<?php

namespace MainBundle\Controller;
use MainBundle\Entity\usuario;
use MainBundle\Entity\cliente;
use MainBundle\Entity\tratamiento;
use MainBundle\Form\tratamientoType;
use MainBundle\Form\tratamientoupdType;
use MainBundle\Entity\area;
use MainBundle\Form\usuarioType;
use MainBundle\Form\clienteType;
use MainBundle\Form\areaType;
use MainBundle\Form\areaupdType;
use MainBundle\Entity\tipom;
use MainBundle\Entity\Usuarios;
use MainBundle\Form\tipomType;
use MainBundle\Form\tipomupdType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	if($request->getMethod()=="POST")
    	{
    		$Correo=$request->get("Correo");
    		$Pwd=$request->get("Pwd");

    		$user=$this->getDoctrine()->getRepository('MainBundle:usuario')->findOneBy(array("correo"=>$Correo,"pwd"=>md5($Pwd)));
    		if($user)
    		{
               $session=$request->getSession();  //Obtiene los datos de la sesión
               $session->set("correo",$user->getcorreo()); //llama el comtenido desde la BD del correo
               $session->set("Activo",$user->getActivo());
               $session->set("tipoUsr",$user->gettipoUsr());

                if($session->get("Activo")==1)
                {
                            if($session->get("tipoUsr")==1) //si el tipo es administrador entonces abre MenuA.html.twig
                           {
                              return $this->render('MainBundle:Default:MenuA.html.twig'); //administrador
                           }
                           
                           if($session->get("tipoUsr")==0) //Si el tipo es usuario 1 entonces abre...
                           {
                              die("Operador"); //Herramentales
                           }

                           if($session->get("tipoUsr")==2) //Si el tipo es usuario 2 entonces abre...
                           {
                              die("Herramentales");
                           }
                           if($session->get("tipoUsr")==3) //Si el tipo es usuario 2 entonces abre...
                           {
                              die("Calidad");
                           }
                           if($session->get("tipoUsr")==4) //Si el tipo es usuario 2 entonces abre...
                           {
                              die("Diseño");
                           }
                }
                else // sino no deja pasar del login y manda mensaje de error en el mismo
                    {
                        $this->get('session')->getFlashBag()->add('mensaje','Acceso Bloqueado');
                        return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
                    }
               
               
    		}
    		else
    		{
    			$this->get('session')->getFlashBag()->add('mensaje','Correo o constraseña incorrectos.'); //Manda el mensaje de error y no deja pasar del login
    			
    			return $this-> redirect($this->generateUrl('main_homepage'));
    		}
    		
    	}
        return $this->render('MainBundle:Default:index.html.twig');
    }
    public function MenuAAction(Request $request)
    {
    	//esta seccion sera repetitiva para asegurar la seguridad del contenido restringido y solo en cuyos casos sea necesario.

    	//Inocia seccion de seguridad de contenido restringido
    	$session=$request->getSession(); //Obtiene los datos de la sesión	 
    	if($session->get("tipoUsr")==1 and $session->get("Activo")==1) //si se ha iniciado sesión como admin te deja pasar. 
    	//en caso de querer validar solo si ha iniciado sesion la instruccion seria ++ if($session->has("correo")) ++  el correo es el ID
    	{
    		 	 return $this->render('MainBundle:Default:MenuA.html.twig');
    	}
    	else // sino no deja pasar del login y manda mensaje de error en el mismo
    	{
    		  $this->get('session')->getFlashBag()->add('mensaje','Tienes que iniciar sesión tipo admin');
    			return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
    	}
    	//Termina seccion de seguridad de contenido restringido
       
    }
   
     public function CerrarSesionAction(Request $request)
    {
               $session = $request->getSession();
               $session->clear();
               $session->invalidate();
               $this->get('session')->getFlashBag()->add(
                'mensaje', 
                'Se ha cerrado la sesión exitosamente!');

              return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
             }
        public function usuarioAction(Request $request)
          {
                       //esta seccion sera repetitiva para asegurar la seguridad del contenido restringido y solo en cuyos casos sea necesario.

                    //Inocia seccion de seguridad de contenido restringido
                    $session=$request->getSession(); //Obtiene los datos de la sesión  
                    if($session->get("tipoUsr")==1 and $session->get("Activo")==1) //si se ha iniciado sesión como admin te deja pasar. 
                    //en caso de querer validar solo si ha iniciado sesion la instruccion seria ++ if($session->has("correo")) ++  el correo es el ID
                    {
                      $datos=$this->getDoctrine()-> getManager()->getRepository('MainBundle:Usuarios')->findAll();
                      
                     $paginator  = $this->get('knp_paginator');
                     $pagination= $paginator->paginate($datos,$request->query->getInt('page',1),4);          
                      return $this->render('MainBundle:Default:usuario.html.twig',array('pagination'=> $pagination));
                    }
                    else // sino no deja pasar del login y manda mensaje de error en el mismo
                    {
                        $this->get('session')->getFlashBag()->add('mensaje','Aceesos Bloqueado');
                        return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
                    }
          }
         public function addusrAction(Request $request) //formulario de insercion 
    {
      $session=$request->getSession(); //Obtiene los datos de la sesión  
                  if($session->get("tipoUsr")==1 and $session->get("Activo")==1) //si se ha iniciado sesión como admin te deja pasar. 
                  //en caso de querer validar solo si ha iniciado sesion la instruccion seria ++ if($session->has("correo")) ++  el correo es el ID
                  {
      $p=new usuario();
      $form =$this ->createForm(usuarioType:: class, $p);
      $form ->handleRequest($request);
      if($form->isValid())
      {
        $password =$form->get('pwd')->getData();
        $passMod=md5($password); //toma datos ingresados del formulario  y son modificados por algoritmo md5
       //hay que checar los videos de edson m. para poder poder agregar un nuevo function para poder dejar emn estado inicial la entidad llamada usuarios, es decir poder cambiar la modificacion del algoritmo md5 de la entidad principal. Esto ayudara a realizar de una manera más adecuada el formulario de edicion del mismo ya que en estos momentos cuenta con un error de validacion cundo se quiere modificar el registro pero el campo de contraseña no.
        $em=$this->getDoctrine()->getManager();
        $em->persist($p);
        $em->flush();
        $this->get('session')->getFlashBag()->add('mensaje','Usuario Agregado exitosamente.');
        return $this->redirect($this->generateUrl('usuario'));

      }
             return $this->render('MainBundle:Default:addusr.html.twig',array("form"=>$form->createView() ));
             }
             else
             {
              $this->get('session')->getFlashBag()->add('mensaje','Acceso Bloqueado');
              return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
             }
    }
            
    
     
    
    public function actusrAction($correo, Request $request)
    {
           
           $p=new usuario();
           $datos=$this->getDoctrine()->getRepository('MainBundle:usuario')->find("$correo");
           if(!$datos)
           {
            throw $this->createNotFoudException('usuario no encontrado'.$correo);   
            
           }
           $form =$this ->createForm(usuarioType:: class, $datos);
           $form ->handleRequest($request);
           if($form->isValid())
           {
            $password =$form->get('pwd')->getData();

            if(!empty($password))
            {
            $em= $this->getDoctrine()->getManager();

            }
            else
            {
              $em= $this->getDoctrine()->getManager();
              $recoverpass =$this->recoverpass($correo);
              $datos->setpwd($recoverpass[0]['pwd']);
              
              
            }
            $em->flush();
            $this->get('session')->getFlashBag()->add('mensaje','Registro Actualizado exitosamente.'); 
            return $this-> redirect($this->generateUrl('usuario')); 
           }
           return $this->render('MainBundle:Default:actusr.html.twig', array("form"=>$form->createView()));  
    } 

    private function recoverpass($correo)
    {
      $em=$this->getDoctrine()->getManager();
      $query=$em->createQuery(
        'select u.pwd 
        from MainBundle:usuario u 
        where u.correo= :correo')->setParameter('correo',$correo);
      $currentPass=$query->getResult();
      return $currentPass;
    }


    public function delusrAction($correo)
    { 
          $em= $this->getDoctrine()->getManager();
          $usuario=$em->getRepository('MainBundle:usuario')->find("$correo");
          if(!$usuario)
          {
            throw $this->createNotFoudException('usuario no encontrado'.$correo);   
          }
          $em->remove($usuario);
          $em->flush();
          $this->get('session')->getFlashBag()->add('mensaje','Registro eliminado exitosamente.'); 

          return $this-> redirect($this->generateUrl('usuario')); 
            
    }
        public function clienteAction(Request $request)
    { 
                    $session=$request->getSession(); //Obtiene los datos de la sesión  
                    if($session->get("tipoUsr")==1 and $session->get("Activo")==1) //si se ha iniciado sesión como admin te deja pasar. 
                    //en caso de querer validar solo si ha iniciado sesion la instruccion seria ++ if($session->has("correo")) ++  el correo es el ID
                    {

                      $datos=$this->getDoctrine()-> getManager()->getRepository('MainBundle:cliente')->findAll();
                      
                     $paginator  = $this->get('knp_paginator');
                     $pagination= $paginator->paginate($datos,$request->query->getInt('page',1),2);          
                      return $this->render('MainBundle:Client:cliente.html.twig',array('pagination'=> $pagination));
                    }
                    else // sino no deja pasar del login y manda mensaje de error en el mismo
                    {
                        $this->get('session')->getFlashBag()->add('mensaje','Aceesos Bloqueado');
                        return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
                    } 
         return $this->render('MainBundle:Client:cliente.html.twig');  
    }
    

     public function addcteAction(Request $request)
    { 
           $session=$request->getSession(); //Obtiene los datos de la sesión  
                  if($session->get("tipoUsr")==1 and $session->get("Activo")==1) //si se ha iniciado sesión como admin te deja pasar. 
                  //en caso de querer validar solo si ha iniciado sesion la instruccion seria ++ if($session->has("correo")) ++  el correo es el ID
                  {
      $p=new cliente();
      $form =$this ->createForm(clienteType:: class, $p);
      $form ->handleRequest($request);
      if($form->isValid())
      {
        
        $em=$this->getDoctrine()->getManager();
        $em->persist($p);
        $em->flush();
        $this->get('session')->getFlashBag()->add('mensaje','Cliente Agregado exitosamente.');
        return $this->redirect($this->generateUrl('cliente'));
      }
             return $this->render('MainBundle:Client:addcte.html.twig',array("form"=>$form->createView() ));
             }
             else
             {
              $this->get('session')->getFlashBag()->add('mensaje','Acceso Bloqueado');
              return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
             }          
        
    }
    public function delcteAction($rFCCte)
    { 
              
          $em= $this->getDoctrine()->getManager();
          $cliente=$em->getRepository('MainBundle:cliente')->find("$rFCCte");
          if(!$cliente)
          {
            throw $this->createNotFoudException('cliente no encontrado'.$rFCCte);   
          }
          $em->remove($cliente);
          $em->flush();
          $this->get('session')->getFlashBag()->add('mensaje','Registro eliminado exitosamente.'); 

          return $this-> redirect($this->generateUrl('cliente')); 
    }

    //
     public function updcteAction($rFCCte,Request $request)
    {
            $datos=$this->getDoctrine()->getRepository('MainBundle:cliente')->find("$rFCCte");
           if(!$datos)
           {
            throw $this->createNotFoudException('usuario no encontrado'.$rFCCte);    
           }
           $form =$this ->createForm(clienteType:: class, $datos);
           $form ->handleRequest($request);
           if($form->isValid())
           {
                $em= $this->getDoctrine()->getManager();
                $em->persist($datos);
                $em->flush();
                return $this-> redirect($this->generateUrl('cliente')); 
           }
           return $this->render('MainBundle:Client:updcte.html.twig', array("form"=>$form->createView()));
    } 

    public function tratamientoAction(Request $request)
    {
                    $session=$request->getSession();  
                    if($session->get("tipoUsr")==1 and $session->get("Activo")==1)
                    {
                     
                     $datos=$this->getDoctrine()-> getManager()->getRepository('MainBundle:tratamiento')->findAll();
                     $paginator  = $this->get('knp_paginator');
                     $pagination= $paginator->paginate($datos,$request->query->getInt('page',1),4);          
                      return $this->render('MainBundle:Tratamiento:tratamiento.html.twig',array('pagination'=> $pagination));
                    }
                    else
                    {
                      $this->get('session')->getFlashBag()->add('mensaje','Aceesos Bloqueado');
                      return $this-> redirect($this->generateUrl('main_homepage')); 
                    } 
         return $this->render('MainBundle:Tratamiento:tratamiento.html.twig');             
    }
     public function addtratAction(Request $request)
    {
       $session=$request->getSession();   
      if($session->get("tipoUsr")==1 and $session->get("Activo")==1)
     {
            $p=new tratamiento();
            $form =$this ->createForm(tratamientoType:: class, $p);
            $form ->handleRequest($request);
      if($form->isValid())
      {
        
        $em=$this->getDoctrine()->getManager();
        $em->persist($p);
        $em->flush();
        $this->get('session')->getFlashBag()->add('mensaje','Tratamiento Agregado exitosamente.');
        return $this->redirect($this->generateUrl('tratamiento'));
      }
             return $this->render('MainBundle:Tratamiento:addtrat.html.twig',array("form"=>$form->createView() ));
             }
             else
             {
              $this->get('session')->getFlashBag()->add('mensaje','Acceso Bloqueado');
              return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
             }          

    }

    public function deltratAction($idTrat)
    { 
              
          $em= $this->getDoctrine()->getManager();
          $tratamiento=$em->getRepository('MainBundle:tratamiento')->find("$idTrat");
          if(!$tratamiento)
          {
            throw $this->createNotFoudException('cliente no encontrado'.$idTrat);   
          }
          $em->remove($tratamiento);
          $em->flush();
          $this->get('session')->getFlashBag()->add('mensaje','Registro eliminado exitosamente.'); 

          return $this-> redirect($this->generateUrl('tratamiento')); 
    }

    //
     public function updtratAction($idTrat,Request $request)
    {
            $datos=$this->getDoctrine()->getRepository('MainBundle:tratamiento')->find("$idTrat");
           if(!$datos)
           {
            throw $this->createNotFoudException('tratamiento no encontrado'.$idTrat);    
           }
           $form =$this ->createForm(tratamientoupdType:: class, $datos);
           $form ->handleRequest($request);
           if($form->isValid())
           {
                $em= $this->getDoctrine()->getManager();
                $em->persist($datos);
                $em->flush();
                $this->get('session')->getFlashBag()->add('mensaje','Tratamiento actualizado exitosamente.');
                return $this-> redirect($this->generateUrl('tratamiento')); 
           }
           return $this->render('MainBundle:Tratamiento:updtrat.html.twig', array("form"=>$form->createView()));
    } 

     public function AreaAction(Request $request)
    {
               $session=$request->getSession();  
                    if($session->get("tipoUsr")==1 and $session->get("Activo")==1)
                    {

                     $datos=$this->getDoctrine()-> getManager()->getRepository('MainBundle:area')->findAll();
                     $paginator  = $this->get('knp_paginator');
                     $pagination= $paginator->paginate($datos,$request->query->getInt('page',1),2);          
                      return $this->render('MainBundle:Area:Area.html.twig',array('pagination'=> $pagination));
                    }
                    else
                    {
                      $this->get('session')->getFlashBag()->add('mensaje','Aceesos Bloqueado');
                      return $this-> redirect($this->generateUrl('main_homepage')); 
                    } 
         return $this->render('MainBundle:Area:Area.html.twig');                   
       
    }

     public function addareaAction(Request $request)
    {
       $session=$request->getSession();   
      if($session->get("tipoUsr")==1 and $session->get("Activo")==1)
     {
            $p=new area();
            $form =$this ->createForm(areaType:: class, $p);
            $form ->handleRequest($request);
      if($form->isValid())
      {
        
        $em=$this->getDoctrine()->getManager();
        $em->persist($p);
        $em->flush();
        $this->get('session')->getFlashBag()->add('mensaje','Area Agregada exitosamente.');
        return $this->redirect($this->generateUrl('Area'));
      }
             return $this->render('MainBundle:Area:addarea.html.twig',array("form"=>$form->createView() ));
             }
             else
             {
              $this->get('session')->getFlashBag()->add('mensaje','Acceso Bloqueado');
              return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
             }          

    }

public function delareaAction($isarea)
    { 
              
          $em= $this->getDoctrine()->getManager();
          $area=$em->getRepository('MainBundle:area')->find("$isarea");
          if(!$area)
          {
            throw $this->createNotFoudException('area no encontrado'.$isarea);   
          }
          $em->remove($area);
          $em->flush();
          $this->get('session')->getFlashBag()->add('mensaje','Registro eliminado exitosamente.'); 

          return $this-> redirect($this->generateUrl('Area')); 
    }

    public function updareaAction($isarea,Request $request)
    {
            $datos=$this->getDoctrine()->getRepository('MainBundle:area')->find("$isarea");
           if(!$datos)
           {
            throw $this->createNotFoudException('usuario no encontrado'.$isarea);    
           }
           $form =$this ->createForm(areaupdType:: class, $datos);
           $form ->handleRequest($request);
           if($form->isValid())
           {
                $em= $this->getDoctrine()->getManager();
                $em->persist($datos);
                $em->flush();
                $this->get('session')->getFlashBag()->add('mensaje','Registro Actualizado exitosamente.'); 
                return $this-> redirect($this->generateUrl('Area')); 
           }
           return $this->render('MainBundle:Area:updarea.html.twig', array("form"=>$form->createView()));
    } 
public function TipoMaterialAction(Request $request)
    {
           $session=$request->getSession();  
                    if($session->get("tipoUsr")==1 and $session->get("Activo")==1)
                    {
                     $datos=$this->getDoctrine()-> getManager()->getRepository('MainBundle:tipom')->findAll();
                     $paginator  = $this->get('knp_paginator');
                     $pagination= $paginator->paginate($datos,$request->query->getInt('page',1),2);          
                      return $this->render('MainBundle:TipoMaterial:TipoMaterial.html.twig',array('pagination'=> $pagination));
                    }
                    else
                    {
                      $this->get('session')->getFlashBag()->add('mensaje','Aceesos Bloqueado');
                      return $this-> redirect($this->generateUrl('main_homepage')); 
                    } 
         return $this->render('MainBundle:TipoMaterial:TipoMaterial.html.twig');              
    }

    public function addtmatAction(Request $request)
    {
       $session=$request->getSession();   
      if($session->get("tipoUsr")==1 and $session->get("Activo")==1)
     {
            $p=new tipom();
            $form =$this ->createForm(tipomType:: class, $p);
            $form ->handleRequest($request);
      if($form->isValid())
      {
        $em=$this->getDoctrine()->getManager();
        $em->persist($p);
        $em->flush();
        $this->get('session')->getFlashBag()->add('mensaje','Campo Agregado exitosamente.');
        return $this->redirect($this->generateUrl('tiposmate'));
      }
             return $this->render('MainBundle:TipoMaterial:addtmat.html.twig',array("form"=>$form->createView() ));
             }
             else
             {
              $this->get('session')->getFlashBag()->add('mensaje','Acceso Bloqueado');
              return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
             }          

    }
    public function deltmatAction($idTipoM)
    { 
              
          $em= $this->getDoctrine()->getManager();
          $registro=$em->getRepository('MainBundle:tipom')->find("$idTipoM");
          if(!$registro)
          {
            throw $this->createNotFoudException('Elemento no encontrado'.$idTipoM);   
          }
          $em->remove($registro);
          $em->flush();
          $this->get('session')->getFlashBag()->add('mensaje','Registro eliminado exitosamente.'); 

          return $this-> redirect($this->generateUrl('tiposmate')); 
    }
    public function updtmatAction($idTipoM,Request $request)
    {
            $datos=$this->getDoctrine()->getRepository('MainBundle:tipom')->find("$idTipoM");
           if(!$datos)
           {
            throw $this->createNotFoudException('Registro no encontrado'.$idTipoM);    
           }
           $form =$this ->createForm(tipomupdType:: class, $datos);
           $form ->handleRequest($request);
           if($form->isValid())
           {
                $em= $this->getDoctrine()->getManager();
                $em->persist($datos);
                $em->flush();
                $this->get('session')->getFlashBag()->add('mensaje','Registro Actualizado exitosamente.'); 
                return $this-> redirect($this->generateUrl('tiposmate')); 
           }
           return $this->render('MainBundle:TipoMaterial:updtmat.html.twig', array("form"=>$form->createView()));
    } 


  }
    
      

