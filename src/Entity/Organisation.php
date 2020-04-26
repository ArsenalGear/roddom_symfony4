<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use App\Form\ReviewForm;
use App\Entity\Review;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganisationRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Organisation extends BasePage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $logo= null;

    /**
     * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo")
     * @var File
     */
    private $logoFile;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $title = null;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $alt = null;
    
//    начало доп полей под картинки
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo1= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo1")
	 * @var File
	 */
	private $logoFile1;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $title1 = null;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $alt1 = null;
	
//	2
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo2= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo2")
	 * @var File
	 */
	private $logoFile2;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $title2 = null;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $alt2 = null;

//	3
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo3= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo3")
	 * @var File
	 */
	private $logoFile3;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $title3 = null;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $alt3 = null;
	
	//	4
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo4= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo4")
	 * @var File
	 */
	private $logoFile4;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $title4 = null;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)`
	 */
	private $alt4 = null;
	
	//	5
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo5= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo5")
	 * @var File
	 */
	private $logoFile5;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)
	 */
	private $title5 = null;
	
	/**
	 * @ORM\Column(type="text", nullable = true, nullable = true, nullable=true)`
	 */
	private $alt5 = null;
	
	//	6
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo6= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo6")
	 * @var File
	 */
	private $logoFile6;
	
	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $title6 = null;
	
	/**
	 * @ORM\Column(type="text", nullable=true)`
	 */
	private $alt6 = null;
	
	//	7
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo7= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo7")
	 * @var File
	 */
	private $logoFile7;
	
	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $title7 = null;
	
	/**
	 * @ORM\Column(type="text", nullable=true)`
	 */
	private $alt7 = null;
	
	//	8
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo8= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo8")
	 * @var File
	 */
	private $logoFile8;
	
	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $title8 = null;
	
	/**
	 * @ORM\Column(type="text", nullable=true)`
	 */
	private $alt8 = null;

//	9
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo9= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo9")
	 * @var File
	 */
	private $logoFile9;
	
	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $title9 = null;
	
	/**
	 * @ORM\Column(type="text", nullable=true)`
	 */
	private $alt9 = null;

//	10
	
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	private $logo10= null;
	
	/**
	 * @Vich\UploadableField(mapping="organisation_images", fileNameProperty="logo10")
	 * @var File
	 */
	private $logoFile10;
	
	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $title10 = null;
	
	/**
	 * @ORM\Column(type="text", nullable=true)`
	 */
	private $alt10 = null;


//окончание доп полей под картинки
    
    

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="organisations")
     */
    private $city;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="organisations")
     */
    private $managedBy;
	
	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="organisations")
	 */
	private $category;
	
	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\SubscriptionPlan", inversedBy="organisations")
	 */
	private $subscriptionPlan;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable = true, options={"default":"0"})
     */
    private $rating;
	
	/**
	 * @ORM\Column(type="float", nullable = true, options={"default":"0"})
	 */
	private $commentsCount;
	
	/**
	 * @ORM\Column(type="float", nullable = true, options={"default":"0"})
	 */
	private $countReview;

    /**
     * @ORM\Column(type="string", length=255, )
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $website;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="organisation", cascade={"persist", "remove"})
     */
    private $images;
	
	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="organisation", cascade={"persist", "remove"})
	 */
	private $reviews;
	
	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="organisation", cascade={"persist", "remove"})
	 */
	private $comments;
	
	/**
	 * @ORM\Column(type="float")
	 */
	private $year;
	
	/**
	 * @ORM\Column(type="boolean", options={"default":"0"})
	 */
	private $licence;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $show_org;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $modified_at = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $created_by;

    /**
     * @ORM\Column(type="string", nullable = true, length=255)
     */
    protected $modified_by = null;

    /**
     * @ORM\Column(type="string", nullable = true, length=255)
     */
    protected $template = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogoFile()
    {
        return $this->logoFile;
    }

    public function setLogoFile($file)
    {
        $this->logoFile = $file;

        return $this;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    public function getLogo()
    {
        return $this->logo;
    }
	
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
		
		return $this;
	}
	
	public function getAlt()
	{
		return $this->alt;
	}
	
	public function setAlt($alt)
	{
		$this->alt = $alt;
		
		return $this;
	}
    
//    начало гетеров и сеттеров под картинки

