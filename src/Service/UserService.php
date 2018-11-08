<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Util\Debug;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function updateUser(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function deleteUser(User $user)
    {
        foreach ($user->getAdresse() as $adresse) {
            $user->removeAdresse($adresse);
        }
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return true;
    }

    public function importUsers()
    {
        $users = $this->entityManager->getRepository(User::class)->findAllUsers();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;');

        $fp = fopen('public/import.csv', 'a+');
        foreach ($users as $user) {
            fputcsv($fp, $user);
        }
        fclose($fp);
    }
}