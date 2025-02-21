<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Vacances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: AdminUser::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?AdminUser $employe = null;

    #[ORM\Column(type: "date")]
    #[Assert\NotBlank]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: "date")]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(propertyPath: "dateDebut", message: "La date de fin doit être supérieure ou égale à la date de début.")]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: "json", nullable: true)]
    private ?array $joursFeries = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmploye(): ?AdminUser
    {
        return $this->employe;
    }

    public function setEmploye(?AdminUser $employe): self
    {
        $this->employe = $employe;
        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    public function getJoursFeries(): ?array
    {
        return $this->joursFeries;
    }

    public function setJoursFeries(?array $joursFeries): self
    {
        $this->joursFeries = $joursFeries;
        return $this;
    }

    public function getJoursFeriesInclus(): array
    {
        $joursFeries = [
            'Jour de l\'An' => '2025-01-01',
            'Fête du Travail' => '2025-05-01',
            'Victoire 1945' => '2025-05-08',
            'Ascension' => '2025-05-09',
            'Fête Nationale' => '2025-07-14',
            'Assomption' => '2025-08-15',
            'Toussaint' => '2025-11-01',
            'Armistice' => '2025-11-11',
            'Noël' => '2025-12-25',
        ];
    
        $joursFeriesInclus = [];
    
        foreach ($joursFeries as $nom => $date) {
            $dateFerie = new \DateTime($date);
    
            if ($this->dateDebut <= $dateFerie && $this->dateFin >= $dateFerie) {
                $joursFeriesInclus[$nom] = $dateFerie->format('d/m/Y');
            }
        }
    
        return $joursFeriesInclus;
    }
    
}
