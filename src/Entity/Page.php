<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 * @ORM\HasLifecycleCallbacks()
 */

class Page extends BasePage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $show_page;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getShowPage()
    {
        return $this->show_page;
    }

    /**
     * @param mixed $show
     */
    public function setShowPage($show_page): void
    {
        $this->show_page = $show_page;
    }
}
