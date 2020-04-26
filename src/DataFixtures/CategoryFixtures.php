<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CategoryFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
		$categoryMassive = ['Коммерческие', 'Государственные'];
    	
	    for ($i = 0; $i < count($categoryMassive); $i++) {
		    $category = new Category();
		    $category->setCategoryName($categoryMassive[$i]);
		    $manager->persist($category);
	    }
	
	    $manager->flush();
    }
}
