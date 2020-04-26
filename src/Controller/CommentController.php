<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Organisation;
use App\Entity\Comment;
use App\Entity\SubscriptionPlan;
use App\Entity\User;
use App\Form\FeedbackForm;
use App\Form\ResetPasswordType;
use App\Form\CommentForm;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/{slug}", name="comment_create")
     */
    public function update(Request $request, \Swift_Mailer $mailer)
    {
	    $review = new Comment();
	    $form = $this->createForm(CommentForm::class, $review);
	    $form->handleRequest($request);
	    $em = $this->getDoctrine()->getManager();
	
	    if ($form->isSubmitted() ) {
		    $review = $form->getData();
		    // 0 отзыв, 1 комментарий
		    $request->request->get('review_form')['type'] == 0 ? $review->setType(0) : $review->setType(1);
		    $subComment = $request->request->get('comment_form')['sub_comment'];
		    $userForm = $request->request->get('comment_form')['user'];
		    $organisationForm = $request->request->get('comment_form')['organisation'];
		    $organisation = $em->getRepository(Organisation::class)->find($organisationForm);
		    $user = $em->getRepository(User::class)->find($userForm);
		    
		    $review->setOrganisation($organisation);
		    $review->setUser($user);
		    $review->setSubComment($subComment);
		    $em->persist($review);
		    $em->flush();
	    }
	
	    $id = $review->getOrganisation()->getId();
		$email = $request->request->get('comment_form')['email'];
	    $header = $request->request->get('comment_form')['header'];
	    $comment = $request->request->get('comment_form')['comment'];
	    $message = (new \Swift_Message('Коммент с сайта'))
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