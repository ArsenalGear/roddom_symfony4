<?php
	
	namespace App\DataFixtures;
	
	
	use App\Entity\City;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Common\Persistence\ObjectManager;
	use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
	
	class CityFixtures extends Fixture
	{
		
		public function load(ObjectManager $manager)
		{
    	
	    $cityName = ["Москва", "Тамбов", "Казань", "Санкт-Петербург", "Новосибирск", "Екатеринбург", "Нижний-Новгород", "Челябинск", "Омск", "Самара", "Ростов-на-Дону",
		    "Уфа", "Красноярск", "Воронеж", "Пермь", "Волгоград", "Краснодар", "Саратов", "Тюмень", "Тольятти", "Ижевск", "Барнаул", "Ульяновск", "Иркутск", "Хабаровск",
		    "Ярославль", "Владивосток", "Махачкала", "Томск", "Оренбург", "Кемерово", "Новокузнецк", "Рязань", "Астрахань", "Набережные-Челны", "Пенза", "Киров", "Липецк"];
	    $citySlug = ['moscow', 'tambov', 'kazan', "Sankt-Peterburg", "Novosibirsk", "Ekaterinburg", "Nizhnij-Novgorod", "CHelyabinsk", "Omsk", "Samara", "Rostov-na-Donu",
		    "Ufa", "Krasnoyarsk", "Voronezh", "Perm", "Volgograd", "Krasnodar", "Saratov", "Tyumen", "Tolyatti", "Izhevsk", "Barnaul", "Ulyanovsk", "Irkutsk", "Habarovsk"
		    , "YAroslavl", "Vladivostok", "Mahachkala", "Tomsk", "Orenburg", "Kemerovo", "Novokuzneck", "Ryazan", "Astrahan", "Naberezhnye-CHelny", "Penza", "Kirov", "Lipeck"];
	    
	    for ($i = 0; $i < count($cityName); $i++) {
		    $product = new City();
		    
		    $product->setName($cityName[$i]);
		    $product->setSlug($citySlug[$i]);
		    $manager->persist($product);
	    }
	    
	    $manager->flush();
    }
	}
