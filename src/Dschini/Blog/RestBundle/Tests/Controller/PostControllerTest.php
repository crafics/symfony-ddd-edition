<?php

namespace Dschini\Blog\RestBundle\Tests\Controller;

use Bazinga\Bundle\RestExtraBundle\Test\WebTestCase;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\BrowserKit\Client;

class PostControllerTest extends WebTestCase
{
    public function setUp()
    {
        $cacheDir = $this->getClient()->getContainer()->getParameter('kernel.cache_dir');
        if (file_exists($cacheDir . '/sf_note_data')) {
            unlink($cacheDir . '/sf_note_data');
        }
    }

    public function testGetPost()
    {
        $client = $this->getClient(true);

        $client->request('GET', '/posts/1.json');
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode(), $response->getContent());

        /*
        $client = $this->getClient(true);

        $client->request('GET', '/posts/1.json');
        $response = $client->getResponse();

        $this->assertEquals(404, $response->getStatusCode(), $response->getContent());
        $this->assertEquals('{"code":404,"message":"Post does not exist."}', $response->getContent());

        $this->createNote($client, 'my post for get');

        $client->request('GET', '/posts/1.json');
        $response = $client->getResponse();

        $this->assertJsonResponse($response);
        $contentWithoutSecret = preg_replace('/"secret":"[^"]*"/', '"secret":"XXX"', $response->getContent());
        $this->assertEquals('{"secret":"XXX","message":"my note for get","version":"1.1","_links":{"self":{"href":"http:\/\/localhost\/posts\/1"}}}', $contentWithoutSecret);

        $client->request('GET', '/posts/1', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $response = $client->getResponse();

        $this->assertJsonResponse($response);
        $contentWithoutSecret = preg_replace('/"secret":"[^"]*"/', '"secret":"XXX"', $response->getContent());
        $this->assertEquals('{"secret":"XXX","message":"my note for get","version":"1.1","_links":{"self":{"href":"http:\/\/localhost\/posts\/1"}}}', $contentWithoutSecret);
        */
    }

    private function getClient($authenticated = false)
    {
        $params = array();
        if ($authenticated) {
            $params = array_merge($params, array(
                'PHP_AUTH_USER' => 'restapi',
                'PHP_AUTH_PW'   => 'secretpw',
            ));
        }
        return static::createClient(array(), $params);
    }
}