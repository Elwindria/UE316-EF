<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?PaymentMethod $relationType = null;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'transactions')]
    private Collection $Relation;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?User $User = null;

    public function __construct()
    {
        $this->Relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRelationType(): ?PaymentMethod
    {
        return $this->relationType;
    }

    public function setRelationType(?PaymentMethod $relationType): static
    {
        $this->relationType = $relationType;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getRelation(): Collection
    {
        return $this->Relation;
    }

    public function addRelation(Category $relation): static
    {
        if (!$this->Relation->contains($relation)) {
            $this->Relation->add($relation);
        }

        return $this;
    }

    public function removeRelation(Category $relation): static
    {
        $this->Relation->removeElement($relation);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }
}
