<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{

    #[Route('api/song/{id<\d+>}', name: 'app_song_getsong', methods: 'GET')]
    public function song(int $id)
    {
        return $this->json([
            'id' => $id,
            'name' => 'Waterfalls',
            'url' => 'https://symfonycasts.s3.amazonaws.com/sample.mp3',
        ], 200);
    }
}
