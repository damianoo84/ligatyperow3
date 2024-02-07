<?php

namespace App\Test\Controller;

use App\Entity\History;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HistoryControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/history/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(History::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('History index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'history[numOfPoints]' => 'Testing',
            'history[created]' => 'Testing',
            'history[updated]' => 'Testing',
            'history[matchday]' => 'Testing',
            'history[statistic]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new History();
        $fixture->setNumOfPoints('My Title');
        $fixture->setCreated('My Title');
        $fixture->setUpdated('My Title');
        $fixture->setMatchday('My Title');
        $fixture->setStatistic('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('History');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new History();
        $fixture->setNumOfPoints('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setMatchday('Value');
        $fixture->setStatistic('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'history[numOfPoints]' => 'Something New',
            'history[created]' => 'Something New',
            'history[updated]' => 'Something New',
            'history[matchday]' => 'Something New',
            'history[statistic]' => 'Something New',
        ]);

        self::assertResponseRedirects('/history/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNumOfPoints());
        self::assertSame('Something New', $fixture[0]->getCreated());
        self::assertSame('Something New', $fixture[0]->getUpdated());
        self::assertSame('Something New', $fixture[0]->getMatchday());
        self::assertSame('Something New', $fixture[0]->getStatistic());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new History();
        $fixture->setNumOfPoints('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setMatchday('Value');
        $fixture->setStatistic('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/history/');
        self::assertSame(0, $this->repository->count([]));
    }
}
