<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Matchday;

class MatchdaysFixtures extends Fixture implements OrderedFixtureInterface{
    
    public function getOrder() {
        return 1;
    }

    public function load(ObjectManager $manager) {

        $matchdaysList = array(
           array(
                'matchday_name' => '1',
                'dateFrom' => '2026-02-09',
                'dateTo' => '2026-02-15',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2026-02-16',
                'dateTo' => '2026-02-22',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2026-02-23',
                'dateTo' => '2026-03-01',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2026-03-02',
                'dateTo' => '2026-03-08',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2026-03-09',
                'dateTo' => '2026-03-15',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2026-03-16',
                'dateTo' => '2026-03-22',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2026-03-23',
                'dateTo' => '2026-03-29',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2026-03-30',
                'dateTo' => '2026-04-05',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2026-04-06',
                'dateTo' => '2026-04-12',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2026-04-13',
                'dateTo' => '2026-04-19',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2026-04-20',
                'dateTo' => '2026-04-26',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2026-04-27',
                'dateTo' => '2026-05-03',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2026-05-04',
                'dateTo' => '2026-05-10',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2026-05-11',
                'dateTo' => '2026-05-17',
                'season_name' => 'Wiosna 2026'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2026-05-18',
                'dateTo' => '2026-05-24',
                'season_name' => 'Wiosna 2026'
            )
        );
        
        foreach ($matchdaysList as $matchdaysDetails) {
            $matchday = new Matchday();
            $matchday->setSeason($this->getReference('season-'.$matchdaysDetails['season_name']));
            $matchday->setName($matchdaysDetails['matchday_name']);
            $matchday->setDateFrom(new \DateTime($matchdaysDetails['dateFrom']));
            $matchday->setDateTo(new \DateTime($matchdaysDetails['dateTo']));
            $this->addReference('matchday-Kolejka '.$matchdaysDetails['matchday_name'], $matchday);
            
            $manager->persist($matchday);
        }
        
        $manager->flush();

    }
    
}
