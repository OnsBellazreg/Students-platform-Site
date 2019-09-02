<?php

namespace AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Admin/Default/index.html.twig');
    }

    public function listDemandeAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $demandes = $em->getRepository('OnsBundle:Demande')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $demandes,
            $request->query->getInt('page', 1),
            5);

        return $this->render('@Admin/foyer/listDemande.html.twig', array(
            'demandes' => $pagination, 'foyers'=>$pagination
        ));

    }
    public function accepterAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $idDemande= $request->get('id');
        $demande=$em->getRepository("OnsBundle:Demande")->find($idDemande);
        $demande->setStatus(1);
        $em->flush();
        return $this->redirectToRoute('admin_listDemande') ;
    }
    public function refuserAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $idDemande= $request->get('id');
        $demande=$em->getRepository("OnsBundle:Demande")->find($idDemande);
        $demande->setStatus(-1);
        $em->flush();
        return $this->redirectToRoute('admin_listDemande') ;
    }

    public function searchAction(){


        $this->render('@Admin/foyer/search.html.twig');
    }
}