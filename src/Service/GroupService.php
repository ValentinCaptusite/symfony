<?php
namespace App\Service;

use App\Entity\Groupe;
use Doctrine\ORM\EntityManagerInterface;

class GroupService
{
    public $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    
    public function updateGroup(Groupe $group){
        $this->entityManager->persist($group);
        $this->entityManager->flush();
    }
    
    public function deleteGroup(Groupe $group){
        $this->entityManager->remove($group);
        $this->entityManager->flush();
        
        return true;
    }
}