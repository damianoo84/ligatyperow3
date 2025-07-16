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
                'dateFrom' => '2025-09-08',
                'dateTo' => '2025-09-14',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2025-09-15',
                'dateTo' => '2025-09-21',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2025-09-22',
                'dateTo' => '2025-09-28',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2025-09-29',
                'dateTo' => '2025-10-05',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2025-10-06',
                'dateTo' => '2025-10-12',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2025-10-13',
                'dateTo' => '2025-10-19',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2025-10-20',
                'dateTo' => '2025-10-26',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2025-10-27',
                'dateTo' => '2025-11-02',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2025-11-03',
                'dateTo' => '2025-11-09',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2025-11-10',
                'dateTo' => '2025-11-16',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2025-11-17',
                'dateTo' => '2025-11-23',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2025-11-24',
                'dateTo' => '2025-11-30',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '13',
                'dateFrom' => '2025-12-01',
                'dateTo' => '2025-12-07',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '14',
                'dateFrom' => '2025-12-08',
                'dateTo' => '2025-12-14',
                'season_name' => 'Jesień 2025'
            ),
            array(
                'matchday_name' => '15',
                'dateFrom' => '2025-12-15',
                'dateTo' => '2025-12-21',
                'season_name' => 'Jesień 2025'
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
