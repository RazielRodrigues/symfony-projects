<img src="UC-64161c22-5dc7-48c4-94e4-ceb92598910d.jpg">

"Symfony is a widely used php web framework is a very interest and powerful"

# Checkout my projects

    - checkout symfony-to-do-app
    - checkout symfony-video-social-network-app
    - checkout symfony-api-platform-app
    - checkout symfony-message-broker-app
    - checkout symfony-4-video-app

## Symfony Core Features

    composer create-project symfony/skeleton my_project_name

    composer require symfony/apache-pack
    composer require symfony/maker-bundle --dev
    composer require doctrine/annotations
    composer require twig

    php -S 127.0.0.1:8000 -t public

## Routes

    Handle requests, can be defined by php, annotations or yaml file

#### Methods


    /**
    * @Route("/blog/{page?}", name="blog_list", methods={POST})
    */
    public function index2()
    {
        return new Response('Optional parameters in url and 
        requirements for parameters');
    }

    /**
    * @Route("/blog/{page?}", name="blog_list", methods={GET})
    */
    public function index2()
    {
        return new Response('Optional parameters in url and 
        requirements for parameters');
    }

    /**
    * @Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
    */
    public function index2()
    {
        return new Response('Optional parameters in url and 
        requirements for parameters');
    }

    /**
    * @Route(
    *      "/articles/{_locale}/{year}/{slug}/{category}",
    *      defaults={"category": "computers"},
    *      requirements={
    *         "_locale": "en|fr", 
    *          "category": "computers|rtv",
    *          "year": "\d+"
    *      }    
    * )
    */
    public function index3()
    {
        return new Response('An advanced route example');
    }

    /**
    * @Route({
    *      "nl": "/over-ons",
    *       "en": "/about-us"
    * }, name="about_us")
    */
    public function index4()
    {
        return new Response('Translated routes');
    }

## Controllers

    php bin/console make:controller ControllerName

#### Methods

    //? Return to a page with parameter to access from twig
    return $this->render('default/index.html.twig', ['controller_name' => 'DefaultController',]);

    //? Return a json string
    // return $this->json(['controller_name' => 'DefaultController',]);
    
    The message component send the action to RabbiMQ that spool the action
    inside a AMPQ server that, delegate where and to whose send the action
    it can be in the same system or in another system.

    Any example is, a customer buy something inside a e-commerce
    and our system needs to update the warehouse of the store
    to don't freeze the user in a windows until this action
    is completed we send any action async to another system
    in the same time we are completing the shopping we are
    updating the database of the warehouse.

###### Symfony message component diagram

![image info](./images/symfony-message-component.png)

##### A flow of message inside symfony simulating a e-shop

![image info](./images/symfony-message-flow.png)

##### RabbitMQ actions delegate flow

![image info](./images/rabbitmq-2.png)

# CQRS

    Is a design that needs to be implemented when working with message brokers
    the goal here is segregate the action of the message.
        
    A message component should have:
        - Query: only retrieve some information
        - Command: do something like connect to some API or save something inside database
        - Handler do all business logic

    A message is like a event, that need to be dispatched by a broker.

## Symfony Messenger

    Provide methods to dispatch envelopes

    1. install the component
    2. edit .env
    3. edit messenger.yaml
    4. edit services.yaml
    5. create the handlers and assign them inside messenger as async
    6. php bin/console messenger:consume -vv (Execute messages if with doctrine transport)

#### Methods

    - MessageBusInterface inside controller
    - $this->messageBus->dispatch(new SignUpSms($phoneNumber));
    - $this->handler(new SignUpSms($phoneNumber)); (use HandlerTrait)
    - public function __invoke(SignUpSms $signUpSms)

## RabbitMQ

    Is a AMPQ server that handle messages and send to different applications

    1. uncomment the entry inside .env
    2. create the transport at messenger.yaml
    
    at this point let's imagine that needs to send to another microservice
    Needs to configure like the first project
        - configure the .env
        - configure the service.yaml
        - configure the messenger.yaml
        - create the ques inside RabbitMQ or symfony will do
        - bind the ques
        - inside the microservice that you send the action needs to have the command you want to execute

##### Installation

    - check: https://dev.to/rezende79/how-to-install-amqp-extension-for-php-7-4-on-windows-10-108d
    - after access: http://localhost:15672/#/