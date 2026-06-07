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
                'dateFrom' => '2026-06-11',
                'dateTo' => '2026-06-14',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '2',
                'dateFrom' => '2026-06-15',
                'dateTo' => '2026-06-17',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '3',
                'dateFrom' => '2026-06-18',
                'dateTo' => '2026-06-20',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '4',
                'dateFrom' => '2026-06-21',
                'dateTo' => '2026-06-23',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '5',
                'dateFrom' => '2026-06-24',
                'dateTo' => '2026-06-25',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '6',
                'dateFrom' => '2026-06-26',
                'dateTo' => '2026-06-27',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '7',
                'dateFrom' => '2026-06-28',
                'dateTo' => '2026-06-30',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '8',
                'dateFrom' => '2026-07-01',
                'dateTo' => '2026-07-03',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '9',
                'dateFrom' => '2026-07-04',
                'dateTo' => '2026-07-07',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '10',
                'dateFrom' => '2026-07-08',
                'dateTo' => '2026-07-11',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '11',
                'dateFrom' => '2026-07-12',
                'dateTo' => '2026-07-15',
                'season_name' => 'Lato 2026'
            ),
            array(
                'matchday_name' => '12',
                'dateFrom' => '2026-07-16',
                'dateTo' => '2026-07-19',
                'season_name' => 'Lato 2026'
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
