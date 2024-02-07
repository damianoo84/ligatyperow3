<?php

namespace App\Test\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/user/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(User::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'user[username]' => 'Testing',
            'user[roles]' => 'Testing',
            'user[password]' => 'Testing',
            'user[phone]' => 'Testing',
            'user[numberOfWins]' => 'Testing',
            'user[status]' => 'Testing',
            'user[priority]' => 'Testing',
            'user[lastActivityAt]' => 'Testing',
            'user[rankingPosition]' => 'Testing',
            'user[maxPointsPerQueue]' => 'Testing',
            'user[minPointsPerQueue]' => 'Testing',
            'user[nick]' => 'Testing',
            'user[favoritePolandTeam]' => 'Testing',
            'user[favoriteForeignTeam]' => 'Testing',
            'user[numberOfFirstPlaces]' => 'Testing',
            'user[numberOfSecondPlaces]' => 'Testing',
            'user[numberOfThirdPlaces]' => 'Testing',
            'user[lastWinner]' => 'Testing',
            'user[liderOfRanking]' => 'Testing',
            'user[created]' => 'Testing',
            'user[updated]' => 'Testing',
            'user[shortname]' => 'Testing',
            'user[email]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setUsername('My Title');
        $fixture->setRoles('My Title');
        $fixture->setPassword('My Title');
        $fixture->setPhone('My Title');
        $fixture->setNumberOfWins('My Title');
        $fixture->setStatus('My Title');
        $fixture->setPriority('My Title');
        $fixture->setLastActivityAt('My Title');
        $fixture->setRankingPosition('My Title');
        $fixture->setMaxPointsPerQueue('My Title');
        $fixture->setMinPointsPerQueue('My Title');
        $fixture->setNick('My Title');
        $fixture->setFavoritePolandTeam('My Title');
        $fixture->setFavoriteForeignTeam('My Title');
        $fixture->setNumberOfFirstPlaces('My Title');
        $fixture->setNumberOfSecondPlaces('My Title');
        $fixture->setNumberOfThirdPlaces('My Title');
        $fixture->setLastWinner('My Title');
        $fixture->setLiderOfRanking('My Title');
        $fixture->setCreated('My Title');
        $fixture->setUpdated('My Title');
        $fixture->setShortname('My Title');
        $fixture->setEmail('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('User');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setUsername('Value');
        $fixture->setRoles('Value');
        $fixture->setPassword('Value');
        $fixture->setPhone('Value');
        $fixture->setNumberOfWins('Value');
        $fixture->setStatus('Value');
        $fixture->setPriority('Value');
        $fixture->setLastActivityAt('Value');
        $fixture->setRankingPosition('Value');
        $fixture->setMaxPointsPerQueue('Value');
        $fixture->setMinPointsPerQueue('Value');
        $fixture->setNick('Value');
        $fixture->setFavoritePolandTeam('Value');
        $fixture->setFavoriteForeignTeam('Value');
        $fixture->setNumberOfFirstPlaces('Value');
        $fixture->setNumberOfSecondPlaces('Value');
        $fixture->setNumberOfThirdPlaces('Value');
        $fixture->setLastWinner('Value');
        $fixture->setLiderOfRanking('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setShortname('Value');
        $fixture->setEmail('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'user[username]' => 'Something New',
            'user[roles]' => 'Something New',
            'user[password]' => 'Something New',
            'user[phone]' => 'Something New',
            'user[numberOfWins]' => 'Something New',
            'user[status]' => 'Something New',
            'user[priority]' => 'Something New',
            'user[lastActivityAt]' => 'Something New',
            'user[rankingPosition]' => 'Something New',
            'user[maxPointsPerQueue]' => 'Something New',
            'user[minPointsPerQueue]' => 'Something New',
            'user[nick]' => 'Something New',
            'user[favoritePolandTeam]' => 'Something New',
            'user[favoriteForeignTeam]' => 'Something New',
            'user[numberOfFirstPlaces]' => 'Something New',
            'user[numberOfSecondPlaces]' => 'Something New',
            'user[numberOfThirdPlaces]' => 'Something New',
            'user[lastWinner]' => 'Something New',
            'user[liderOfRanking]' => 'Something New',
            'user[created]' => 'Something New',
            'user[updated]' => 'Something New',
            'user[shortname]' => 'Something New',
            'user[email]' => 'Something New',
        ]);

        self::assertResponseRedirects('/user/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getUsername());
        self::assertSame('Something New', $fixture[0]->getRoles());
        self::assertSame('Something New', $fixture[0]->getPassword());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getNumberOfWins());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getPriority());
        self::assertSame('Something New', $fixture[0]->getLastActivityAt());
        self::assertSame('Something New', $fixture[0]->getRankingPosition());
        self::assertSame('Something New', $fixture[0]->getMaxPointsPerQueue());
        self::assertSame('Something New', $fixture[0]->getMinPointsPerQueue());
        self::assertSame('Something New', $fixture[0]->getNick());
        self::assertSame('Something New', $fixture[0]->getFavoritePolandTeam());
        self::assertSame('Something New', $fixture[0]->getFavoriteForeignTeam());
        self::assertSame('Something New', $fixture[0]->getNumberOfFirstPlaces());
        self::assertSame('Something New', $fixture[0]->getNumberOfSecondPlaces());
        self::assertSame('Something New', $fixture[0]->getNumberOfThirdPlaces());
        self::assertSame('Something New', $fixture[0]->getLastWinner());
        self::assertSame('Something New', $fixture[0]->getLiderOfRanking());
        self::assertSame('Something New', $fixture[0]->getCreated());
        self::assertSame('Something New', $fixture[0]->getUpdated());
        self::assertSame('Something New', $fixture[0]->getShortname());
        self::assertSame('Something New', $fixture[0]->getEmail());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new User();
        $fixture->setUsername('Value');
        $fixture->setRoles('Value');
        $fixture->setPassword('Value');
        $fixture->setPhone('Value');
        $fixture->setNumberOfWins('Value');
        $fixture->setStatus('Value');
        $fixture->setPriority('Value');
        $fixture->setLastActivityAt('Value');
        $fixture->setRankingPosition('Value');
        $fixture->setMaxPointsPerQueue('Value');
        $fixture->setMinPointsPerQueue('Value');
        $fixture->setNick('Value');
        $fixture->setFavoritePolandTeam('Value');
        $fixture->setFavoriteForeignTeam('Value');
        $fixture->setNumberOfFirstPlaces('Value');
        $fixture->setNumberOfSecondPlaces('Value');
        $fixture->setNumberOfThirdPlaces('Value');
        $fixture->setLastWinner('Value');
        $fixture->setLiderOfRanking('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setShortname('Value');
        $fixture->setEmail('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/user/');
        self::assertSame(0, $this->repository->count([]));
    }
}
