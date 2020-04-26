<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

class BasePage
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;

    /**
     * @ORM\Column(type="text")
     */
    protected $short_description;

    /**
     * @ORM\Column(type="text")
     */
    protected $full_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $template;

    /**
     * @ORM\Column(type="text")
     */
    protected $custom_code;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $show_org;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $meta_title;

    /**
     * @ORM\Column(type="text")
     */
    protected $meta_description;

    /**
     * @ORM\Column(type="text")
     */
    protected $meta_keywords;

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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * @param mixed $short_description
     */
    public function setShortDescription($short_description): void
    {
        $this->short_description = $short_description;
    }

    /**
     * @return mixed
     */
    public function getFullDescription()
    {
        return $this->full_description;
    }

    /**
     * @param mixed $full_description
     */
    public function setFullDescription($full_description): void
    {
        $this->full_description = $full_description;
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
     * @return mixed
     */
    public function getCustomCode()
    {
        return $this->custom_code;
    }

    /**
     * @param mixed $custom_code
     */
    public function setCustomCode($custom_code): void
    {
        $this->custom_code = $custom_code;
    }

    /**
     * @return mixed
     */
    public function getMetaTitle()
    {
        return $this->meta_title;
    }

    /**
     * @param mixed $meta_title
     */
    public function setMetaTitle($meta_title): void
    {
        $this->meta_title = $meta_title;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * @param mixed $meta_description
     */
    public function setMetaDescription($meta_description): void
    {
        $this->meta_description = $meta_description;
    }

    /**
     * @return mixed
     */
    public function getMetaKeywords()
    {
        return $this->meta_keywords;
    }

    /**
     * @param mixed $meta_keywords
     */
    public function setMetaKeywords($meta_keywords): void
    {
        $this->meta_keywords = $meta_keywords;
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