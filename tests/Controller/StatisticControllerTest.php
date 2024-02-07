<?php

namespace App\Test\Controller;

use App\Entity\Statistic;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatisticControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/statistic/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Statistic::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Statistic index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'statistic[match2]' => 'Testing',
            'statistic[match4]' => 'Testing',
            'statistic[totalPoints]' => 'Testing',
            'statistic[position]' => 'Testing',
            'statistic[numOfQue]' => 'Testing',
            'statistic[created]' => 'Testing',
            'statistic[updated]' => 'Testing',
            'statistic[user]' => 'Testing',
            'statistic[season]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Statistic();
        $fixture->setMatch2('My Title');
        $fixture->setMatch4('My Title');
        $fixture->setTotalPoints('My Title');
        $fixture->setPosition('My Title');
        $fixture->setNumOfQue('My Title');
        $fixture->setCreated('My Title');
        $fixture->setUpdated('My Title');
        $fixture->setUser('My Title');
        $fixture->setSeason('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Statistic');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Statistic();
        $fixture->setMatch2('Value');
        $fixture->setMatch4('Value');
        $fixture->setTotalPoints('Value');
        $fixture->setPosition('Value');
        $fixture->setNumOfQue('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setUser('Value');
        $fixture->setSeason('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'statistic[match2]' => 'Something New',
            'statistic[match4]' => 'Something New',
            'statistic[totalPoints]' => 'Something New',
            'statistic[position]' => 'Something New',
            'statistic[numOfQue]' => 'Something New',
            'statistic[created]' => 'Something New',
            'statistic[updated]' => 'Something New',
            'statistic[user]' => 'Something New',
            'statistic[season]' => 'Something New',
        ]);

        self::assertResponseRedirects('/statistic/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getMatch2());
        self::assertSame('Something New', $fixture[0]->getMatch4());
        self::assertSame('Something New', $fixture[0]->getTotalPoints());
        self::assertSame('Something New', $fixture[0]->getPosition());
        self::assertSame('Something New', $fixture[0]->getNumOfQue());
        self::assertSame('Something New', $fixture[0]->getCreated());
        self::assertSame('Something New', $fixture[0]->getUpdated());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getSeason());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Statistic();
        $fixture->setMatch2('Value');
        $fixture->setMatch4('Value');
        $fixture->setTotalPoints('Value');
        $fixture->setPosition('Value');
        $fixture->setNumOfQue('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setUser('Value');
        $fixture->setSeason('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/statistic/');
        self::assertSame(0, $this->repository->count([]));
    }
}
