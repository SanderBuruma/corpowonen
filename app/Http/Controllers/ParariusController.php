<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Woningen;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class ParariusController extends Controller
{
    static public function ScrapeAll()
    {
        $links = self::Scrape("amsterdam");
    }

    static public function Scrape($stad)
    {

        #getting the page count
        error_log("initiating Pararius -> " . $stad . " scraping");
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
        ));
        $goutteClient->setClient($guzzleClient);
        $crawler = $goutteClient->request('GET', "https://www.pararius.nl/koopwoningen/" . $stad);

        $resultsCount = ($crawler->filter('.search-list-header__count')->each(function ($node) {
            $temp = (int) preg_replace(@"/\D/", "", $node->text());
            error_log($temp . " advertenties found.");
            $titles[] = ($temp);
            return $temp;
        }));
        $pages = (int) ($resultsCount[0] / 30 + 1);
        error_log($pages);

        # scraping all the links of the advertenties
        $advertentieLinks = array();
        for ($i = 1; $i <= $pages; $i++) {
            global $advertentieLinks;
            $currentPage = "https://www.pararius.nl/koopwoningen/" . $stad . "/page-" . $i;
            $crawler = $goutteClient->request('GET', $currentPage);

            $pageLinks = ($crawler->filter('.listing-search-item__link.listing-search-item__link--title')->each(function ($node) {
                $temp = $node->attr("href");
                return $temp;
            }));
            foreach ($pageLinks as $link)
                $advertentieLinks[] = $link;
            error_log(count($advertentieLinks));
        }

        # compare the links to the advertenties in the database and remove any pre existing ones
        # imagine some code here, it's not been typed out yet.

        # scrape new advertenties and insert them into the database
        Self::ScrapeAdvertenties($advertentieLinks);
    }

    /**
     * Scrape a list of new adds to be added to the database
     *
     * @param Array[Strings] advertentieLinks
     *
     * @return \Illuminate\Http\Response
     */
    static public function ScrapeAdvertenties($advertentieLinks)
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
        ));
        $goutteClient->setClient($guzzleClient);
        foreach ($advertentieLinks as $key => $value) {
            $currentPage = "https://www.pararius.nl" . $value;
            $crawler = $goutteClient->request('GET', $currentPage);

            $woning = new Woningen();
            $woning->titel = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->straat = preg_replace("/ \d+/", "", $crawler->filter('.listing-detail-summary__title')->text());
            $woning->huisnummer = preg_match(@"/\d+$/", $crawler->filter('.listing-detail-summary__title')->text(), $match)[0];
            $woning->postcode = preg_match("/\d{4} \w\w/gm", $crawler->filter('.listing-detail-summary__title')->text(), $match)[0];
            error_log($woning->postcode);
            $woning->woonplaats = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->bijvoegsel = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->huurwoning  = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->prijs = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->soortwoning = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->hoofdfoto = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->oppervlakte = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->kamers = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->slaapkamers = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->parkeerplaats = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->beschikbaarper = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->gestoffeerd = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->linkorigineleadvertentie = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->linkwebsite = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->bronnenid = $crawler->filter('.listing-detail-summary__title')->text();
            $woning->actief = $crawler->filter('.listing-detail-summary__title')->text();
            error_log($woning->titel);
        }
    }
}
