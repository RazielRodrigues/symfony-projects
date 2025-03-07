<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadMainCategories($manager);
        $this->loadElectronics($manager);
        $this->loadComputers($manager);
        $this->loadLaptops($manager);
        $this->loadBooks($manager);
        $this->loadMovies($manager);
        $this->loadRomance($manager);
    }

    private function loadMainCategories($manager)
    {
        foreach($this->getMainCategoriesData() as [$name] )
        {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }

        $manager->flush();
    }

    private function loadElectronics($manager)
    {
        $this->loadSubcategories($manager, 'Electronics', 1);
    }

    private function loadComputers($manager)
    {
        $this->loadSubcategories($manager, 'Computers', 6);
    }

    private function loadLaptops($manager)
    {
        $this->loadSubcategories($manager,'Laptops',8);
    }
    
    private function loadBooks($manager)
    {
        $this->loadSubcategories($manager,'Books',3);
    }
    
    private function loadMovies($manager)
    {
        $this->loadSubcategories($manager,'Movies',4);
    }
    
    private function loadRomance($manager)
    {
        $this->loadSubcategories($manager,'Romance',18);
    }

    private function loadSubcategories($manager, $category, $parent_id)
    {
        $parent = $manager->getRepository(Category::class)->find($parent_id);
        $methodName = "get{$category}Data";
        foreach($this->$methodName() as [$name] )
        {
            $category = new Category();
            $category->setName($name);
            $category->setParent($parent);
            $manager->persist($category);
        }

        $manager->flush();
    }

    private function getMainCategoriesData()
    {
        return [
            ['Electronics', 1],
            ['Toys', 2],
            ['Books', 3],
            ['Movies', 4],
        ];
    }

    private function getElectronicsData()
    {
        return [
            ['Cameras', 5],
            ['Computers', 6],
            ['Cell Phones', 7]
        ];
    }

    private function getComputersData()
    {
        return [
            ['Laptops', 8],
            ['Desktops', 9]
        ];
    }

    private function getLaptopsData()
    {
        return [

            ['Apple',10],
            ['Asus',11], 
            ['Dell',12], 
            ['Lenovo',13], 
            ['HP',14]

        ];
    }


    private function getBooksData()
    {
        return [
            ['Children\'s Books',15],
            ['Kindle eBooks',16], 
        ];
    }


    private function getMoviesData()
    {
        return [
            ['Family',17],
            ['Romance',18], 
        ];
    }


    private function getRomanceData()
    {
        return [
            ['Romantic Comedy',19],
            ['Romantic Drama',20], 
        ];
    }

}

