<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class PersonControllerTest extends WebTestCase
{
    public function testNew()
    {
        $client = static::createClient();
        $client->request('GET', '/person');
        $response = $client->getResponse();
        if (!$response->isSuccessful()) {
            $crawler = new Crawler($response->getContent());
            $block = $crawler->filter('div.text_exception > h1');
            if ($block->count()) {
                $error = $block->text();
            }
        }
        $this->assertEquals(200, $response->getStatusCode());
    }
}