# Symfony 5

    composer create-project symfony/skeleton my_project_name
    php -S 127.0.0.1:8000 -t public

## Routes

...

#### Methods

...

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

## Views

...

#### Methods

...


## Entities

    composer require doctrine

    -- After config .env
    php bin/console doctrine:database:create

    php bin/console make:entitity EntityName

    php bin/console make:migrations

    php bin/console doctrine:migrations:migrate

#### Methods

    Lazy loading: when you get all data like findAll()
    Eager loading: when you create a method inside entity and return specific data
    
    one to one relationship
        - relation in the field of new entity
        - choose the table that refrences
        - to remove all when delete: cascade = remove or orphanRemove = true
    
    polymorphic queries returns a various type of object
        - create a abstract class ex: file 
            - video and pdf class extends file
        - remove get and set id method from child classes
        - have some ORM rules to be put inside abstract class
            /**
            * @ORM\InheritanceType("JOINED") // Create a table for each class
            * @ORM\InheritanceType("SINGLE_TABLE") // One table for all class
            * @ORM\DiscriminatorColumn(name="type", type="string") // The column that have the object type
            * @ORM\DiscriminatorMap({"video"="Video" , "pdf"="Pdf"}) // Link with the class
            */

## Services

...

#### Methods

    - auto wire
        - automatic configure the service in the container interface

    - @required
        - this annotation transform a normal method like a construct can use with traits to do optional constructs for my classes

    - lazy load services options
        - create a instance only if the method that use the service is called
        - requires a proxy-bridge-package
    
    - tags
        - you can add a listener inside your service to execute some method when a action occurs ex: flush doctrine
    
    - parameters
        - can be set default parameters at service.yaml

    - aliases
        - you can create aliases to the services

    - service interface
        - can change service.yaml file

## Cache

    composer require symfony/cache

#### Methods
    
        - create a cache and delete it also can add expire time
            $cache = new FilesystemAdapter();
            $posts_from_db = ['post 1', 'post 2', 'post 3']
            $posts->set(serialize($posts_from_db));
            $posts->expiresAfter(5);
            $posts = $cache->getItem('database.get_posts');
            $cache->deleteItem('database.get_posts');
            $cache->clear();
            dump(unserialize($posts->get()));
        
        - create cache with tags
            $cache = new TagAwareAdapter(
                new FilesystemAdapter()
            );
            $acer = $cache->getItem('acer');
            if (!$acer->isHit())
            {
                $acer_from_db = 'acer laptop';
                $acer->set($acer_from_db);
                $acer->tag(['computers','laptops','acer']);
                $cache->save($acer);
            }
            $cache->invalidateTags(['computers']);
            dump($acer->get());


## 

...

#### Methods

...

## Others

    - flash messages
    - cookies
    - session
    - post e get data
    - custom error pages
    - handle exceptions


