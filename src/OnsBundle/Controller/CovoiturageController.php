<?php

namespace OnsBundle\Controller;

use OnsBundle\Entity\Covoiturage;
use OnsBundle\Entity\Reservation;
use OnsBundle\OnsBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Covoiturage controller.
 *
 */
class CovoiturageController extends Controller
{
    /**
     * Lists all covoiturage entities.
     *
     */
    public function indexAction(Request $request)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();

        }
        $em = $this->getDoctrine()->getManager();

//        $covoiturages = $em->getRepository('OnsBundle:Covoiturage')->findAll();
        $covoiturages = $em->getRepository('OnsBundle:Covoiturage')->findCovoiturage($user);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $covoiturages,
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/);

        return $this->render('@Ons/covoiturage/index.html.twig', array("user"=>$user,
            "covoiturages"=>$pagination
        ));
    }
    public function consulterCovoiturageAction($id)
    {

        $cons = $this->getDoctrine()->getRepository('OnsBundle:Covoiturage')->find($id);
        return $this->render('@Ons/covoiturage/show.html.twig',array('cons'=>$cons));
    }
    /**
     * Creates a new covoiturage entity.
     *
     */
    public function newAction(Request $request)
    {

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();

        }
        $covoiturage= new Covoiturage();
        $em=$this->getDoctrine()->getManager();
        if($request->isMethod('POST')){

            $covoiturage->setIdetudiant($user);
            $covoiturage->setDepart($request->get('Depart'));
            $covoiturage->setArrive($request->get('Arrive'));
            $covoiturage->setNumTel($request->get('NumTel'));
            $covoiturage->setType($request->get('type'));
            $covoiturage->setPrix($request->get('prix'));
            $covoiturage->setNbrPlace($request->get('nombrePlaces'));
            $covoiturage->setNbrRes(0);
            $covoiturage->setTemps($request->get('temps'));



            $em->persist(($covoiturage));
            $em->flush();

        }

        return $this->render('@Ons/covoiturage/ajout.html.twig',array());
    }

    /**
     * Finds and displays a covoiturage entity.
     *
     */
    public function showAction(Covoiturage $covoiturage)
    {
        $deleteForm = $this->createDeleteForm($covoiturage);

        return $this->render('covoiturage/show.html.twig', array(
            'covoiturage' => $covoiturage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing covoiturage entity.
     *
     */
    public function editAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        if($request->isMethod('GET')){

            $idcov= $request->get('id');
            $covoiturage=$em->getRepository("OnsBundle:Covoiturage")->find($idcov);
            return $this->render('@Ons/covoiturage/updateCovoiturage.html.twig',array("covoiturage"=>$covoiturage));
        }
        if($request->isMethod('POST')){

            $idCov= $request->get('id');
            $covoiturage=$em->getRepository("OnsBundle:Covoiturage")->find($idCov);
            $covoiturage->setDepart($request->get('Depart'));
            $covoiturage->setArrive($request->get('Arrive'));
            $covoiturage->setNumTel($request->get('NumTel'));
            $covoiturage->setType($request->get('type'));
            $covoiturage->setPrix($request->get('prix'));
            $covoiturage->setTemps($request->get('temps'));
            $em->flush();

        }
        return $this->redirectToRoute('covoiturage_moncov');
    }

    /**
     * Deletes a covoiturage entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $cov = $em->getRepository('OnsBundle:Covoiturage')->find($id);
        $em->remove($cov);
        $em->flush();

        return $this->redirectToRoute('covoiturage_moncov');
    }

    public function ReserverAction(Request $request)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }


        $sn =$this->getDoctrine()->getManager();
        $em1=$this->getDoctrine()->getManager();




        $idcovoiturage= $request->get('idcovoiturage'); //tab covoiturage



        $idCov = $sn->getRepository('OnsBundle:Covoiturage')->find($idcovoiturage);

        $res=new Reservation();
        $res->setIdCovoiturage($idCov);
        $res->setIdetudiant($user);



        $em1->persist($res);
        $em1->flush();

        $covoiturageC = $sn->getRepository("OnsBundle:Covoiturage")->find($idCov);
        $covoiturageC->setNbrRes($covoiturageC->getNbrRes() + 1);

        $sn->flush();


        return $this->redirectToRoute('covoiturage_index') ;

    }

    public function chercherCleCovoiturageAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $em1=$this->getDoctrine()->getManager();
        if($request->isMethod('GET')) {

            $cle = $request->get('cle');
            if ($cle == "") {
                $covoiturages=$em->getRepository("OnsBundle:Covoiturage")->findby(array(),array('idcovoiturage'=>'DESC'));
            } else {

                $covoiturages = $em1->getRepository("OnsBundle:Covoiturage")->createQueryBuilder('covoiturages')
                    ->where('covoiturages.idcovoiturage LIKE :idCov')
                    ->orWhere('covoiturages.Depart LIKE :depart')
                    ->orWhere('covoiturages.Arrive LIKE :arrive')
                    ->orWhere('covoiturages.temps LIKE :dateDepart')
                    ->setParameter('idCov', $cle)
                    ->setParameter('depart', '%'.$cle.'%')
                    ->setParameter('arrive', '%'.$cle.'%')
                    ->setParameter('dateDepart', '%'.$cle.'%')
                    ->getQuery()
                    ->getResult();
            }
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $covoiturages,
                $request->query->getInt('page', 1)/*page number*/,
                5/*limit per page*/);
        }



        return $this->render('@Ons/covoiturage/chercherCovoiturageCle.html.twig',array("covoiturages"=>$pagination)

        );
    }

    public function mesCovoiturageAction(Request $request){

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }


        $sn =$this->getDoctrine()->getManager();

        $monannonce = $sn->getRepository('OnsBundle:Covoiturage')->findBy(array('idetudiant'=>$user));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $monannonce,
            $request->query->getInt('page', 1),
            6);

        return $this->render('@Ons/covoiturage/MonCov.html.twig',array("covoiturage"=>$pagination));

    }

    public function mesReservationAction(Request $request){

        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }


        $sn =$this->getDoctrine()->getManager();

        $monres = $sn->getRepository('OnsBundle:Reservation')->findBy(array('idetudiant'=>$user));

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $monres,
            $request->query->getInt('page', 1),
            6);

        return $this->render('@Ons/reservation/MonRes.html.twig',array("reservation"=>$pagination));

    }

    public function cancelAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();

        $res = $em->getRepository('OnsBundle:Reservation')->find($id);
        $cov = $em->getRepository('OnsBundle:Covoiturage')->find($res->getIdCovoiturage());
        $cov->setNbrRes($cov->getNbrRes()-1);
        $em->remove($res);
        $em->flush();

        return $this->redirectToRoute('reservation_monres');
    }

}
