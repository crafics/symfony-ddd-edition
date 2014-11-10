<?php

namespace Acme\Demo\RestBundle\Tests\Controller;

use Bazinga\Bundle\RestExtraBundle\Test\WebTestCase;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\BrowserKit\Client;

class NoteControllerTest extends WebTestCase
{
    public function setUp()
    {
        $cacheDir = $this->getClient()->getContainer()->getParameter('kernel.cache_dir');
        if (file_exists($cacheDir . '/sf_note_data')) {
            unlink($cacheDir . '/sf_note_data');
        }
    }

    public function testGetNote()
    {
        $client = $this->getClient();
        $client->request('GET', '/notes/1.json');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode(), $response->getContent());

        $client = $this->getClient(false);
        $client->request('GET', '/notes/99999.json');
        $response = $client->getResponse();
        $this->assertEquals(404, $response->getStatusCode(), $response->getContent());
        $this->assertEquals('{"code":404,"message":"note does not exist."}', $response->getContent());

        /*
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

    public function testPostNote()
    {
        $client = $this->getClient(false);
        $this->createNote($client, 'yes');
        $response = $client->getResponse();
        $this->assertJsonResponse($response, Codes::HTTP_CREATED);
        /*
        $this->assertEquals($response->headers->get('location'), 'http://localhost/notes/1');
        */
    }

    protected function createNote(Client $client, $message)
    {
        $client->request('POST', '/notes.json', array(
            'note' => array(
                'message' => $message
            )
        ));
        $response = $client->getResponse();
        $this->assertJsonResponse($response, Codes::HTTP_CREATED);
    }

    private function getClient($authenticated = false)
    {
        $params = array(
            'apikey' => 'abcdefg'
        );
        if ($authenticated) {
            $params = array_merge($params, array(
                'PHP_AUTH_USER' => 'user',
                'PHP_AUTH_PW'   => 'pass',
            ));
        }
        return static::createClient(array(), $params);
    }
}