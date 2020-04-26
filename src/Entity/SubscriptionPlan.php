<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionPlanRepository")
 */
class SubscriptionPlan
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
	private $subscriptionPlan;

    public function getId(): ?int
    {
        return $this->id;
    }
	
	public function __toString()
	{
		return $this->subscriptionPlan;
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
}
