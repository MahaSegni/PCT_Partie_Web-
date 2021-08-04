<?php

namespace App\Controller;

use App\Entity\Devise;
use App\Repository\DeviseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DeviseController extends AbstractController
{
    /**
     * @Route("/devise", name="devise")
     */
    public function index(): Response
    {
        return $this->render('devise/index.html.twig', [
            'controller_name' => 'DeviseController',
        ]);
    }
    /**
     * @Route("/afficherDevisejsonTwig", name="afficherDevisejsonTwig")
     */
    public function afficherDevisejsonTwig(NormalizerInterface $normalizer)
    {
        $repositoryf= $this->getDoctrine()->getRepository(Devise::class);
        $Devise= $repositoryf->findAll();
        $json=$normalizer->normalize($Devise,'json',['groups'=>'post:read']);
     //   return new Response(json_encode($json));
        return $this->render('Devise/alldevise.html.twig',['data'=> $json]);
    }
    /**
     * @Route("/affichers", name="affichers")
     */
    public function affichers()
    {
        $cinema = $this->getDoctrine()->getRepository(Devise::class)->findAll();
        return $this->render('devise/affichers.html.twig',array('liststudent'=>$cinema));

    }
    /**
     * @Route ("/rechercheDevise",name="rechercheDevise")
     */
    public function rechercheDevise(DeviseRepository $repository , Request $request)
    {
        $data=$request->get('search');
        $cinema=$repository->SearchName($data);
        return $this->render('devise/affichers.html.twig',array('liststudent'=>$cinema));
    }
}
