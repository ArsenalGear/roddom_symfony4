<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Review
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
    private $type;
	
	/**
	 * @ORM\Column(type="text")
	 */
	private $header;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="float")
     */
    private $rating;
	
	/**
	 * @ORM\Column(type="float", options={"default":"0"})
	 */
	private $subComment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Organisation", inversedBy="reviews")
     */
    private $organisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reviews")
     */
    private $user;
	
	/**
	 * @var datetime $created
	 *
	 * @ORM\Column(type="datetime")
	 */
    private $created;
	
	/**
	 * @var datetime $updated
	 *
	 * @ORM\Column(type="datetime", nullable = true)
	 */
    private $updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {

        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        

        return $this;
    }
	
	public function getHeader(): ?string
	{
		return $this->header;
	}
	
	public function setHeader(string $header): self
	{
		$this->header = $header;
		
		return $this;
	}

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }
	
	public function getSubComment(): ?float
	{
		return $this->subComment;
	}
	
	public function setSubComment(float $subComment): self
	{
		$this->subComment = $subComment;
		
		return $this;
	}

    /**
     * @return mixed
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * @param mixed $organisation
     */
    public function setOrganisation($organisation): void
    {
        $this->organisation = $organisation;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated): void
    {
        $this->updated = $updated;
    }
	/**
	 * Gets triggered only on insert
	 
	 * @ORM\PrePersist
	 */
	public function onPrePersist()
	{
		$this->created = new \DateTime("now");
	}
	
	/**
	 * Gets triggered every time on update
	 
	 * @ORM\PreUpdate
	 */
	public function onPreUpdate()
	{
		$this->updated = new \DateTime("now");
	}
}
