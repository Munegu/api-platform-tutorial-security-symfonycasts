<?php


namespace App\Tests\Functional;


use App\Test\CustomApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class CheeseListingRessourceTest extends CustomApiTestCase
{
    use ReloadDatabaseTrait;

    public function testCreateCheeseListing()
    {
        $client = self::createClient();
        $client->request('POST','/api/cheeses', [
            'json' => [],
        ]);

        self::assertResponseStatusCodeSame(401);

        $this->createUserAndLogIn($client,'cheeseplease@example.com', 'foo');

        $client->request('POST','/api/cheeses', [
            'json' => [],
        ]);
        $this->assertResponseStatusCodeSame(400);

    }
}