//1
	public function getLogoFile1()
	{
		return $this->logoFile1;
	}

	public function setLogoFile1($file)
	{
		$this->logoFile1 = $file;

		return $this;
	}

	public function setLogo1($logo1)
	{
		$this->logo1 = $logo1;
	}

	public function getLogo1()
	{
		return $this->logo1;
	}
	
	public function getTitle1()
	{
		return $this->title1;
	}
	
	public function setTitle1($title1)
	{
		$this->title1 = $title1;
		
		return $this;
	}
	
	public function getAlt1()
	{
		return $this->alt1;
	}
	
	public function setAlt1($alt1)
	{
		$this->alt1 = $alt1;
		
		return $this;
	}
	
	//2
	public function getLogoFile2()
	{
		return $this->logoFile2;
	}
	
	public function setLogoFile2($file)
	{
		$this->logoFile2 = $file;
		
		return $this;
	}
	
	public function setLogo2($logo2)
	{
		$this->logo2 = $logo2;
	}
	
	public function getLogo2()
	{
		return $this->logo2;
	}
	
	public function getTitle2()
	{
		return $this->title2;
	}
	
	public function setTitle2($title2)
	{
		$this->title2 = $title2;
		
		return $this;
	}
	
	public function getAlt2()
	{
		return $this->alt2;
	}
	
	public function setAlt2($alt2)
	{
		$this->alt2 = $alt2;
		
		return $this;
	}
	
	//3
	public function getLogoFile3()
	{
		return $this->logoFile3;
	}
	
	public function setLogoFile3($file)
	{
		$this->logoFile3 = $file;
		
		return $this;
	}
	
	public function setLogo3($logo3)
	{
		$this->logo3 = $logo3;
	}
	
	public function getLogo3()
	{
		return $this->logo3;
	}
	
	public function getTitle3()
	{
		return $this->title3;
	}
	
	public function setTitle3($title3)
	{
		$this->title3 = $title3;
		
		return $this;
	}
	
	public function getAlt3()
	{
		return $this->alt3;
	}
	
	public function setAlt3($alt3)
	{
		$this->alt3 = $alt3;
		
		return $this;
	}
	
	//4
	public function getLogoFile4()
	{
		return $this->logoFile4;
	}
	
	public function setLogoFile4($file)
	{
		$this->logoFile4 = $file;
		
		return $this;
	}
	
	public function setLogo4($logo4)
	{
		$this->logo4 = $logo4;
	}
	
	public function getLogo4()
	{
		return $this->logo4;
	}
	
	public function getTitle4()
	{
		return $this->title4;
	}
	
	public function setTitle4($title4)
	{
		$this->title4 = $title4;
		
		return $this;
	}
	
	public function getAlt4()
	{
		return $this->alt4;
	}
	
	public function setAlt4($alt4)
	{
		$this->alt4 = $alt4;
		
		return $this;
	}
	//5
	public function getLogoFile5()
	{
		return $this->logoFile5;
	}
	
	public function setLogoFile5($file)
	{
		$this->logoFile5 = $file;
		
		return $this;
	}
	
	public function setLogo5($logo5)
	{
		$this->logo5 = $logo5;
	}
	
	public function getLogo5()
	{
		return $this->logo5;
	}
	
	public function getTitle5()
	{
		return $this->title5;
	}
	
	public function setTitle5($title5)
	{
		$this->title5 = $title5;
		
		return $this;
	}
	
	public function getAlt5()
	{
		return $this->alt5;
	}
	
	public function setAlt5($alt5)
	{
		$this->alt5 = $alt5;
		
		return $this;
	}
	
	//6
	public function getLogoFile6()
	{
		return $this->logoFile6;
	}
	
	public function setLogoFile6($file)
	{
		$this->logoFile6 = $file;
		
		return $this;
	}
	
	public function setLogo6($logo6)
	{
		$this->logo6 = $logo6;
	}
	
	public function getLogo6()
	{
		return $this->logo6;
	}
	
	public function getTitle6()
	{
		return $this->title6;
	}
	
	public function setTitle6($title6)
	{
		$this->title6 = $title6;
		
		return $this;
	}
	
	public function getAlt6()
	{
		return $this->alt6;
	}
	
	public function setAlt6($alt6)
	{
		$this->alt6 = $alt6;
		
		return $this;
	}
	
	//7
	public function getLogoFile7()
	{
		return $this->logoFile7;
	}
	
	public function setLogoFile7($file)
	{
		$this->logoFile7 = $file;
		
		return $this;
	}
	
	public function setLogo7($logo7)
	{
		$this->logo7 = $logo7;
	}
	
	public function getLogo7()
	{
		return $this->logo7;
	}
	
	public function getTitle7()
	{
		return $this->title7;
	}
	
	public function setTitle7($title7)
	{
		$this->title7 = $title7;
		
		return $this;
	}
	
	public function getAlt7()
	{
		return $this->alt7;
	}
	
	public function setAlt7($alt7)
	{
		$this->alt7 = $alt7;
		
		return $this;
	}
	
	//8
	public function getLogoFile8()
	{
		return $this->logoFile8;
	}
	
	public function setLogoFile8($file)
	{
		$this->logoFile8 = $file;
		
		return $this;
	}
	
	public function setLogo8($logo8)
	{
		$this->logo8 = $logo8;
	}
	
	public function getLogo8()
	{
		return $this->logo8;
	}
	
	public function getTitle8()
	{
		return $this->title8;
	}
	
	public function setTitle8($title8)
	{
		$this->title8 = $title8;
		
		return $this;
	}
	
	public function getAlt8()
	{
		return $this->alt8;
	}
	
	public function setAlt8($alt8)
	{
		$this->alt8 = $alt8;
		
		return $this;
	}
	//9
	public function getLogoFile9()
	{
		return $this->logoFile9;
	}
	
	public function setLogoFile9($file)
	{
		$this->logoFile9 = $file;
		
		return $this;
	}
	
	public function setLogo9($logo9)
	{
		$this->logo9 = $logo9;
	}
	
	public function getLogo9()
	{
		return $this->logo9;
	}
	
	public function getTitle9()
	{
		return $this->title9;
	}
	
	public function setTitle9($title9)
	{
		$this->title9 = $title9;
		
		return $this;
	}
	
	public function getAlt9()
	{
		return $this->alt9;
	}
	
	public function setAlt9($alt9)
	{
		$this->alt9 = $alt9;
		
		return $this;
	}
	//10
	public function getLogoFile10()
	{
		return $this->logoFile10;
	}
	
	public function setLogoFile10($file)
	{
		$this->logoFile10 = $file;
		
		return $this;
	}
	
	public function setLogo10($logo10)
	{
		$this->logo10 = $logo10;
	}
	
	public function getLogo10()
	{
		return $this->logo10;
	}
	
	public function getTitle10()
	{
		return $this->title10;
	}
	
	public function setTitle10($title10)
	{
		$this->title10 = $title10;
		
		return $this;
	}
	
	public function getAlt10()
	{
		return $this->alt10;
	}
	
	public function setAlt10($alt10)
	{
		$this->alt10 = $alt10;
		
		return $this;
	}

