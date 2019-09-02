<?php

namespace OnsBundle\Controller;

use OnsBundle\Entity\Demande;
use OnsBundle\Entity\Foyer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Foyer controller.
 *
 */
class FoyerController extends Controller
{
    /**
     * Lists all foyer entities.
     *
     */
    public function indexAction(Request $request)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();

        }
        $em = $this->getDoctrine()->getManager();

        $foyers = $em->getRepository('OnsBundle:Foyer')->findFoyers($user);

//        $statu= $request->get('status');
//        $demande = $em->getRepository('OnsBundle:Demande')->find($statu);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $foyers,
            $request->query->getInt('page', 1),
            3);

        return $this->render('@Ons/foyer/listFoyerUser.html.twig', array("user"=>$user,
            'foyers' => $pagination
        ));
    }

    /**
     * Creates a new foyer entity.
     *
     */
    public function newAction(Request $request)
    {
        $foyer= new foyer();
        $em=$this->getDoctrine()->getManager();
        if($request->isMethod('POST')){


            $foyer->setNomfoyer($request->get('nomfoyer'));
            $foyer->setResponsable($request->get('responsable'));
            $foyer->setAdresse($request->get('adresse'));
            $foyer->setEmail($request->get('email'));
            $foyer->setNbrPlace($request->get('nbrPlaces'));
            $foyer->setPrix($request->get('prix'));
            $foyer->setNbrDem(0);



            $em->persist(($foyer));
            $em->flush();

        }

        return $this->render('@Ons/foyer/new.html.twig',array());
    }


    public function listFoyerAction(Request $request)
    {

//        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
//        $foyers = $em->getRepository("OnsBundle:Foyer")
//            ->findmyClubs($user);
        $queryBuilder=$em->getRepository("OnsBundle:Foyer")->createQueryBuilder('x');
        if($request->query->getAlnum('filter')){
            $queryBuilder->where('x.nomfoyer LIKE :lib')
                ->setParameter('lib', '%' .$request->query->getAlnum('filter') . '%');}
        $query=$queryBuilder->getQuery();
//        $em = $this->getDoctrine()->getManager();
//
//        $foyers = $em->getRepository('OnsBundle:Foyer')->findAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5);

        return $this->render('@Admin/foyer/listFoyerAdmin.html.twig', array(
            'foyers' => $pagination,
        ));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $foyer = $em->getRepository('OnsBundle:Foyer')->find($id);
        $em->remove($foyer);
        $em->flush();

        return $this->redirectToRoute('admin_listFoyer');
    }

    public function editAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        if($request->isMethod('GET')){

            $idcov= $request->get('id');
            $foyer=$em->getRepository("OnsBundle:Foyer")->find($idcov);
            return $this->render('@Ons/foyer/updateFoyer.html.twig',array("foyer"=>$foyer));
        }
        if($request->isMethod('POST')){

            $idCov= $request->get('id');
            $foyer=$em->getRepository("OnsBundle:Foyer")->find($idCov);
            $foyer->setNomfoyer($request->get('nomfoyer'));
            $foyer->setResponsable($request->get('responsable'));
            $foyer->setAdresse($request->get('adresse'));
            $foyer->setEmail($request->get('email'));
            $foyer->setNbrPlace($request->get('nbrPlaces'));
            $foyer->setPrix($request->get('prix'));
            $foyer->setNbrDem($foyer->getNbrDem());
            $em->flush();

        }
        return $this->redirectToRoute('admin_listFoyer');
    }

    /**
     * Finds and displays a foyer entity.
     *
     */
    public function showAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $foyers = $em->getRepository('OnsBundle:Foyer')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $foyers,
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/);

        return $this->render('@Ons/foyer/.html.twig', array(
            "foyers"=>$pagination
        ));
    }

    public function ReserverAction(Request $request)
    {
        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
        {
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
        }
        $sn =$this->getDoctrine()->getManager();
        $em1=$this->getDoctrine()->getManager();

        $idfoyer= $request->get('idf');

        $idf = $sn->getRepository('OnsBundle:Foyer')->find($idfoyer);

        $demande=new Demande();
        $demande->setIdFoyer($idf);
        $demande->setIdetudiant($user);



        $em1->persist($demande);
        $em1->flush();

        $covoiturageC = $sn->getRepository("OnsBundle:Foyer")->find($idfoyer);
        $covoiturageC->setNbrPlace($covoiturageC->getNbrPlace() - 1);
        $covoiturageC->setNbrDem($covoiturageC->getNbrDem()+1);

        $sn->flush();


        return $this->redirectToRoute('foyer_list') ;

    }

    public function chercherCleFoyerAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $em1=$this->getDoctrine()->getManager();
        if($request->isMethod('GET')) {

            $cle = $request->get('cle');
            if ($cle == "") {
                $foyers=$em->getRepository("OnsBundle:Foyer")->findby(array(),array('idFoyer'=>'DESC'));
            } else {

                $foyers = $em1->getRepository("OnsBundle:Foyer")->createQueryBuilder('foyers')
                    ->where('foyers.idFoyer LIKE :idFoyer')
                    ->orWhere('foyers.nomfoyer LIKE :nomfoyer')
                    ->orWhere('foyers.adresse LIKE :adresse')
                    ->orWhere('foyers.prix LIKE :prix')
                    ->setParameter('idFoyer', $cle)
                    ->setParameter('nomfoyer', '%'.$cle.'%')
                    ->setParameter('adresse', '%'.$cle.'%')
                    ->setParameter('prix', '%'.$cle.'%')
                    ->getQuery()
                    ->getResult();
            }
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $foyers,
                $request->query->getInt('page', 1)/*page number*/,
                5/*limit per page*/);
        }



        return $this->render('@Ons/foyer/chercherFoyerCle.html.twig',array("foyers"=>$pagination)

        );
    }

    public function ResultaAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $demande = $em->getRepository('OnsBundle:Demande')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $demande,
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/);

        return $this->render('@Ons/foyer/result.html.twig', array(
            "demande"=>$pagination
        ));

    }

}
