<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/post/new", name="post_new", methods={"GET","POST"})
     */
    public function new(Request $request, ObjectManager $manager): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        //dd($post);
        //die();

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($post->getCategories() as $category){
                $category->addPost($post);
                $manager->persist($category);
            }

            $post->setAuthor($this->getUser());
            $manager->persist($post);

            //$entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($post);
            $manager->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('front/post/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
}
