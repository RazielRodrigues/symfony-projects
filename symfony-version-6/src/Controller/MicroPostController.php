<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Form\CommentType;
use App\Form\MicroPostType;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class MicroPostController extends AbstractController
{

    // #[IsGranted('IS_AUTHENTICATED_FULLY')]
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicroPostRepository $posts): Response
    {
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts->findPostWithComment(),
        ]);
    }

    #[Route('/micro-post/follows', name: 'app_micro_post_follows')]
    public function follows(MicroPostRepository $posts): Response
    {
        /** @var User $currentUser  */
        $currentUser = $this->getUser();
        return $this->render('profile/follows.html.twig', [
            'user' => $currentUser,
            'posts' => $posts->findAllByAuthors($currentUser->getFollows())
        ]);
    }

    #[Route('/micro-post/top-liked', name: 'app_micro_post_topliked')]
    public function liked(MicroPostRepository $posts): Response
    {
        return $this->render('micro_post/top_liked.html.twig', [
            'posts' => $posts->findAllWithMinLikes(2),
        ]);
    }

    // SENSIO
    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function index2(MicroPost $post): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/micro-post/add', name: 'app_micro_post_add', priority: 2)]
    // #[IsGranted('ROLE_WRITTER')]
    public function add(Request $request, MicroPostRepository $microPostRepository): Response
    {
        $micropost = new MicroPost();
        $form = $this->createForm(MicroPostType::class);
        // $form = $this->createFormBuilder($micropost)
        //     ->add('title', TextType::class)
        //     ->add('text', TextType::class)
        //     ->add('save', SubmitType::class, ['label' => 'Create'])
        //     ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setAuthor($this->getUser());

            $microPostRepository->add($post, true);
            $this->addFlash('success', 'ok inserido!');

            return $this->redirectToRoute('app_micro_post');
        }

        return $this->render('micro_post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // #[IsGranted(MicroPost::EDIT, 'post')]
    #[Route('/micro-post/{post}/edit', name: 'app_micro_post_edit')]
    public function edit(MicroPost $post, Request $request, MicroPostRepository $microPostRepository): Response
    {
        $form = $this->createForm(MicroPostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setAuthor($this->getUser());

            $microPostRepository->add($post, true);

            $this->addFlash('success', 'ok editado!');
            return $this->redirectToRoute('app_micro_post');
        }

        return $this->render('micro_post/edit.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
        ]);
    }

    // #[IsGranted(MicroPost::VIEW, 'post')]
    #[Route('/micro-post/{post}/comment', name: 'app_micro_post_comment')]
    public function addComment(Request $request, MicroPost $post, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $comment = $form->getData();
            $comment->setPost($post);
            $comment->setAuthor($this->getUser());

            $commentRepository->add($comment, true);
            $this->addFlash('success', 'commented!');

            return $this->redirectToRoute('app_micro_post_show', ['post' => $post->getId()]);
        }

        return $this->render('micro_post/comment.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
}
