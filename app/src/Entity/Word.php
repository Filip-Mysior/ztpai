<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WordRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordRepository::class)]
#[ApiResource]
class Word
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $word_en = null;

    #[ORM\Column(length: 255)]
    private ?string $word_pl = null;

    /**
     * @var Collection<int, Set>
     */
    #[ORM\ManyToMany(targetEntity: Set::class, mappedBy: 'words')]
    private Collection $sets;

    public function __construct()
    {
        $this->sets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWordEn(): ?string
    {
        return $this->word_en;
    }

    public function setWordEn(string $word_en): static
    {
        $this->word_en = $word_en;

        return $this;
    }

    public function getWordPl(): ?string
    {
        return $this->word_pl;
    }

    public function setWordPl(string $word_pl): static
    {
        $this->word_pl = $word_pl;

        return $this;
    }

    /**
     * @return Collection<int, Set>
     */
    public function getSets(): Collection
    {
        return $this->sets;
    }

    public function addSet(Set $set): static
    {
        if (!$this->sets->contains($set)) {
            $this->sets->add($set);
            $set->addWord($this);
        }

        return $this;
    }

    public function removeSet(Set $set): static
    {
        if ($this->sets->removeElement($set)) {
            $set->removeWord($this);
        }

        return $this;
    }
}
