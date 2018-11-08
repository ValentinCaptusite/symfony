<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Adresse;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"Default"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Default"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phone;
    
    /**
     * @ORM\ManyToOne(targetEntity="Groupe", inversedBy="user")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id", nullable=true)
     * @Groups({"Default"})
     */
    private $groupe;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Adresse", inversedBy="user", cascade={"persist","remove"}))
     * @ORM\JoinTable(name="adresse_user",
     * joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="adresse_id", referencedColumnName="id")}
     * ))
     * @Groups({"Default"})
     */
    private $adresse;


    
    public function __construct()
    {
        $this->adresse = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
    
    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }


    /**
     * @return Collection|Adresse[]
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    public function addAdresse(Adresse $adresse)
    {
        if ($this->adresse->contains($adresse)) {
            return;
        }

        $this->adresse[] = $adresse;
    }

    public function setAdresse(ArrayCollection $adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function removeAdresse(Adresse $adresse)
    {
        $this->adresse->removeElement($adresse);
    }

}
