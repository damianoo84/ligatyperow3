<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Entity\Meet;

class MeetsFixtures extends Fixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 2;
    }

    public function load(ObjectManager $manager) {

        $meetsList = array(
            array(
                'meet_name' => 'Mecz 1',
                'team_name_1' => 'Manchester City',
                'team_name_2' => 'Manchester United',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 1,
            ),
            array(
                'meet_name' => 'Mecz 2',
                'team_name_1' => 'Arsenal Londyn',
                'team_name_2' => 'Nottingham Forest',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 2,
            ),

            array(
                'meet_name' => 'Mecz 3',
                'team_name_1' => 'West Ham United',
                'team_name_2' => 'Tottenham Londyn',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Angielska',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 3,
            ),
            array(
                'meet_name' => 'Mecz 4',
                'team_name_1' => 'Atletico Madryt',
                'team_name_2' => 'Villareal CF',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 4,
            ),
            array(
                'meet_name' => 'Mecz 5',
                'team_name_1' => 'FC Barcelona',
                'team_name_2' => 'Valencia CF',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 5,
            ),
            array(
                'meet_name' => 'Mecz 6',
                'team_name_1' => 'Real Sociedad',
                'team_name_2' => 'Real Madryt',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Hiszpańska',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 6,
            ),
            array(
                'meet_name' => 'Mecz 7',
                'team_name_1' => 'Juventus Turyn',
                'team_name_2' => 'Inter Mediolan',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 7,
            ),
            array(
                'meet_name' => 'Mecz 8',
                'team_name_1' => 'Fiorentina',
                'team_name_2' => 'SSC Napoli',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 8,
            ),
            array(
                'meet_name' => 'Mecz 9',
                'team_name_1' => 'AC Milan',
                'team_name_2' => 'Bologna FC',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 9,
            ),
            array(
                'meet_name' => 'Mecz 10',
                'team_name_1' => 'Bayer 04 Leverkusen',
                'team_name_2' => 'Eintracht Frankfurt',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Niemiecka',
                'term' => 'Sobota,13-09-2025,18:00',
                'position' => 10,
            ),
        );
        
        $counter = 1;
        $matchdays = 15;
        
//        for($i=1;$i<=$matchdays;$i++){
            foreach ($meetsList as $meetsDetails) {

                $meet = new Meet();
                $meet->setPosition($meetsDetails['position']);
                $meet->setTerm($meetsDetails['term']);
                $meet->setMatchday($this->getReference('matchday-'.$meetsDetails['matchday_name']));
                $meet->setHostTeam($this->getReference('team-'.$meetsDetails['team_name_1']));
                $meet->setGuestTeam($this->getReference('team-'.$meetsDetails['team_name_2']));
                $meet->setName('Mecz '.$counter);
                $meet->setLeague($this->getReference('League-'.$meetsDetails['description']));

                $this->addReference('meet-Mecz '.$counter, $meet);
//                var_dump($counter);
                $manager->persist($meet);
                $counter++;
            }
//        }

            $manager->flush();
        
    }
    
}