<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\City;
use App\Twig\AppExtension;
use App\Entity\Feedback;
use App\Entity\Organisation;
use App\Entity\SubscriptionPlan;
use App\Entity\User;
use App\Form\FeedbackForm;
use App\Form\RegistrationForm;
use App\Form\ResetPasswordType;
use App\Repository\OrganisationRepository;
use App\Security\LoginFormAuthenticator;
use App\Service\SMSService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Knp\Component\Pager\PaginatorInterface;

class IndexController extends AbstractController
{
    private $session;
    private $serializer;

    public function __construct(SessionInterface $session, SerializerInterface $serializer)
    {
        $this->session = $session;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator, OrganisationRepository $repository)
    {
        $organisations = $repository->organisationSort();
	    $organisations = $paginator->paginate(
		    $organisations, /* query NOT result */
		    $request->query->getInt('page', 1)/*page number*/,
		    15/*limit per page*/
	    );
	    $category = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('index.html.twig', [
            'organisations' => $organisations,
            'category' => $category
        ]);
    }

    /**
     * @Route("/registration", name="app_registration")
     */
    public function registration(Request $request,
                                 UserPasswordEncoderInterface $passwordEncoder,
                                 LoginFormAuthenticator $authenticator,
                                 GuardAuthenticatorHandler $guardHandler)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(RegistrationForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data["phone"] = preg_replace('/[^0-9]/', '', $data["phone"]);
            $repository = $this->getDoctrine()->getRepository(User::class);
            if ($this->session->get('sms_code') != $data['sms_code']) {
                $form->addError(new FormError("Неверный код из СМС!"));
            } else if ($repository->findOneBy(['email' => $data['email']])) {
                $form->addError(new FormError("Такой e-mail уже используется!"));
            } else if (!is_numeric($data['phone'])) {
                $form->addError(new FormError("Телефон должен содержать только цифры!"));
            } else if ($repository->findOneBy(['phone' => $data['phone']])) {
                $form->addError(new FormError("Такой телефон уже используется!"));
            } else if (strlen($data['password']) < 8) {
                $form->addError(new FormError("Пароль должен быть минимум из 8 символов!"));
            } else if ($data['password'] !== $data['repeat_password']) {
                $form->addError(new FormError("Пароль не совпадает!"));
            } else {
                $user = new User();
                $user->setName($data['name']);
                $user->setPhone($data['phone']);
                $user->setEmail($data['email']);
                $user->setRoles(['ROLE_USER']);
                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $data['password']
                ));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                return $guardHandler->authenticateUserAndHandleSuccess(
                    $user,          // the User object you just created
                    $request,
                    $authenticator, // authenticator whose onAuthenticationSuccess you want to use
                    'main'          // the name of your firewall in security.yaml
                );
            }
        }
        return $this->render('registration.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/change_password", name="app_change_password")
     */
    public function resetPasswordAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(ResetPasswordType::class, $user);
        $oldPassword = $request->request->get('reset_password')['oldPassword'];
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
                $newEncodedPassword = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($newEncodedPassword);
                $em->persist($user);
                $em->flush();
                $this->addFlash('success', 'Ваш пароль был изменен!');
            } else {
                $this->addFlash('error', 'Неверный старый пароль!');
            }
        }

        return $this->render('reset-password.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact(Request $request)
    {
        $form = $this->createForm(FeedbackForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $repository = $this->getDoctrine()->getRepository(Feedback::class);
            $user = new Feedback();
            $user->setName($data['name']);

            $brochureFile = $form->get('attachment')->getData();
            $uploads_directoty = $this->getParameter('uploads_directoty');
            $filename = md5(uniqid()) . '.' . $brochureFile->guessExtension();
            $brochureFile->move(
                $uploads_directoty,
                $filename
            );
            $filepath = '/uploads/files/contact_forms/' . $filename;
            $user->setAttachment($filepath);

            $user->setTheme($data['theme']);
            $user->setEmail($data['email']);
            $user->setMessage($data['message']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
        }
        return $this->render('contact.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/accept_phone", name="app_accept_phone")
     */
    public function accept_phone(Request $request, SMSService $SMSService)
    {

        $random = rand(100000, 999999);

        $this->session->set('sms_code', $random);

        $response = $SMSService->sendSMS($request->get('phone'), $random);

        return new JsonResponse($response);
    }


    /**
     * @Route("/filtre", name="app_filtre")
     */
    public function filtre(Request $request, OrganisationRepository $repository, PaginatorInterface $paginator)
    {
        $filtrearr = ['rating' => $request->get('rating'), 'category' => $request->get('clinic-type'), 'count_review' => $request->get('count_review'), 'city' => $request->get('city')];

        return new JsonResponse($this->serializer->serialize($repository->filtre($filtrearr), 'json'));
    }


    /**
     * @Route("/search", name="app_search")
     */
    public function search(Request $request, OrganisationRepository $repository, PaginatorInterface $paginator)
    {
	    $organisations = $repository->search($request->get('search'));
    	
	    $requestSearch = $paginator->paginate(
		    $organisations, /* query NOT result */
		    $request->query->getInt('page', 1)/*page number*/,
		    15/*limit per page*/
	    );

        return $this->render('index.html.twig', [
            'organisations' => $requestSearch,
        ]);
    }

}