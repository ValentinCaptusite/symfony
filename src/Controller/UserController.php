<?php
namespace App\Controller;


use App\Entity\User;
use App\Service\UserService;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/user/list", name="user_list")
     */
    public function listUser()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

                
        return $this->render('user/list.html.twig', ['users' => $users]);
    }
    
    /**
     * @Route("/user/add", name="user_add")
     */
    public function addUser(Request $request, UserService $userService)
    {
        $user = new User();
        
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
           
            $userService->updateUser($form->getData());
            
            return $this->redirectToRoute('user_list');
        }
        
        return $this->render('user/add.html.twig', ['form' => $form->createView()]);
    }
    
    /**
     * @Route("/user/edit/{id}", name="user_edit")
     */
    public function updateUser(Request $request, UserService $userService, User $user)
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            
            $userService->updateUser($form->getData());
            
            return $this->redirectToRoute('user_list');
        }
                
        return $this->render('user/add.html.twig', ['form' => $form->createView()]);
    }
    
    /**
     * @Route("/user/delete/{id}", name="user_delete")
     */
    public function deleteUser(UserService $userService, User $user)
    {

        if($userService->deleteUser($user)){
            return $this->redirectToRoute('user_list');
        }        
        
    }
}