<?php


namespace App\Tests\Functional;


use App\ApiPlatform\Test\ApiTestCase;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CheeseListingRessourceTest extends ApiTestCase
{
    public function testCreateCheeseListing()
    {
        $client = self::createClient();
        $client->request('POST','/api/cheeses', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [],
        ]);

        $this->assertResponseStatusCodeSame(401);


        $user = new User();
        $user->setEmail('emaildetest@orange.fr');
        $user->setUsername('username');
        $user->setPassword('$2y$13$ywezyFzIOcHbNsaFDrX9b.ZM8zxVz1o4tYJ8nVmxHkgc26XXOU/rO');

        $em = self::$container->get(EntityManagerInterface::class);
        $em->persist($user);
        $em->flush();

        $client->request('POST','/login', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'email' => 'emaildetest@orange.fr',
                'password' => 'foo'
            ],
        ]);
        $this->assertResponseStatusCodeSame(204);
    }
}