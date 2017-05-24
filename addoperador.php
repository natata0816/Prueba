public function addoperadorAction(Request $request)
    {
       

       $session=$request->getSession();   
      if($session->get("tipoUsr")==1 and $session->get("Activo")==1)
     {
            $p=new operador();
            $form =$this ->createForm(operadorType:: class, $p);
            $form ->handleRequest($request);
      if($form->isValid())
      {
        $em=$this->getDoctrine()->getManager();
        $em->persist($p);
        $em->flush();
        $this->get('session')->getFlashBag()->add('mensaje','Campo Agregado exitosamente.');
        return $this->redirect($this->generateUrl('operador'));
      }
             return $this->render('MainBundle:Operador:addoperador.html.twig',array("form"=>$form->createView() ));
             }
             else
             {
              $this->get('session')->getFlashBag()->add('mensaje','Acceso Bloqueado');
              return $this-> redirect($this->generateUrl('main_homepage')); //redirecciona al login
             }          

    }
