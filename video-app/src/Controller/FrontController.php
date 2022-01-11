<?php
/*
|--------------------------------------------------------
| copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------
*/
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Video;
use App\Repository\VideoRepository;
use App\Utils\CategoryTreeFrontPage;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Comment;

use App\Controller\Traits\Likes;
use App\Utils\VideoForNoValidSubscription;

class FrontController extends AbstractController
{

    use Likes;
    /**
     * @Route("/", name="main_page")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }

    /**
     * @Route("/video-list/category/{categoryname},{id}/{page}", defaults={"page": "1"}, name="video_list")
     */
    public function videoList($id, $page, CategoryTreeFrontPage $categories, Request $request, VideoForNoValidSubscription $video_no_members)
    {
        $ids = $categories->getChildIds($id);
        array_push($ids, $id);

        $videos = $this->getDoctrine()
        ->getRepository(Video::class)
        ->findByChildIds($ids ,$page, $request->get('sortby'));

        $categories->getCategoryListAndParent($id);
        return $this->render('front/video_list.html.twig',[
            'subcategories' => $categories,
            'videos'=>$videos,
            'video_no_members' => $video_no_members->check() // c_88
        ]);
    }

    /**
     * @Route("/video-details/{video}", name="video_details")
     */
    public function videoDetails(VideoRepository $repo, $video, VideoForNoValidSubscription $video_no_members)
    {
        return $this->render('front/video_details.html.twig',
        [
            'video'=>$repo->videoDetails($video),
            'video_no_members' => $video_no_members->check()
        ]);
    }

    /**
     * @Route("/new-comment/{video}", methods={"POST"}, name="new_comment")
    */
    public function newComment(Video $video, Request $request )
     {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');
        
        if ( !empty( trim($request->request->get('comment')) ) ) 
        {   

            // $video = $this->getDoctrine()->getRepository(Video::class)->find($video_id);
        
            $comment = new Comment();
            $comment->setContent($request->request->get('comment'));
            $comment->setUser($this->getUser());
            $comment->setVideo($video);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }
        
        return $this->redirectToRoute('video_details',['video'=>$video->getId()]);
     }

    /**
     * @Route("/search-results/{page}", methods={"GET"}, defaults={"page": "1"}, name="search_results")
     */
    public function searchResults($page, Request $request, VideoForNoValidSubscription $video_no_members)
    {
        $videos = null;
        $query = null;

        if($query = $request->get('query'))
        {
            $videos = $this->getDoctrine()
            ->getRepository(Video::class)
            ->findByTitle($query, $page, $request->get('sortby'));

            if(!$videos->getItems()) $videos = null;
        }
       
        return $this->render('front/search_results.html.twig',[
            'videos' => $videos,
            'query' => $query,
            'video_no_members' => $video_no_members->check()
        ]);
    }

    public function mainCategories()
    {
        $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findBy(['parent'=>null], ['name'=>'ASC']);
        return $this->render('front/_main_categories.html.twig',[
            'categories'=>$categories
        ]);
    }

        /**
     * @Route("/video-list/{video}/like", name="like_video", methods={"POST"})
     * @Route("/video-list/{video}/dislike", name="dislike_video", methods={"POST"})
     * @Route("/video-list/{video}/unlike", name="undo_like_video", methods={"POST"})
     * @Route("/video-list/{video}/undodislike", name="undo_dislike_video", methods={"POST"})
     */
    public function toggleLikesAjax(Video $video, Request $request)
    {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        switch($request->get('_route'))
        {
            case 'like_video':
            $result = $this->likeVideo($video);
            break;
            
            case 'dislike_video':
            $result = $this->dislikeVideo($video);
            break;

            case 'undo_like_video':
            $result = $this->undoLikeVideo($video);
            break;

            case 'undo_dislike_video':
            $result = $this->undoDislikeVideo($video);
            break;
        }

        return $this->json(['action' => $result,'id'=>$video->getId()]);
    }

}

