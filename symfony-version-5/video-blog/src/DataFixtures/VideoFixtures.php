<?php
/*
|--------------------------------------------------------
| copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------
*/
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Video;
use App\Entity\Category;
use App\Entity\User;

class VideoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach($this->VideoData() as [$title, $path, $category_id])
        {
            $duration = random_int(10,300);
            $category = $manager->getRepository(Category::class)->find($category_id);
            $video = new Video();
            $video->setTitle($title);
            $video->setPath('https://player.vimeo.com/video/'.$path);
            $video->setCategory($category);
            $video->setDuration($duration);
            $manager->persist($video);
        }

        $manager->flush();
        $this->loadLikes($manager);
        $this->loadDislikes($manager);
    }

    public function loadLikes($manager)
    {
        foreach($this->likesData() as [$video_id, $user_id])
        {

            $video = $manager->getRepository(Video::class)->find($video_id);
            $user = $manager->getRepository(User::class)->find($user_id);

            $video->addUsersThatLike($user);
            $manager->persist($video);
        }
    
            $manager->flush();
           
    }

    public function loadDislikes($manager)
    {
        foreach($this->dislikesData() as [$video_id, $user_id])
        {

            $video = $manager->getRepository(Video::class)->find($video_id);
            $user = $manager->getRepository(User::class)->find($user_id);

            $video->addUsersThatDontLike($user);
            $manager->persist($video);
        }

        $manager->flush();
       
    }

    private function VideoData()
    {
        return [

            ['Movies 1',289729765,4],
            ['Movies 2',238902809,4],
            ['Movies 3',150870038,4],
            ['Movies 4',219727723,4],
            ['Movies 5',289879647,4],
            ['Movies 6',261379936,4],
            ['Movies 7',289029793,4],
            ['Movies 8',60594348,4],
            ['Movies 9',290253648,4],

            ['Family 1',289729765,17],
            ['Family 2',289729765,17],
            ['Family 3',289729765,17],

            ['Romantic comedy 1',289729765,19],
            ['Romantic comedy 2',289729765,19],

            ['Romantic drama 1',289729765,20],

            ['Toys  1',289729765,2],
            ['Toys  2',289729765,2],
            ['Toys  3',289729765,2],
            ['Toys  4',289729765,2],
            ['Toys  5',289729765,2],
            ['Toys  6',289729765,2]

        ];
    }

    private function likesData()
    {
            return [
    
                [12,1],
                [12,2],
                [12,3],
    
                [11,1],
                [11,2],
    
                [1,1],
                [1,2],
                [1,3],
    
                [2,1],
                [2,2]
    
            ];
    }

    private function dislikesData()
    {
        return [

            [10,1],
            [10,2],
            [10,3]

        ];
    }
}

