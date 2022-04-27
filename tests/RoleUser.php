<?php
namespace App\Tests;

trait RoleUser {

    public function setUp()
    {
        parent::setUp();
        $this->client = static::createClient([], [
            'PHP_AUTH_USER' => 'jd@symf4.loc',
            'PHP_AUTH_PW' => 'passw',
        ]);
        // $this->client->disableReboot();

        $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        // $this->entityManager->beginTransaction();
        // $this->entityManager->getConnection()->setAutoCommit(false);
    }

    public function tearDown()
    {
        parent::tearDown();
        // $this->entityManager->rollback();    
        $this->entityManager->close();    
        $this->entityManager = null; // avoid memory leaks   
    }
}
