<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\City;
use App\Entity\Organisation;
use App\Entity\Review;
use App\Entity\SubscriptionPlan;
use App\Form\ReviewFormType;
use App\Repository\OrganisationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Yamilovs\SypexGeo\Database\Mode;
use Yamilovs\SypexGeo\SypexGeo;

class OrganisationController extends AbstractController
{

    /**
     * @Route("/organisations", name="organisation_list")
     */
    public function index(Request $request, OrganisationRepository $repository, EntityManagerInterface $em, ContainerInterface $container)
    {
        if ($request->cookies->get('city-cookie')) {
            $city = $request->cookies->get('city-cookie');
        }
        else {
            $sypexGeo = new SypexGeo($container->getParameter("kernel.project_dir") . '/SxGeoCity.dat', Mode::FILE);
            $cityUser = $sypexGeo->getCity($_SERVER['REMOTE_ADDR']);
            $cityDB = $em->getRepository(City::class)->findOneBy(["name" => $cityUser->getNameRu()]);
            if ($cityDB) {
                $city = $cityDB->getName();
            } else {
                $city = "Москва";
            }
        }
	    
        $organisations = $repository->findByCity($city);
        return $this->render('catalog.html.twig', [
            'organisations' => $organisations,
        ]);
    }
	
	/**
	 * @Route("/city/{slug}", name="organisation_city")
	 */
	public function city(Request $request, PaginatorInterface $paginator, $slug, OrganisationRepository $repository, EntityManagerInterface $em, ContainerInterface $container)
	{
		$organisations = $repository->findByCitySlug($slug);
		$city = $this->getDoctrine()
			->getRepository(City::class)
			->findOneBy(['slug' => $slug])
			->getName();
        $category = $this->getDoctrine()->getRepository(Category::class)->findAll();
		$organisations = $paginator->paginate(
			$organisations, /* query NOT result */
			$request->query->getInt('page', 1)/*page number*/,
			15/*limit per page*/
		);
		return $this->render('catalog.html.twig', [
			'organisations' => $organisations,
			'city' => $city,
            'category' => $category
		]);
	}

    /**
     * @Route("/organisations/{slug}", name="organisation_show")
     */
    public function show(Request $request, $slug, EntityManagerInterface $em, PaginatorInterface $paginator)
    {
        $organisation = $this->getDoctrine()
            ->getRepository(Organisation::class)
            ->find($slug);

        $allOrganisations = $this->getDoctrine()
            ->getRepository(Organisation::class)
            ->findByCitySlug($organisation->getCity()->getSlug());

        $num = array_search($organisation, $allOrganisations);

        if (!$organisation OR !$organisation->getShowOrg()) {
            throw $this->createNotFoundException(
                'No organisation found for id ' . $slug
            );
        }
	
	    $reviews= $this->getDoctrine()->getManager()
		    ->createQueryBuilder()
		    ->select('p')
		    ->from(Review::class, 'p')
		    ->leftJoin(Organisation::class, 'pp', 'with', 'p.organisation = pp.id')
		    ->Where('p.subComment ='.   '0')
		    ->andWhere('pp.id ='.   $slug)
		    ->orderBy('p.created', 'DESC')
		    ->getQuery()
		    ->getResult();

	    $reviews = $paginator->paginate(
		    $reviews, /* query NOT result */
		    $request->query->getInt('page', 1)/*page number*/,
		    10/*limit per page*/
	    );

        return $this->render('organisation/show.html.twig', [
            'organisation' => $organisation,
            'reviews' => $reviews,
            'position_in_city' => $num+1
        ]);
    }

}