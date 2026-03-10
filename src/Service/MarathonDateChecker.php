<?php

namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class MarathonDateChecker
{
//    private string $url = 'https://www.athensauthenticmarathon.gr/en/';
    private string $url = 'https://www.livescore.com/en/football/europe/champions-league/newcastle-united-vs-barcelona/1746687/';
    private string $cacheFile;

    public function __construct(
        private HttpClientInterface $httpClient,
        private LoggerInterface $logger
    ) {
        $this->cacheFile = __DIR__ . '/../../var/marathon_date.txt';
    }

    public function check(): ?string
    {
        try {
            $response = $this->httpClient->request('GET', $this->url);
            $html = $response->getContent();

            $crawler = new Crawler($html);

//            $node = $crawler->filter('.hero_subtitle');
            $node = $crawler->filter('span[data-id="mt-tm-sc-tm"]');

            if ($node->count() === 0) {
                return 'ELEMENT_NOT_FOUND';
            }

            $dateText = trim($node->text());

            $lastDate = file_exists($this->cacheFile)
                ? trim(file_get_contents($this->cacheFile))
                : null;

            if ($lastDate !== $dateText) {
                file_put_contents($this->cacheFile, $dateText);
                return $dateText;
            }

            return null;

        } catch (\Exception $e) {
            return 'ERROR';
        }
    }
}