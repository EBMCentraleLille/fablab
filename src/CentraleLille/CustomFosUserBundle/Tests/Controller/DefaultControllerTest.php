<?php

namespace CentraleLille\CustomFosUserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }

    // public function testLoginWithBadCredentials()
    // {
    //     $this->testLogin('Lucas', 'Hey there!', 'Invalid credentials');
    // }
    //
    // public function testLoginWithFixtureCredentials()
    // {
    //     $this->testLogin('admin', 'admin', 'Hello World!');
    // }
    //
    // /**
    //  * @group ignore
    //  */
    // public function testLogin($username, $password, $answer)
    // {
    //     $client = static::createClient();
    //     $client->followRedirects();
    //
    //     $crawler = $client->request('GET', '/login');
    //     $this->assertEquals(
    //         200,
    //         $client->getResponse()->getStatusCode(),
    //         "Unexpected HTTP status code for GET /login"
    //     );
    //
    //     $form = $crawler->selectButton('_submit')->form();
    //
    //     // set some values
    //     $form['_username'] = $username;
    //     $form['_password'] = $password;
    //
    //     // submit the form
    //     $client->submit($form);
    //
    //     $this->assertEquals(
    //         200,
    //         $client->getResponse()->getStatusCode()
    //     );
    //
    //     $this->assertContains($answer, $client->getResponse()->getContent());
    // }
}
