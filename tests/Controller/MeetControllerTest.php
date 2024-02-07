<?php

namespace App\Test\Controller;

use App\Entity\Meet;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MeetControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/meet/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Meet::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Meet index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'meet[name]' => 'Testing',
            'meet[hostGoals]' => 'Testing',
            'meet[guestGoals]' => 'Testing',
            'meet[term]' => 'Testing',
            'meet[position]' => 'Testing',
            'meet[created]' => 'Testing',
            'meet[updated]' => 'Testing',
            'meet[league]' => 'Testing',
            'meet[matchday]' => 'Testing',
            'meet[hostTeam]' => 'Testing',
            'meet[guestTeam]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Meet();
        $fixture->setName('My Title');
        $fixture->setHostGoals('My Title');
        $fixture->setGuestGoals('My Title');
        $fixture->setTerm('My Title');
        $fixture->setPosition('My Title');
        $fixture->setCreated('My Title');
        $fixture->setUpdated('My Title');
        $fixture->setLeague('My Title');
        $fixture->setMatchday('My Title');
        $fixture->setHostTeam('My Title');
        $fixture->setGuestTeam('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Meet');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Meet();
        $fixture->setName('Value');
        $fixture->setHostGoals('Value');
        $fixture->setGuestGoals('Value');
        $fixture->setTerm('Value');
        $fixture->setPosition('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setLeague('Value');
        $fixture->setMatchday('Value');
        $fixture->setHostTeam('Value');
        $fixture->setGuestTeam('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'meet[name]' => 'Something New',
            'meet[hostGoals]' => 'Something New',
            'meet[guestGoals]' => 'Something New',
            'meet[term]' => 'Something New',
            'meet[position]' => 'Something New',
            'meet[created]' => 'Something New',
            'meet[updated]' => 'Something New',
            'meet[league]' => 'Something New',
            'meet[matchday]' => 'Something New',
            'meet[hostTeam]' => 'Something New',
            'meet[guestTeam]' => 'Something New',
        ]);

        self::assertResponseRedirects('/meet/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getHostGoals());
        self::assertSame('Something New', $fixture[0]->getGuestGoals());
        self::assertSame('Something New', $fixture[0]->getTerm());
        self::assertSame('Something New', $fixture[0]->getPosition());
        self::assertSame('Something New', $fixture[0]->getCreated());
        self::assertSame('Something New', $fixture[0]->getUpdated());
        self::assertSame('Something New', $fixture[0]->getLeague());
        self::assertSame('Something New', $fixture[0]->getMatchday());
        self::assertSame('Something New', $fixture[0]->getHostTeam());
        self::assertSame('Something New', $fixture[0]->getGuestTeam());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Meet();
        $fixture->setName('Value');
        $fixture->setHostGoals('Value');
        $fixture->setGuestGoals('Value');
        $fixture->setTerm('Value');
        $fixture->setPosition('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setLeague('Value');
        $fixture->setMatchday('Value');
        $fixture->setHostTeam('Value');
        $fixture->setGuestTeam('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/meet/');
        self::assertSame(0, $this->repository->count([]));
    }
}
