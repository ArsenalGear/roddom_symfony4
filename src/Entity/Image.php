<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use App\Entity\Organisation;



/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @Vich\Uploadable
 */
class Image
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Organisation", inversedBy="images")
     * @ORM\JoinColumn(name="organisation_id", referencedColumnName="id")
     */
    private $organisation;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $attachment;
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo")
	 * @var File
	 */
	private $logoFile;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param mixed $alt
     */
    public function setAlt($alt): void
    {
        $this->alt = $alt;
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
	
	public function getAttachment()
	{
//		dd(1);
		return $this->attachment;
	}
	
	public function setAttachment($attachment)
	{
//		dd(2);
		$this->attachment = $attachment;
		
		return $this;
	}
	
	public function getLogoFile()
	{
//		dd(1);
		return $this->logoFile;
	}
	
	public function setLogoFile(File $file = null): self
	{
//		dd($file);
		$this->logoFile = $file;
		
		return $this;
	}
	
	public function setLogo($logo)
	{
		
		$this->logo = $logo;
//		dd($this);
	}
	
	public function getLogo()
	{
//		dd(1);
		return $this->logo;
	}
}
