<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Organisation;
use Doctrine\ORM\EntityManager;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends EasyAdminController
{
    /** @var array The full configuration of the entire backend */
    protected $config;
    /** @var array The full configuration of the current entity */
    protected $entity;
    /** @var Request The instance of the current Symfony request */
    protected $request;
    /** @var EntityManager The Doctrine entity manager for the current entity */
    protected $em;

    protected $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    // Переопределил метод удаления на то что удалять может только админ
    protected function removeEntity($entity)
    {
        if (!in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            throw $this->createAccessDeniedException();
        }
        $this->em->remove($entity);
        $this->em->flush();
    }

    // Переопределил метод редактирования. если не админ пытается редактировать админа, то ошибка
    protected function createEditForm($entity, array $entityProperties)
    {
        if (is_a($entity, "App\Entity\User")) {
            if (!in_array('ROLE_ADMIN', $this->getUser()->getRoles()) AND in_array('ROLE_ADMIN', $entity->getRoles())) {
                throw $this->createAccessDeniedException();
            }
        }
        return $this->createEntityForm($entity, $entityProperties, 'edit');
    }


    protected function persistUserEntity($user)
    {

        //если юзер не админ и создает админа или эдитора, то ошибка
        if (!in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            if (in_array('ROLE_ADMIN', $user->getRoles()) OR in_array('ROLE_EDITOR', $user->getRoles())) {
                throw $this->createAccessDeniedException();
            }
        }

        if (count($user->getRoles()) == 1 AND  in_array('ROLE_USER', $user->getRoles())){
            $user->setRoles(['ROLE_USER']);
        }
        $encodedPassword = $this->encodePassword($user, $user->getPassword());
        $user->setPassword($encodedPassword);

        parent::persistEntity($user);
    }

    protected function updateUserEntity($user)
    {
        //если юзер не админ и дает права админа или эдитора, то ошибка
        if (!in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            if (in_array('ROLE_ADMIN', $user->getRoles()) OR in_array('ROLE_EDITOR', $user->getRoles())) {
                throw $this->createAccessDeniedException();
            }
        }

        if (count($user->getRoles()) == 1 AND  in_array('ROLE_USER', $user->getRoles())){
            $user->setRoles(['ROLE_USER']);
        }
        if ($user->getPlainPassword()) {
            $encodedPassword = $this->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encodedPassword);
        }

        parent::persistEntity($user);
    }

    public function createPageEntityFormBuilder($entity, $view)
    {
        $formBuilder = parent::createEntityFormBuilder($entity, $view);
        $templateArr = scandir('/var/www/catalog_site/templates/page', 1);
        foreach ($templateArr as $key => $value) {
            if (strpos($value, 'html.twig')) {
                $templates [] = [$value => $value];
            }
        }

        $formBuilder->add('template', ChoiceType::class, [
            'choices' => $templates
        ]);;
        return $formBuilder;
    }

    private function encodePassword($user, $password)
    {
        return $this->passwordEncoder->encodePassword($user, $password);
    }

    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {
        if ($entityClass == "App\Entity\Organisation" AND in_array('ROLE_CLIENT', $this->getUser()->getRoles())) {
            if (null === $dqlFilter) {
                $dqlFilter = sprintf('entity.managedBy = %s', $this->getUser()->getId());
            } else {
                $dqlFilter .= sprintf(' AND entity.managedBy = %s', $this->getUser()->getId());
            }
        }
        return parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);
    }
    
	
	
	protected function persistOrganisationEntity($user)
	{
		
		if ($user->getcountReview() === null) {
			$user->setcountReview(0);
		}
		
		if ($user->getlogoFile() !== null) {
			$user->getTitle() === null ? $user->setTitle('картинка организации') : $user->setTitle($user->getTitle());
			$user->getAlt() === null ? $user->setAlt('картинка организации') : $user->setAlt($user->getAlt());
		} else {
			$user->setTitle('');
			$user->setAlt('');
		}
		
		if ($user->getlogoFile1() !== null) {
			$user->getTitle1() === null ? $user->setTitle1('картинка организации') : $user->setTitle1($user->getTitle1());
			$user->getAlt1() === null ? $user->setAlt1('картинка организации') : $user->setAlt1($user->getAlt1());
		} else {
			$user->setTitle1('');
			$user->setAlt1('');
		}
		
		if ($user->getlogoFile2() !== null) {
			$user->getTitle2() === null ? $user->setTitle2('картинка организации') : $user->setTitle2($user->getTitle2());
			$user->getAlt2() === null ? $user->setAlt2('картинка организации') : $user->setAlt2($user->getAlt2());
		} else {
			$user->setTitle2('');
			$user->setAlt2('');
		}
		
		if ($user->getlogoFile3() !== null) {
			$user->getTitle3() === null ? $user->setTitle3('картинка организации') : $user->setTitle3($user->getTitle3());
			$user->getAlt3() === null ? $user->setAlt3('картинка организации') : $user->setAlt3($user->getAlt3());
		} else {
			$user->setTitle3('');
			$user->setAlt3('');
		}
		
		if ($user->getlogoFile4() !== null) {
			$user->getTitle4() === null ? $user->setTitle4('картинка организации') : $user->setTitle4($user->getTitle4());
			$user->getAlt4() === null ? $user->setAlt4('картинка организации') : $user->setAlt4($user->getAlt4());
		} else {
			$user->setTitle4('');
			$user->setAlt4('');
		}
		
		if ($user->getlogoFile5() !== null) {
			$user->getTitle5() === null ? $user->setTitle5('картинка организации') : $user->setTitle5($user->getTitle5());
			$user->getAlt5() === null ? $user->setAlt5('картинка организации') : $user->setAlt5($user->getAlt5());
		} else {
			$user->setTitle5('');
			$user->setAlt5('');
		}
		
		if ($user->getlogoFile6() !== null) {
			$user->getTitle6() === null ? $user->setTitle6('картинка организации') : $user->setTitle6($user->getTitle6());
			$user->getAlt6() === null ? $user->setAlt6('картинка организации') : $user->setAlt6($user->getAlt6());
		} else {
			$user->setTitle6('');
			$user->setAlt6('');
		}
		
		if ($user->getlogoFile7() !== null) {
			$user->getTitle7() === null ? $user->setTitle7('картинка организации') : $user->setTitle7($user->getTitle7());
			$user->getAlt7() === null ? $user->setAlt7('картинка организации') : $user->setAlt7($user->getAlt7());
		} else {
			$user->setTitle7('');
			$user->setAlt7('');
		}
		
		if ($user->getlogoFile8() !== null) {
			$user->getTitle8() === null ? $user->setTitle8('картинка организации') : $user->setTitle8($user->getTitle8());
			$user->getAlt8() === null ? $user->setAlt8('картинка организации') : $user->setAlt8($user->getAlt8());
		} else {
			$user->setTitle8('');
			$user->setAlt8('');
		}
		
		if ($user->getlogoFile9() !== null) {
			$user->getTitle9() === null ? $user->setTitle9('картинка организации') : $user->setTitle9($user->getTitle9());
			$user->getAlt9() === null ? $user->setAlt9('картинка организации') : $user->setAlt9($user->getAlt9());
		} else {
			$user->setTitle9('');
			$user->setAlt9('');
		}
		
		if ($user->getlogoFile10() !== null) {
			$user->getTitle10() === null ? $user->setTitle10('картинка организации') : $user->setTitle10($user->getTitle10());
			$user->getAlt10() === null ? $user->setAlt10('картинка организации') : $user->setAlt10($user->getAlt10());
		} else {
			$user->setTitle10('');
			$user->setAlt10('');
		}
		
		parent::persistEntity($user);
	}
	
	protected function updateOrganisationEntity($user)
	{
//		dd($user);
		if ($user->getlogoFile() !== null) {
			$user->getTitle() === null ? $user->setTitle('картинка организации') : $user->setTitle($user->getTitle());
			$user->getAlt() === null ? $user->setAlt('картинка организации') : $user->setAlt($user->getAlt());
		} else if ($user->getlogo() === null) {
			$user->setTitle('');
			$user->setAlt('');
		}
		
		if ($user->getlogoFile1() !== null) {
			$user->getTitle1() === null ? $user->setTitle1('картинка организации') : $user->setTitle1($user->getTitle1());
			$user->getAlt1() === null ? $user->setAlt1('картинка организации') : $user->setAlt1($user->getAlt1());
		} else if ($user->getlogo2() === null) {
			$user->setTitle1('');
			$user->setAlt1('');
		}
		
		if ($user->getlogoFile2() !== null) {
			$user->getTitle2() === null ? $user->setTitle2('картинка организации') : $user->setTitle2($user->getTitle2());
			$user->getAlt2() === null ? $user->setAlt2('картинка организации') : $user->setAlt2($user->getAlt2());
		} else if ($user->getlogo2() === null) {
			$user->setTitle2('');
			$user->setAlt2('');
		}
		
		if ($user->getlogoFile3() !== null) {
			$user->getTitle3() === null ? $user->setTitle3('картинка организации') : $user->setTitle3($user->getTitle3());
			$user->getAlt3() === null ? $user->setAlt3('картинка организации') : $user->setAlt3($user->getAlt3());
		} else if ($user->getlogo3() === null) {
			$user->setTitle3('');
			$user->setAlt3('');
		}
		
		if ($user->getlogoFile4() !== null) {
			$user->getTitle4() === null ? $user->setTitle4('картинка организации') : $user->setTitle4($user->getTitle4());
			$user->getAlt4() === null ? $user->setAlt4('картинка организации') : $user->setAlt4($user->getAlt4());
		} else if ($user->getlogo4() === null) {
			$user->setTitle4('');
			$user->setAlt4('');
		}
		
		if ($user->getlogoFile5() !== null) {
			$user->getTitle5() === null ? $user->setTitle5('картинка организации') : $user->setTitle5($user->getTitle5());
			$user->getAlt5() === null ? $user->setAlt5('картинка организации') : $user->setAlt5($user->getAlt5());
		} else if ($user->getlogo5() === null) {
			$user->setTitle5('');
			$user->setAlt5('');
		}
		
		if ($user->getlogoFile6() !== null) {
			$user->getTitle6() === null ? $user->setTitle6('картинка организации') : $user->setTitle6($user->getTitle6());
			$user->getAlt6() === null ? $user->setAlt6('картинка организации') : $user->setAlt6($user->getAlt6());
		} else if ($user->getlogo6() === null) {
			$user->setTitle6('');
			$user->setAlt6('');
		}
		
		if ($user->getlogoFile7() !== null) {
			$user->getTitle7() === null ? $user->setTitle7('картинка организации') : $user->setTitle7($user->getTitle7());
			$user->getAlt7() === null ? $user->setAlt7('картинка организации') : $user->setAlt7($user->getAlt7());
		} else if ($user->getlogo7() === null) {
			$user->setTitle7('');
			$user->setAlt7('');
		}
		
		if ($user->getlogoFile8() !== null) {
			$user->getTitle8() === null ? $user->setTitle8('картинка организации') : $user->setTitle8($user->getTitle8());
			$user->getAlt8() === null ? $user->setAlt8('картинка организации') : $user->setAlt8($user->getAlt8());
		} else if ($user->getlogo8() === null) {
			$user->setTitle8('');
			$user->setAlt8('');
		}
		
		if ($user->getlogoFile9() !== null) {
			$user->getTitle9() === null ? $user->setTitle9('картинка организации') : $user->setTitle9($user->getTitle9());
			$user->getAlt9() === null ? $user->setAlt9('картинка организации') : $user->setAlt9($user->getAlt9());
		} else if ($user->getlogo9() === null) {
			$user->setTitle9('');
			$user->setAlt9('');
		}
		
		if ($user->getlogoFile10() !== null) {
			$user->getTitle10() === null ? $user->setTitle10('картинка организации') : $user->setTitle10($user->getTitle10());
			$user->getAlt10() === null ? $user->setAlt10('картинка организации') : $user->setAlt10($user->getAlt10());
		} else if ($user->getlogo10() === null) {
			$user->setTitle10('');
			$user->setAlt10('');
		}
		
		parent::persistEntity($user);
	}
}