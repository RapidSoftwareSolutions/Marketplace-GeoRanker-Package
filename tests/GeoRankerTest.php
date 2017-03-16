<?php
namespace Tests;

require_once(__DIR__ . '/../src/Models/checkRequest.php');

class GeoRankerTest extends BaseTestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testRoutes($url) {
        $response = $this->runApp("POST", '/api/GeoRanker/'.$url);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function dataProvider() {
        return [
            ['login'],
            ['getMe'],
            ['getMySettings'],
            ['updateMySettings'],
            ['getApiChangeLog'],
            ['getGeoRankerBlogNews'],
            ['getCountryDataByCode'],
            ['getCountries'],
            ['getLanguageDataByCode'],
            ['getLanguages'],
            ['getReports'],
            ['getSingleReport'],
            ['createReport'],
            ['deleteSingleReport'],
            ['getChartingData'],
            ['getReportRankTrackerData'],
            ['getReportFirstPageData'],
            ['getReportAdvertisersData'],
            ['getReportHeatmapData'],
            ['getReportAuthorsData'],
            ['getReportCitationsData'],
            ['getReportKeywordRankingsData'],
            ['createMonitorLinkedToReport'],
            ['getMonitors'],
            ['getSingleMonitorData'],
            ['updateSingleMonitorNotification'],
            ['updateSingleMonitorStatus'],
            ['updateSingleMonitorPeriodicity'],
            ['deleteSingleMonitor'],
            ['getSingleUser'],
            ['getPartnerUsers'],
            ['createPartnerUser'],
            ['updateUserPlan'],
        ];
    }
}