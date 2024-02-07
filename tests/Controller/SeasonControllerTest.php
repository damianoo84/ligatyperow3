<?php

namespace App\Test\Controller;

use App\Entity\Season;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SeasonControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/season/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Season::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Season index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'season[name]' => 'Testing',
            'season[dateStart]' => 'Testing',
            'season[dateEnd]' => 'Testing',
            'season[isActive]' => 'Testing',
            'season[created]' => 'Testing',
            'season[updated]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Season();
        $fixture->setName('My Title');
        $fixture->setDateStart('My Title');
        $fixture->setDateEnd('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setCreated('My Title');
        $fixture->setUpdated('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Season');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Season();
        $fixture->setName('Value');
        $fixture->setDateStart('Value');
        $fixture->setDateEnd('Value');
        $fixture->setIsActive('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'season[name]' => 'Something New',
            'season[dateStart]' => 'Something New',
            'season[dateEnd]' => 'Something New',
            'season[isActive]' => 'Something New',
            'season[created]' => 'Something New',
            'season[updated]' => 'Something New',
        ]);

        self::assertResponseRedirects('/season/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDateStart());
        self::assertSame('Something New', $fixture[0]->getDateEnd());
        self::assertSame('Something New', $fixture[0]->getIsActive());
        self::assertSame('Something New', $fixture[0]->getCreated());
        self::assertSame('Something New', $fixture[0]->getUpdated());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Season();
        $fixture->setName('Value');
        $fixture->setDateStart('Value');
        $fixture->setDateEnd('Value');
        $fixture->setIsActive('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/season/');
        self::assertSame(0, $this->repository->count([]));
    }
}
