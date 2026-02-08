<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Matchday;
use App\Entity\Type;

class CronCommand extends Command {
  
    private $logger;
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    protected function configure() : void
    {
        $this->setName('app:przypominajka')
            ->setDescription('Przypomnienie o typowaniu');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        try {
            $matchdayObject = $this->entityManager->getRepository(Matchday::class)->getMatchday();
            
            // pobranie listy numerów tel. użytkowników, którzy jeszcze nie wytypowali 
            $usersPhones = $this->entityManager->getRepository(Type::class)->getNoTypedUsersList($matchdayObject['id']);
            $this->logger->info('numbersOfPhones: ' . json_encode($usersPhones));
            
            ini_set("soap.wsdl_cache_enabled", "0");
            $client = new \SoapClient("http://api.gsmservice.pl/soap/v2/gateway.php?wsdl");
            $arAccount = array("login" => "damcio","pass" => "gutek246");
            $arMessages = array(array(
                "recipients" => $usersPhones,
                "message" => "Przypomnienie o typowaniu",
                "sender"=> "Damian",
                "msgType" => 1,
                "unicode" => false,
                "sandbox" => false
            ));
            
            // wysłanie smsów o ustalonym w CRON terminie
            $client->SendSMS(array("account" => $arAccount,"messages"=> $arMessages))->return;

            $this->logger->info('@Messages has been send');

            return Command::SUCCESS; // Zwróć sukces
        } catch (\Exception $e) {
            $this->logger->error('Error occurred: ' . $e->getMessage());
            return Command::FAILURE; // Zwróć błąd w przypadku wyjątku
        }
    }    
}