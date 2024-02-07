<?php

namespace App\Test\Controller;

use App\Entity\Matchday;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MatchdayControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/matchday/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Matchday::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Matchday index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'matchday[name]' => 'Testing',
            'matchday[dateFrom]' => 'Testing',
            'matchday[dateTo]' => 'Testing',
            'matchday[created]' => 'Testing',
            'matchday[updated]' => 'Testing',
            'matchday[season]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Matchday();
        $fixture->setName('My Title');
        $fixture->setDateFrom('My Title');
        $fixture->setDateTo('My Title');
        $fixture->setCreated('My Title');
        $fixture->setUpdated('My Title');
        $fixture->setSeason('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Matchday');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Matchday();
        $fixture->setName('Value');
        $fixture->setDateFrom('Value');
        $fixture->setDateTo('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setSeason('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'matchday[name]' => 'Something New',
            'matchday[dateFrom]' => 'Something New',
            'matchday[dateTo]' => 'Something New',
            'matchday[created]' => 'Something New',
            'matchday[updated]' => 'Something New',
            'matchday[season]' => 'Something New',
        ]);

        self::assertResponseRedirects('/matchday/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDateFrom());
        self::assertSame('Something New', $fixture[0]->getDateTo());
        self::assertSame('Something New', $fixture[0]->getCreated());
        self::assertSame('Something New', $fixture[0]->getUpdated());
        self::assertSame('Something New', $fixture[0]->getSeason());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Matchday();
        $fixture->setName('Value');
        $fixture->setDateFrom('Value');
        $fixture->setDateTo('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setSeason('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/matchday/');
        self::assertSame(0, $this->repository->count([]));
    }
}
