<?php

namespace App\Controller;

use App\Entity\PrixMed;
use App\Form\PrixMedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrixMedController extends AbstractController
{
    /**
     * @Route("/prix/med", name="prix_med")
     */
    public function index(): Response
    {
        return $this->render('prix_med/index.html.twig', [
            'controller_name' => 'PrixMedController',
        ]);
    }
    /**
     * @Route("/afficherPrixMed", name="afficherPrixMed")
     */
    public function afficherPrixMed()
    {
        $four = $this->getDoctrine()->getRepository(PrixMed::class)->findAll();
        return $this->render('prix_med/afficher.html.twig',array('listmed'=>$four));

    }

    /**
     * @Route("/addPrixMed", name="addPrixMed")
     */
    public function addPrixMed(Request $request){
        $four= new PrixMed();
        $form = $this->createForm(PrixMedType::class,$four);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){

            $em = $this->getDoctrine()->getManager();
            $em->persist($four);
            $em->flush();
            return $this->redirectToRoute('afficherPrixMed');
        }
        return $this->render("prix_med/add.html.twig",array("formMed"=>$form->createView()));
    }
}
