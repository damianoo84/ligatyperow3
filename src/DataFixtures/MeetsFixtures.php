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
                'team_name_1' => 'Stade Brest',
                'team_name_2' => 'Paris Saint-Germain',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Wtorek,11-02-2025,18:45',
                'position' => 1,
            ),
            array(
                'meet_name' => 'Mecz 2',
                'team_name_1' => 'Sporting Lizbona',
                'team_name_2' => 'Borussia Dortmund',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Wtorek,11-02-2025,21:00',
                'position' => 2,
            ),

            array(
                'meet_name' => 'Mecz 3',
                'team_name_1' => 'Juventus Turyn',
                'team_name_2' => 'PSV Eindhoven',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Wtorek,11-02-2025,21:00',
                'position' => 3,
            ),
            array(
                'meet_name' => 'Mecz 4',
                'team_name_1' => 'Manchester City',
                'team_name_2' => 'Real Madryt',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Wtorek,11-02-2025,21:00',
                'position' => 4,
            ),
            array(
                'meet_name' => 'Mecz 5',
                'team_name_1' => 'FC Brugge',
                'team_name_2' => 'Atalanta Bergamo',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Środa,12-02-2025,21:00',
                'position' => 5,
            ),
            array(
                'meet_name' => 'Mecz 6',
                'team_name_1' => 'Celtic Glasgow',
                'team_name_2' => 'Bayern Monachium',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Środa,12-02-2025,21:00',
                'position' => 6,
            ),
            array(
                'meet_name' => 'Mecz 7',
                'team_name_1' => 'AS Monaco',
                'team_name_2' => 'Benfica Lizbona',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'NŚroda,12-02-2025,21:00',
                'position' => 7,
            ),
            array(
                'meet_name' => 'Mecz 8',
                'team_name_1' => 'Feyenoord Rotterdam',
                'team_name_2' => 'AC Milan',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Mistrzów',
                'term' => 'Środa,12-02-2025,21:00',
                'position' => 8,
            ),
            array(
                'meet_name' => 'Mecz 9',
                'team_name_1' => 'Bayer 04 Leverkusen',
                'team_name_2' => 'Bayern Monachium',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Niemiecka',
                'term' => 'Sobota,15-02-2025,18:30',
                'position' => 9,
            ),
            array(
                'meet_name' => 'Mecz 10',
                'team_name_1' => 'Juventus Turyn',
                'team_name_2' => 'Inter Mediolan',
                'matchday_name' => 'Kolejka 1',
                'description' => 'Liga Włoska',
                'term' => 'Niedziela,16-02-2025,15:00',
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