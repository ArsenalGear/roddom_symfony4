<?php

namespace App\Controller;

use App\Entity\Organisation;
use App\Entity\Review;
use App\Entity\SubscriptionPlan;
use App\Entity\User;
use App\Form\FeedbackForm;
use App\Form\ResetPasswordType;
use App\Form\ReviewForm;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SMSService;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReviewController extends AbstractController
{
	/**
	 * @Route("/review/{slug}", name="review_create")
	 */
	public function update(Request $request, SMSService $SMSService, \Swift_Mailer $mailer)
	{
		$review = new Review();
		$form = $this->createForm(ReviewForm::class, $review);
		$form->handleRequest($request);
		$em = $this->getDoctrine()->getManager();
		
		if ($form->isSubmitted() && $request->isMethod('post')   ) {
			$review = $form->getData();
			// 0 отзыв, 1 комментарий
			$request->request->get('review_form')['type'] == 0 ? $review->setType(0) : $review->setType(1);
			
			$rating = $request->request->get('rating');
			$review->setRating($rating);
			$subComment = $request->request->get('review_form')['sub_comment'];
			$userForm = $request->request->get('review_form')['user'];
			$organisationForm = $request->request->get('review_form')['organisation'];
			$user = $em->getRepository(User::class)->find($userForm);
			$organisation = $em->getRepository(Organisation::class)->find($organisationForm);
			$review->setOrganisation($organisation);
			$review->setUser($user);
			$review->setSubComment($subComment);

			$id = $review->getOrganisation()->getId();
			$organisationReview = $this->getDoctrine()
				->getRepository(Organisation::class)
				->find($id);
			
			$finalRating = $review->getOrganisation()->getRating();
			$reviewCount = $review->getOrganisation()->getCountReview();

			$organisationReview->setRating(round(($finalRating+(int)$rating)/($reviewCount+1)));
			$organisationReview->setCountReview(round($reviewCount+1));
			
			$em->persist($review);
			$em->persist($organisationReview);
			$em->flush();
		}

		if ($request->request->get('review_form')['type'] == 0) {
			$phone = $review->getOrganisation()->getPhone();
			$phone = str_replace(array('(', ')', ' ', '-'), '', $phone );
			$random = urlencode($request->request->get('review_form')['comment']);
			//		расскоментировать для отправки смс
//			$SMSService->sendSMS($phone, $random);
		}
		
		$email = $request->request->get('review_form')['email'];

		$header = $request->request->get('review_form')['header'];
		$comment = $request->request->get('review_form')['comment'];
		$message = (new \Swift_Message('Отзыв с сайта'))
			->setFrom('maternityhospital68@gmail.com')
			->setTo($email)
			->setBody(
				$this->renderView(
					'email.html.twig',
					['header' => $header, 'comment' => $comment]
				)
			)
		;
		$mailer->send($message);
		
		return $this->redirectToRoute('organisation_show',array(
			'slug' => $id,
		) );
	}
}