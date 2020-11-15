<?php

namespace App\Tests;

use Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Conponent\Routing\RouterInterface;

/**
 * Class RegistrationTest
 * @package App\Tests
 */

class RegistrationTest extends WebTestCase
{
    /**
     * @param string $role
     * @dataProvider provideRoles
     */
    public function testSuccessfulRegistration(string $role): void
    {
        $client = static::createClient();

        /** @var RouterInterface $router */
        $router = $client->getContainer()->get("router");

        $crawler = $client->request(Request::METHOD_GET, $router->generate("security_registration", [
            "role" => $role
        ]));

        $form = $crawler->filter("form[name=registration]")->form([
            "registation[email]" => "email@email.com",
            "registation[plainpassword]" => "password",
            "registation[firstname]" => "FooFoo",
            "registation[lastname]" => "BarBar"
        ]);

        $client->submit($form);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }

    /**
     * @return Generator
     */
    public function provideRoles(): Generator
    {
        yield ['producer'];
        yield ['customer'];
    }
}
