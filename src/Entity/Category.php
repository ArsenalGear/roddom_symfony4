<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
	private $categoryName;

    public function getId(): ?int
    {
        return $this->id;
    }
	
	public function __toString()
	{
		return $this->categoryName;
	}
	
	/**
	 * @return mixed
	 */
	public function getCategoryName()
	{
		return $this->categoryName;
	}
	
	/**
	 * @param mixed $categoryName
	 */
	public function setCategoryName($categoryName): void
	{
		$this->categoryName = $categoryName;
	}
}