//	окончание гетеров и сетеров под картинки

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }
	
	public function getCommentsCount(): ?float
	{
		return $this->commentsCount;
	}
	
	public function setCommentsCount(float $commentsCount): self
	{
		$this->commentsCount = $commentsCount;
		
		return $this;
	}
	
	public function getCountReview(): ?float
	{
		return $this->countReview;
	}
	
	public function setCountReview(float $countReview): self
	{
		$this->countReview = $countReview;
		
		return $this;
	}

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getShowOrg()
    {
        return $this->show_org;
    }

    /**
     * @param mixed $show_org
     */
    public function setShowOrg($show_org): void
    {
        $this->show_org = $show_org;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website): void
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getManagedBy()
    {
        return $this->managedBy;
    }

    /**
     * @param mixed $managedBy
     */
    public function setManagedBy($managedBy): void
    {
        $this->managedBy = $managedBy;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }
	
	/**
	 * @return mixed
	 */
	public function getSubscriptionPlan()
	{
		return $this->subscriptionPlan;
	}
	
	/**
	 * @param mixed $subscriptionPlan
	 */
	public function setSubscriptionPlan($subscriptionPlan): void
	{
		$this->subscriptionPlan = $subscriptionPlan;
	}

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }
	
	/**
	 * @return mixed
	 */
	public function getReviews()
	{
		return $this->reviews;
	}
	
	/**
	 * @param mixed $reviews
	 */
	public function setReviews($reviews): void
	{
		$this->reviews = $reviews;
	}
	
	/**
	 * @return mixed
	 */
	public function getComments()
	{
		return $this->comments;
	}
	
	/**
	 * @param mixed $comments
	 */
	public function setComments($comments): void
	{
		$this->comments = $comments;
	}
	
	/**
	 * @return mixed
	 */
	public function getYear()
	{
		return $this->year;
	}
	
	/**
	 * @param mixed $year
	 */
	public function setYear($year): void
	{
		$this->year = $year;
	}
	
	/**
	 * @return mixed
	 */
	public function getLicence()
	{
		return $this->licence;
	}
	
	/**
	 * @param mixed $licence
	 */
	public function setLicence($licence): void
	{
		$this->licence = $licence;
	}

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    /**
     * @param mixed $modified_at
     */
    public function setModifiedAt($modified_at): void
    {
        $this->modified_at = $modified_at;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @param mixed $created_by
     */
    public function setCreatedBy($created_by): void
    {
        $this->created_by = $created_by;
    }

    /**
     * @return mixed
     */
    public function getModifiedBy()
    {
        return $this->modified_by;
    }

    /**
     * @param mixed $modified_by
     */
    public function setModifiedBy($modified_by): void
    {
        $this->modified_by = $modified_by;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template): void
    {
        $this->template = $template;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime("now");
    }

    /**
     * @ORM\PreUpdate
     */
    public function setModifiedAtValue()
    {
        $this->modified_at = new \DateTime("now");
    }
}
