[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/GeoRanker/functions?utm_source=RapidAPIGitHub_GeoRankerFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)
# GeoRanker Package
Get real-time search engine optimization data by location.
* Domain: [GeoRanker](https://georanker.com)
* Credentials: apiKey

## How to get credentials: 
1. Get apiKey from [GeoRanker](https://www.georanker.com/settings) 


## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```

## How to get session
1. Session and session expires date will be in response to your GeoRanker.login request with your apiKey and email. 

## GeoRanker.login
Create a new session key for the user. (Execute this first)

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| User apiKey obtained from georanker.com
| email | String| User email adress

## GeoRanker.getMe
Read the user information

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method

## GeoRanker.getMySettings
Read the user settings

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method

## GeoRanker.updateMySettings
Update the user settings

| Field               | Type   | Description
|---------------------|--------|----------
| email               | String | User email
| session             | String | User session obtained from login method
| countryCode         | String | Country code (example: DE = Germany)
| isMergeNotifications| Boolean| Send or not all email notifications merged in your specified time.
| isSendNews          | Boolean| Inform or not about new features/updates
| notificationsTime   | String | Notification time
| timezone            | String | Set your timezone (notificationTime based on this parametr)
| wlHeading           | String | Title (This field using on the Whitelabel settings for PDF reports generated on GeoRanker GUI) 
| wlSubheading        | String | Subtitle (This field using on the Whitelabel settings for PDF reports generated on GeoRanker GUI)
| wlUserLogo          | String | Logo url (This field using on the Whitelabel settings for PDF reports generated on GeoRanker GUI)

## GeoRanker.getApiChangelog
Read the API ChageLog

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method

## GeoRanker.getGeoRankerBlogNews
Read the News from GeoRanker Blog

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method

## GeoRanker.getCountryDataByCode
Read the complete data of a country by code

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| code   | String| Country code USA=us, Germany=de

## GeoRanker.getCountries
Read the full list of countries with countrycode, country name, languages, top cities, continent.

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method

## GeoRanker.getLanguageDataByCode
Read the complete data of a language by code

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| languageCode| String| Language code (example en=English)

## GeoRanker.getLanguages
Read the full list of languages

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method

## GeoRanker.getReports
Read the list of Reports

| Field       | Type  | Description
|-------------|-------|----------
| email       | String| User email
| session     | String| User session obtained from login method
| pageNum     | Number| The page number. Default: 1
| itemsPerPage| Number| The max number of reports that each page will contain. Default: 30

## GeoRanker.getSingleReport
Read the complete data of a report

| Field   | Type  | Description
|---------|-------|----------
| email   | String| User email
| session | String| User session obtained from login method
| reportId| String| The report id or token. Example: '150' or '123se2'

## GeoRanker.createReport
Creates a new report

| Field                 | Type   | Description
|-----------------------|--------|----------
| email                 | String | User email
| session               | String | User session obtained from login method
| searchEngines         | List   | List of Search Engines (google, googlelocal, yahoo, bing, yandex, youtube, naverwebdocs, naverlocal, baidu,googlenews, googleimages). Default: google
| callback              | String | Link to callback
| countries             | List   | List of Country codes. Use this param or Region 
| ignoreTypes           | List   | This is an array with 2 letter strings that allow you to make crawler completely ignore a search result type. The options are 'OR' (organic), 'GM' (google maps)
| isFillCities          | Boolean| If your report has fewer cities than the maxcities, crawler will automatically fill the report cities with the biggest cities from the country.
| isForMobile           | Boolean| Is this report for mobile platform
| isGlobal              | Boolean| True if the report is a country-level report.
| monitorId             | Number | Monitor Id
| isUseAlternativeTld   | Boolean| If true, it will always use the TLD.com instead of using the local TLDs for each country.
| keywords              | List   | List of keywords. You must specify at least one keyword. The keyword must contain at least 3 characters.
| language              | String | Language code
| maxCities             | Number | Max City count
| regions               | List   | List of cities. Use this param or countries 
| totalResults          | Number | The maximum amount of results we will crawl. Usually, you want to keep this at 100. 
| type                  | Select | ranktracker, heatmap, 1stpage, advertisers, authors, citations, sitereport and keywordrankings
| url                   | String | Url. Required with ranktracker type.

## GeoRanker.deleteSingleReport
Delete the report

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| report | String| Report id or token. Exmaple '150' or '123ads4'

## GeoRanker.getChartingData
Read the data for charting

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| report | String| Report id or token. Exmaple '150' or '123ads4'

## GeoRanker.getReportRankTrackerData
Read the Rank Tracker data from a Report

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| report | String| Report id or token. Exmaple '150' or '123ads4'

## GeoRanker.getReportFirstPageData
Read the First Page data from a Report

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| report | String| Report id or token. Exmaple '150' or '123ads4'

## GeoRanker.getReportAdvertisersData
Read the Advertisers data from a Report

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| report | String| Report id or token. Exmaple '150' or '123ads4'

## GeoRanker.getReportHeatmapData
Read the Heatmap data from a Report

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| report | String| Report id or token. Exmaple '150' or '123ads4'

## GeoRanker.getReportAuthorsData
Read the Authors data from a Report

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| report | String| Report id or token. Exmaple '150' or '123ads4'

## GeoRanker.getReportCitationsData
Read the Citations data from a Report

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| report | String| Report id or token. Exmaple '150' or '123ads4'

## GeoRanker.getReportKeywordRankingsData
Read the KeywordRankings data from a Report

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| report | String| Report id or token. Exmaple '150' or '123ads4'

## GeoRanker.getMonitors
Read the list of monitors

| Field       | Type  | Description
|-------------|-------|----------
| email       | String| User email
| session     | String| User session obtained from login method
| pageNum     | Number| The page number. Default: 1
| itemsPerPage| Number| The max number of monitors that each page will contain. Default: 30

## GeoRanker.createMonitorLinkedToReport
Creates a monitor linked to a report already created

| Field      | Type   | Description
|------------|--------|----------
| email      | String | User email
| session    | String | User session obtained from login method
| reportId   | Number | The report id. Example: '105'
| monitorType| Select | Type of Monitor: ranktracker, heatmap, firstpage, advertisers, authors, citations, keywordrankings
| isSendEmail| Boolean| Email alerts on significant changes
| periodicity| Select | d - Daily, w - Weekly, f - Fortnightly, m - Monthly

## GeoRanker.getSingleMonitorData
Read the full list of languages

| Field    | Type  | Description
|----------|-------|----------
| email    | String| User email
| session  | String| User session obtained from login method
| monitorId| Number| The monitor id. Example: '105'

## GeoRanker.updateSingleMonitorNotification
Enable or disable notification for current monitorId

| Field       | Type   | Description
|-------------|--------|----------
| email       | String | User email
| session     | String | User session obtained from login method
| monitorId   | Number | The monitor id. Example: '105'
| notification| Boolean| Enable/disable monitor notification

## GeoRanker.updateSingleMonitorPeriodicity
Update the monitor periodicity

| Field      | Type  | Description
|------------|-------|----------
| email      | String| User email
| session    | String| User session obtained from login method
| monitorId  | Number| The monitor id. Example: '105'
| periodicity| Select| d - Daily, w - Weekly, f - Fortnightly, m - Monthly

## GeoRanker.updateSingleMonitorStatus
Update the monitor status

| Field        | Type   | Description
|--------------|--------|----------
| email        | String | User email
| session      | String | User session obtained from login method
| monitorId    | Number | The monitor id. Example: '105'
| monitorStatus| Boolean| Activate or deactivate monitor

## GeoRanker.deleteSingleMonitor
Delete the monitor

| Field    | Type  | Description
|----------|-------|----------
| email    | String| User email
| session  | String| User session obtained from login method
| monitorId| Number| The monitor id. Example: '105'

## API below is only for Partner
## GeoRanker.getSingleUser
Read the basic information about the user

| Field  | Type  | Description
|--------|-------|----------
| email  | String| User email
| session| String| User session obtained from login method
| userId | Number| The user id. Example: '1034'

## GeoRanker.getPartnerUsers
Read the list of users linked to the partner

| Field       | Type  | Description
|-------------|-------|----------
| email       | String| The PARTNER email
| session     | String| The session token of the logged-in PARTNER, obtained by calling the login command
| pageNum     | Number| The page number. Default: 1
| itemsPerPage| Number| The max number of reports that each page will contain. Default: 30

## GeoRanker.createPartnerUser
Creates a user linked to the partner

| Field       | Type  | Description
|-------------|-------|----------
| email       | String| The PARTNER email
| session     | String| The session token of the logged-in PARTNER, obtained by calling the login command
| newUserEmail| String| Email of new User
| newUserName | String| Name of new User
| newUserPlan | String| Plan

## GeoRanker.updateUserPlan
Upgrade the user plan removing the old plan and the old credits

| Field   | Type  | Description
|---------|-------|----------
| email   | String| The PARTNER email
| session | String| The session token of the logged-in PARTNER, obtained by calling the login command
| userId  | Number| Email of new User
| userPlan| String| Name of new User

