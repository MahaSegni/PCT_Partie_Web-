<?php

namespace App\Controller;

use App\Entity\Devise;
use App\Entity\Fournisseur;
use App\Entity\Medicament;
use App\Form\MedicamentType;
use App\Form\MedType;
use App\Repository\FournisseurRepository;
use App\Repository\MedicamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MedicamentController extends AbstractController
{
    /**
     * @Route("/medicament", name="medicament")
     */
    public function index(): Response
    {
        return $this->render('medicament/index.html.twig', [
            'controller_name' => 'MedicamentController',
        ]);
    }
    /**
     * @Route("/afficherMed", name="afficherMed")
     */
    public function afficherMed()
    {
        $four = $this->getDoctrine()->getRepository(Medicament::class)->findAll();
        return $this->render('medicament/afficher.html.twig',array('listmed'=>$four));

    }

    /**
     * @Route("/afficherMedjsonTwig", name="afficherMedjsonTwig")
     */
    public function afficherMedjsonTwig(NormalizerInterface $normalizer)
    {
        $repositoryf= $this->getDoctrine()->getRepository(Medicament::class);
        $med= $repositoryf->findAll();
        $json=$normalizer->normalize($med,'json',['groups'=>'post:read']);
        // return $this->render('medicament/allMedJson.html.twig',['data'=> $json]);
        return new Response(json_encode($json));
    }
    /**
     * @Route("/addMedJSON/new", name="addMedJSON")
     */
    public function addMedJSON(Request $request,NormalizerInterface $normalizer){
        $med=  $this->getDoctrine()->getManager()->getRepository(Medicament::class)->find($request->get('id'));
        $em = $this->getDoctrine()->getManager();

        $med->setTaux($request->get('taux'));
        $med->setTva($request->get('tva'));
        $med->setXug($request->get('xug'));
        $med->setXcfug($request->get('xcfug'));
        $med->setXpgroht($request->get('xpgroht'));
        $med->setXppharht($request->get('xppharht'));
        $med->setXprixphattc($request->get('xprixphattc'));
        $med->setXprixpubttc($request->get('xprixpubttc'));
        $em->persist($med);
        $em->flush();
        $data=$normalizer->normalize($med,'json',['groups'=>'post:read']);
        return new Response(json_encode($data));
    }
    /**
     * @Route("/CalculMedJson/new", name="CalculMedJson")
     */
    public function CalculMedJson(Request $request,NormalizerInterface $normalizer){
        $four= new Medicament();
 $em = $this->getDoctrine()->getManager();
        $four->setXug($request->get('xug'));
        $four->setXcfug($request->get('xcfug'));
        $four->setXpgroht($request->get('xpgroht'));
        $four->setXppharht($request->get('xpphartht'));
        $four->setXprixphattc($request->get('xprixphattc'));
        $four->setTaux($request->get('taux'));
        $four->setTva($request->get('tva'));
        $four->setUv($request->get('uv'));
        $four->setXprixpubttc($request->get('xprixpubttc'));
        $em->persist($four);
            $em->flush();
        $data=$normalizer->normalize($four,'json',['groups'=>'post:read']);
        return new Response(json_encode($data));
    }
    /**
     * @Route("/addMed", name="addMed")
     */
    public function addMed(Request $request){
        $four= new Medicament();
        $form = $this->createForm(MedicamentType::class,$four);
        $form->handleRequest($request);

        $four->setValidation(false);
        if ($form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->persist($four);
            $em->flush();
            return $this->redirectToRoute('afficherMed');
        }
        return $this->render("medicament/add.html.twig",array("formMed"=>$form->createView()));
    }
    /**
     * @Route("/CalculMed/{id}", name="CalculMed")
     */
    public function CalculMed(Request $request,$id){
        $four= new Medicament();
        $form = $this->createForm(MedType::class,$four);
        $form->handleRequest($request);
        $med=  $this->getDoctrine()->getManager()->getRepository(Medicament::class)->find($id);
        $four->setValidation(false);
        if ($form->isSubmitted() && $form->isValid() ){
            if($four->getXug() == 'Q'){
                $xcfug=Round($med->getPrixAchat()/(1+ $med->getTauxug()/100),3);
                $med->setXcfug($xcfug);
                $med->setXug($four->getXug());
            } elseif($four->getXug() == 'D'){
                $xcfug=Round($med->getPrixAchat()*((100- $med->getTauxug())/100),3);
                $med->setXcfug($xcfug);
                $med->setXug($four->getXug());
            } else{
                $xcfug=$med->getPrixAchat();
                $med->setXcfug($xcfug);
                $med->setXug($four->getXug());
            }
            $tl=Round($xcfug*((100-$med->getRemise())/100),3);
            $med->setXcfug($tl);
            $dev=  $this->getDoctrine()->getManager()->getRepository(Devise::class)->find($four->getUv());
            $tl1=Round($med->getPrixAchat() *  $dev->getCout() / $dev->getUnitedev() * (1+$four->getTaux()/100)*(1+(9/100))*1.105,3);
            $med->setXpgroht($tl1);
            $tl2=Round($tl1*1.087,3);
            $med->setXppharht($tl2);
            $t=$tl2+($tl2*((1+$four->getTva())/100));
            $med->setXprixphattc($t);
            $med->setTaux($four->getTaux());
            $med->setTva($four->getTva());
            $med->setUv($dev);
            if($t >=0.001 && $t<=2.890){
                $tl3=Round($t *(1+ 42.900/100),3 );
                $med->setXprixpubttc($tl3);
            }elseif ($t >=2.891 && $t<=7.754){
                $tl3=Round($t *(1+ 38.900/100),3 );
                $med->setXprixpubttc($tl3);
            }elseif ($t >=7.755 && $t<=23.974){
            $tl3=Round($t *(1+ 35.100/100),3 );
            $med->setXprixpubttc($tl3);
        }elseif ($t>=23.975 && $t<=999999.999){
                $tl3=Round($t *(1+ 31.600 /100),3 );
                $med->setXprixpubttc($tl3);
            }

            $em = $this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('afficherCalcMed');
        }
        return $this->render("medicament/calcul.html.twig",array("formMed"=>$form->createView()));
    }
    /**
     * @Route("/afficherCalcMed", name="afficherCalcMed")
     */
    public function afficherCalcMed()
    {
        $four = $this->getDoctrine()->getRepository(Medicament::class)->findAll();
        return $this->render('medicament/affichercal.html.twig',array('listmed'=>$four));

    }
    /**
     * @Route("/valider/{id}", name="valider")
     */
    public function valider($id)
    {
        $four = $this->getDoctrine()->getRepository(Medicament::class)->find($id);
        $four->setValidation(true);
        $em = $this->getDoctrine()->getManager();

        $em->flush();
        return $this->redirectToRoute('afficherMed');

    }
    /**
     * @Route("/notvalider/{id}", name="notvalider")
     */
    public function notvalider($id)
    {
        $four = $this->getDoctrine()->getRepository(Medicament::class)->find($id);
        $four->setValidation(false);
        $em = $this->getDoctrine()->getManager();

        $em->flush();
        return $this->redirectToRoute('afficherMed');

    }
    /**
     * @Route("/afficherMedjson", name="afficherMedjson")
     */
    public function afficherMedjson(MedicamentRepository $repositoryf, NormalizerInterface $normalizer)
    {

        $film= $repositoryf->findAll();
        $json=$normalizer->normalize($film,'json',['groups'=>'post:read']);
        return new Response(json_encode($json));
    }
    /**
     * @Route("/updateMed/{id}", name="updateMed")
     */
    public function updateMed(Request $request,$id){
        $med=  $this->getDoctrine()->getManager()->getRepository(Medicament::class)->find($id);

        $form = $this->createForm(MedicamentType::class,$med);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ){
            $em = $this->getDoctrine()->getManager();
            $em->flush();//mise a jour
            return $this->redirectToRoute('afficherMed');
        }
        return $this->render("medicament/add.html.twig",array("formMed"=>$form->createView()));
    }

}
