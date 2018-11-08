<?php
namespace App\Controller;


use App\Entity\Groupe;
use App\Entity\User;
use App\Service\GroupService;
use App\Form\GroupType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupeController extends AbstractController
{
    /**
     * @Route("/group/list", name="group_list")
     */
    public function listGroup()
    {
        $groups = $this->getDoctrine()->getRepository(Groupe::class)->findAll();
                
        return $this->render('group/list.html.twig', ['groups' => $groups]);
    }
    
    /**
     * @Route("/group/add", name="group_add")
     */
    public function addGroup(Request $request, GroupService $groupService)
    {
        $group = new Groupe();
        
        $form = $this->createForm(GroupType::class, $group);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
           
            $groupService->updateGroup($form->getData());
            
            return $this->redirectToRoute('group_list');
            
            //return new Response('ok');
        }
        
        return $this->render('group/add.html.twig', ['form' => $form->createView()]);
    }
    
    /**
     * @Route("/group/edit/{id}", name="group_edit")
     */
    public function updateGroup(Request $request, GroupService $groupService, Groupe $group)
    {
        $form = $this->createForm(GroupType::class, $group);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
           
            $groupService->updateGroup($form->getData());
            
            return $this->redirectToRoute('group_list');
        }
                
        return $this->render('group/add.html.twig', ['form' => $form->createView()]);
    }
    
    /**
     * @Route("/group/delete/{id}", name="group_delete")
     */
    public function deleteGroup(GroupService $groupService, Groupe $group)
    {

        if($groupService->deleteGroup($group)){
            return $this->redirectToRoute('group_list');
        }        
        
    }
    
    /**
     * @Route("/group/{id}/users", name="group_delete")
     */
    public function getUsersByGroupe(Groupe $groupe){
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(['groupe'=>$groupe]);
        
        return $this->render('user/list.html.twig', ['users' => $users]);
    }
    

}