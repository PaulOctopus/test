<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserFieldRepository")
 */
class UserField
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fieldPath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFieldPath(): ?string
    {
        return $this->fieldPath;
    }

    public function setFieldPath(string $fieldPath): self
    {
        $this->fieldPath = $fieldPath;

        return $this;
    }
}
