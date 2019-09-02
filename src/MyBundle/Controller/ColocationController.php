<?php

namespace MyBundle\Controller;

use MyBundle\Entity\Colocation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Colocation controller.
 *
 * @Route("colocation")
 */
class ColocationController extends Controller
{
    /**
     * Lists all colocation entities.
     *
     * @Route("/", name="colocation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $colocations = $em->getRepository('MyBundle:Colocation')->findAll();

        return $this->render('colocation/indexlayout.html.twig', array(
            'colocations' => $colocations,
        ));
    }

    /**
     * Creates a new colocation entity.
     *
     * @Route("/new", name="colocation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $colocation = new Colocation();
        $form = $this->createForm('MyBundle\Form\ColocationType', $colocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($colocation);
            $em->flush();

            return $this->redirectToRoute('colocation_show', array('id' => $colocation->getId()));
        }

        return $this->render('colocation/new.html.twig', array(
            'colocation' => $colocation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a colocation entity.
     *
     * @Route("/{id}", name="colocation_show")
     * @Method("GET")
     */
    public function showAction(Colocation $colocation)
    {
        $deleteForm = $this->createDeleteForm($colocation);

        return $this->render('colocation/show.html.twig', array(
            'colocation' => $colocation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing colocation entity.
     *
     * @Route("/{id}/edit", name="colocation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Colocation $colocation)
    {
        $deleteForm = $this->createDeleteForm($colocation);
        $editForm = $this->createForm('MyBundle\Form\ColocationType', $colocation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('colocation_edit', array('id' => $colocation->getId()));
        }

        return $this->render('colocation/edit.html.twig', array(
            'colocation' => $colocation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a colocation entity.
     *
     * @Route("/{id}", name="colocation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Colocation $colocation)
    {
        $form = $this->createDeleteForm($colocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($colocation);
            $em->flush();
        }

        return $this->redirectToRoute('colocation_index');
    }

    /**
     * Creates a form to delete a colocation entity.
     *
     * @param Colocation $colocation The colocation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Colocation $colocation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('colocation_delete', array('id' => $colocation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
