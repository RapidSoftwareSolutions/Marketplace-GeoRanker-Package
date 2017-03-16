<?php
$routes = [
    'login',
    'getMe',
    'getMySettings',
    'updateMySettings',
    'getApiChangeLog',
    'getGeoRankerBlogNews',
    'getCountryDataByCode',
    'getCountries',
    'getLanguageDataByCode',
    'getLanguages',
    'getReports',
    'getSingleReport',
    'createReport',
    'deleteSingleReport',
    'getChartingData',
    'getReportRankTrackerData',
    'getReportFirstPageData',
    'getReportAdvertisersData',
    'getReportHeatmapData',
    'getReportAuthorsData',
    'getReportCitationsData',
    'getReportKeywordRankingsData',
    'createMonitorLinkedToReport',
    'getMonitors',
    'getSingleMonitorData',
    'updateSingleMonitorNotification',
    'updateSingleMonitorPeriodicity',
    'updateSingleMonitorStatus',
    'deleteSingleMonitor',
    'getSingleUser',
    'getPartnerUsers',
    'createPartnerUser',
    'updateUserPlan',
    'metadata'
];
foreach ($routes as $file) {
    require __DIR__ . '/../src/routes/' . $file . '.php';
}

