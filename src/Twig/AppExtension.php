<?php

namespace App\Twig;

use App\Entity\City;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Yamilovs\SypexGeo\Database\Mode;
use Yamilovs\SypexGeo\SypexGeo;

class AppExtension extends AbstractExtension
{

    private $em;

    private $container;

    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('currentCity', [$this, 'currentCity']),
            new TwigFunction('cityModal', [$this, 'cityModal'], ['is_safe' => ['html']]),
        ];
    }

    public function currentCity()
    {
        $sypexGeo = new SypexGeo($this->container->getParameter("kernel.project_dir") . '/SxGeoCity.dat', Mode::FILE);
        $city = $sypexGeo->getCity($_SERVER['REMOTE_ADDR']);
        $cityDB = $this->em->getRepository(City::class)->findOneBy(["name" => $city->getNameRu()]);
        if ($cityDB) {
            return $cityDB->getName();
        }
        return "Москва";
    }

    public function cityModal()
    {
        $cities = $this->em->getRepository(City::class)->findAll();

        return $this->container->get('twig')->render(
            'city-modal.html.twig',
            ['cities' => $cities]
        );
    }
}
