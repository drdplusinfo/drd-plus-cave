<?php
namespace DrdPlus\Cave\TablesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TablesControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tables');

        $this->assertTrue($crawler->filter('html:contains("table")')->count() > 0);
    }
}
