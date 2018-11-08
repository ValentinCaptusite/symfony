<?php


namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Groupe;
use App\Entity\User;
use App\Service\UserService;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\View\View as CreateView;


class TownController extends FOSRestController
{
    public function getTown(){
        $towns = $this->getDoctrine()->getRepository(WorkPlace::class)->findBy([], null);


        return CreateView::create($towns, Response::HTTP_OK);
    }


    /**
     * @Rest\View(serializerGroups={"Default"})
     * @Rest\Get("/api/users", name="api_user")
     */
    public function getUser(){
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return CreateView::create($users, Response::HTTP_OK);
    }


    /**
     * Rest\View(serializerGroups={"Default"})
     * @Rest\Post("/api/user/add", name="api_groups")
     */
    public function addUser(Request $request){
        $user = new User();

        $user->setFirstname($request->get('firstname'));
        $user->setLastname($request->get('lastname'));
        $user->setEmail($request->get('email'));
        $user->setPhone($request->get('phone'));

        $adresse = $this->getDoctrine()->getRepository(Adresse::class)->findOneBy(["id" => $request->get("adresse_id")]);
        $groupe = $this->getDoctrine()->getRepository(Groupe::class)->findOneById($request->get("groupe_id"));

        if($groupe instanceof Groupe && $adresse instanceof Adresse){
            $user->setGroupe($groupe);
            $user->addAdresse($adresse);
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();

            return Createview::create($user, Response::HTTP_OK);
        }
        return new Response("Erreur :(");
    }

    /**
     * @Rest\View(serializerGroups={"Default"})
     * @Rest\Put("/api/user/{id}", name="api_maj_groups")
     */
    public function updateUser(Request $request, UserService $userService, User $user)
    {
        $user->setFirstname($request->get('firstname'));
        $user->setLastname($request->get('lastname'));
        $user->setEmail($request->get('email'));
        $user->setPhone($request->get('phone'));

        $adresse = $this->getDoctrine()->getRepository(Adresse::class)->findOneBy(["id" => $request->get("adresse_id")]);
        $groupe = $this->getDoctrine()->getRepository(Groupe::class)->findOneById($request->get("groupe_id"));

        if($groupe instanceof Groupe && $adresse instanceof Adresse){

            $user->setGroupe($groupe);
            $user->addAdresse($adresse);

            $userService->updateUser($user);

            return Createview::create($user, Response::HTTP_OK);
        }
        return new Response("Erreur :(");
    }

    /**
     * @Rest\View(serializerGroups={"Default"})
     * @Rest\Delete("/api/user/{id}", name="api_user_delete")
     */
    public function deleteUser(Request $request, UserService $userService, User $user){

        $userService->deleteUser($user);

        return CreateView::create($user, Response::HTTP_OK);
    }
}