# Symfony 5

    composer create-project symfony/skeleton my_project_name
    php -S 127.0.0.1:8000 -t public

## Controllers

    php bin/console make:controller ControllerName

#### Methods

    //? Return to a page with parameter to access from twig
    return $this->render('default/index.html.twig', ['controller_name' => 'DefaultController',]);

    //? Return a json string
    // return $this->json(['controller_name' => 'DefaultController',]);
    
    //? Redirect to a link
    // return $this->redirect('google.com');

    //? Redirect to a  Route with or not paramaters
    // return $this->redirectToRoute('default2');

    //? Create a new response object
    return new Response('from controller default 1');

    //? Redirect to another page
    return forward('default1');

## Models

    composer require doctrine

    -- After config .env
    php bin/console doctrine:database:create

    php bin/console make:entitity EntityName

    php bin/console make:migrations

    php bin/console doctrine:migrations:migrate

#### Methods


