<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 07/11/2018
 * Time: 11:18
 */

namespace App\Service;

use App\Entity\Adresse;
use Doctrine\ORM\EntityManagerInterface;

class AdresseService
{
    public $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function updateAdresse(Adresse $adresse){
        $this->entityManager->persist($adresse);
        $this->entityManager->flush();
    }

    public function deleteAdresse(Adresse $adresse){
        $this->entityManager->remove($adresse);
        $this->entityManager->flush();

        return true;
    }
}