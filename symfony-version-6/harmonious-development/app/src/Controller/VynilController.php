<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VynilController extends AbstractController
{
    #[Route("/", name: 'app_home')]
    public function homepage()
    {

        $tracks = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Waterfalls', 'artist' => 'TLC'],
            ['song' => 'Creep', 'artist' => 'Radiohead'],
            ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];

        return $this->render(
            "vynyl/homepage.html.twig",
            ['tracks' => $tracks]
        );
    }

    #[Route("/browse/{genre}", name: 'app_browse')]
    public function browse(string $genre = null)
    {
        if ($genre) {
            $genre = str_replace('-', ' ', $genre);
        } else {
            $genre = "All genres";
        }

        return $this->render("vynyl/browse.html.twig", [
            'genre' => $genre
        ]);
    }
}
