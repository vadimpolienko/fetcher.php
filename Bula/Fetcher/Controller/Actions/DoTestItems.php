<?php
/**
 * Buddy Fetcher: simple RSS-fetcher/aggregator.
 *
 * @author Buddy Lancer <http://www.buddylancer.com>
 * @copyright 2020 Buddy Lancer
 * @version 0.1
 * @license MIT
 */
namespace Bula\Fetcher\Controller\Actions;

use Bula\Objects\Response;
use Bula\Objects\DateTimes;
use Bula\Objects\Hashtable;
use Bula\Model\DataSet;
use Bula\Fetcher\Config;
use Bula\Fetcher\Model\DOTime;
use Bula\Fetcher\Controller\Page;
use Bula\Fetcher\Controller\BOFetcher;

require_once("Bula/Fetcher/Model/DOTime.php");
require_once("Bula/Fetcher/Controller/BOFetcher.php");

/**
 * Testing sources for necessary fetching.
 */
class DoTestItems extends Page
{
    private static $TOP = null;
    private static $BOTTOM = null;

    /** Initialize TOP and BOTTOM blocks. */
    private static function initialize()
    {
        self::$TOP = CAT(
            "<!DOCTYPE html>\r\n",
            "<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n",
            "    <head>\r\n",
            "        <title>Buddy Fetcher -- Test for new items</title>\r\n",
            "        <meta name=\"keywords\" content=\"Buddy Fetcher, rss, fetcher, aggregator, PHP, MySQL\" />\r\n",
            "        <meta name=\"description\" content=\"Buddy Fetcher is a simple RSS Fetcher/aggregator written in PHP/MySQL\" />\r\n",
            "        <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />\r\n",
            "    </head>\r\n",
            "    <body>\r\n"
        );
        self::$BOTTOM = CAT(
            "    </body>\r\n",
            "</html>\r\n"
        );
    }

    /** Execute main logic for DoTestItems action */
    public function execute()
    {
        $insertRequired = false;
        $updateRequired = false;

        $doTime = new DOTime();

        $dsTimes = $doTime->getById(1);
        $timeShift = 240; // 4 min
        $currentTime = DateTimes::getTime();
        if ($dsTimes->getSize() > 0) {
            $oTime = $dsTimes->getRow(0);
            if ($currentTime > DateTimes::getTime($oTime->get("d_Time")) + $timeShift)
                $updateRequired = true;
        }
        else
            $insertRequired = true;

        Response::write(self::$TOP);
        if ($updateRequired || $insertRequired) {
            Response::write("Fetching new items... Please wait...<br/>\r\n");

            $boFetcher = new BOFetcher($this->context);
            $boFetcher->fetchFromSources();

            $doTime = new DOTime(); // Need for DB reopen
            $fields = new Hashtable();
            $fields->put("d_Time", DateTimes::format(Config::SQL_DTS, DateTimes::getTime()));
            if ($insertRequired) {
                $fields->put("i_Id", 1);
                $doTime->insert($fields);
            }
            else
                $doTime->updateById(1, $fields);
        }
        else
            Response::write("<hr/>Fetch is not required<br/>\r\n");
        Response::write(self::$BOTTOM);
    }
}
