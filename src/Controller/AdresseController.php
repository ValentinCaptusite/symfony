<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Service\AdresseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdresseController extends AbstractController
{

    /**
     * @Route("/adresse/list", name="adresse_list")
     */
    public function listAdresse()
    {
        $adresses = $this->getDoctrine()->getRepository(Adresse::class)->findAll();

        return $this->render('adresse/list.html.twig', ['adresses' => $adresses]);
    }

    /**
     * @Route("/adresse/add", name="adresse_add")
     */
    public function addAdresse(Request $request, AdresseService $adresseService)
    {
        $adresse = new Adresse();

        $form = $this->createForm(AdresseType::class, $adresse);

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $adresseService->updateAdresse($form->getData());

            return $this->redirectToRoute('adresse_list');
        }

        return $this->render('adresse/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/adresse/edit/{id}", name="adresse_edit")
     */
    public function updateAdresse(Request $request, AdresseService $adresseService, Adresse $adresse)
    {
        $form = $this->createForm(AdresseType::class, $adresse);

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $adresseService->updateAdresse($form->getData());

            return $this->redirectToRoute('adresse_list');
        }

        return $this->render('adresse/add.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/adresse/delete/{id}", name="adresse_delete")
     */
    public function deleteAdresse(AdresseService $adresseService, Adresse $adresse)
    {

        if($adresseService->deleteAdresse($adresse)){
            return $this->redirectToRoute('adresse_list');
        }

    }


}