<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="front_post_index")
     */
    public function index(PostRepository $postRepository, PaginatorInterface $paginator, Request $request)
    {
        $posts = $paginator->paginate(
            $postRepository->findAllVisibleQuery(),
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        return $this->render('front/post/index.html.twig', [
            'posts' => $posts,
        ]);

    }
}
