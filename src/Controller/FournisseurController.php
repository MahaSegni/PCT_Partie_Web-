<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use App\Repository\FournisseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FournisseurController extends AbstractController
{
    /**
     * @Route("/fournisseur", name="fournisseur")
     */
    public function index(): Response
    {
        return $this->render('fournisseur/index.html.twig', [
            'controller_name' => 'FournisseurController',
        ]);
    }
    /**
     * @Route("/afficherfour", name="afficherfour")
     */
    public function afficherfour()
    {
        $four = $this->getDoctrine()->getRepository(Fournisseur::class)->findAll();
        return $this->render('fournisseur/afficher.html.twig',array('listfour'=>$four));

    }
    /**
     * @Route("/addFournisseur", name="addFournisseur")
     */
    public function addFournisseur(Request $request){
        $four= new Fournisseur();

        $form = $this->createForm(FournisseurType::class,$four);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->persist($four);
            $em->flush();
            return $this->redirectToRoute('afficherfour');
        }
        return $this->render("fournisseur/add.html.twig",array("formFournisseur"=>$form->createView()));
    }

    /**
     * @Route("/addFournisseurjson/new", name="addFournisseurjson")
     */
    public function addFournisseurjson(Request $request,NormalizerInterface $normalizer){

        $em = $this->getDoctrine()->getManager();
        $four= new Fournisseur();
        $four->setNomf($request->get('nomf'));
        $four->setMail($request->get('mail'));
        $four->setTelephone($request->get('telephone'));
        $em->persist($four);
        $em->flush();

            $data=$normalizer->normalize($four,'json',['groups'=>'post:read']);
            return new Response(json_encode($data));
    }

    /**
     * @Route("/updateFour/{id}", name="updateFour")
     */
    public function updateFour(Request $request,$id){
        $four=  $this->getDoctrine()->getManager()->getRepository(Fournisseur::class)->find($id);

        $form = $this->createForm(FournisseurType::class,$four);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->flush();//mise a jour
            return $this->redirectToRoute('afficherfour');
        }
        return $this->render("fournisseur/add.html.twig",array("formFournisseur"=>$form->createView()));
    }
    /**
     * @Route("/deleteFour/{id}", name="deleteFour")
     */
    public function deleteFour($id)
    {
        $Classroom = $this->getDoctrine()->getRepository(Fournisseur::class)->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Classroom);
        $em->flush();
        return $this->redirectToRoute("afficherfour");
    }
    /**
     * @Route("/afficherFourTwig", name="afficherFourTwig")
     */
    public function afficherFourTwig(NormalizerInterface $normalizer)
    {
        $repositoryf= $this->getDoctrine()->getRepository(Fournisseur::class);
        $Devise= $repositoryf->findAll();
        $json=$normalizer->normalize($Devise,'json',['groups'=>'post:read']);
        //   return new Response(json_encode($json));
        return $this->render('fournisseur/allfour.html.twig',['data'=> $json]);
    }
    /**
     * @Route("/afficherjson", name="afficherjson")
     */
    public function afficherjson(FournisseurRepository $repositoryf, NormalizerInterface $normalizer)
    {

        $film= $repositoryf->findAll();
        $json=$normalizer->normalize($film,'json',['groups'=>'post:read']);
        return new Response(json_encode($json));
    }
    /**
     * @Route("/searchFourJSON/{test}", name="searchFourJSON")
     */
    public function searchFourJSON(Request $request,$test,NormalizerInterface $normalizer,FournisseurRepository $repository){

        $film = $repository->SearchNamef($test);
        $json = $normalizer->normalize($film,'json',['groups'=>'post:read']);
        return new Response(json_encode($json));
    }
}
