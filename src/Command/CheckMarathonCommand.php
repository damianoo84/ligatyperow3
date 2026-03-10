<?php

namespace App\Command;

use App\Service\MarathonDateChecker;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckMarathonCommand extends Command
{
    protected static $defaultName = 'app:check-marathon';

    public function __construct(
        private MarathonDateChecker $checker,
        private LoggerInterface $logger
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Sprawdza datę maratonu w Atenach i wysyła SMS jeśli się zmieniła.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $status = $this->checker->check();

        if ($status !== null) {
            // wysyłanie SMS
            ini_set("soap.wsdl_cache_enabled", "0");
            $client = new \SoapClient("http://api.gsmservice.pl/soap/v2/gateway.php?wsdl");

            $arAccount = [
                "login" => "damcio",
                "pass" => "gutek246"
            ];

            $message = match ($status) {
                'ELEMENT_NOT_FOUND' => "Uwaga! Element z datą maratonu zniknął ze strony!",
                'ERROR' => "Błąd podczas sprawdzania strony maratonu!",
                default => "Nowa data maratonu w Atenach: " . $status
            };

            $arMessages = [[
                "recipients" => ["48XXXXXXXXX"], // Twój numer
                "message" => $message,
                "sender" => "Damian",
                "msgType" => 1,
                "unicode" => false,
                "sandbox" => false
            ]];

            $client->SendSMS([
                "account" => $arAccount,
                "messages" => $arMessages
            ])->return;

            $this->logger->info('Wysłano SMS o zmianie daty maratonu.');
        }

        return Command::SUCCESS;
    }
}