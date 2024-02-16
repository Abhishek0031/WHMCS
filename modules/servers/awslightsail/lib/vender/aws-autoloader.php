<?php



$mapping = array(

    'GuzzleHttp\MessageFormatter' => __DIR__ . '/GuzzleHttp/MessageFormatter.php',

    'GuzzleHttp\RetryMiddleware' => __DIR__ . '/GuzzleHttp/RetryMiddleware.php',

    'GuzzleHttp\Pool' => __DIR__ . '/GuzzleHttp/Pool.php',

    'GuzzleHttp\Cookie\SetCookie' => __DIR__ . '/GuzzleHttp/Cookie/SetCookie.php',

    'GuzzleHttp\Cookie\CookieJar' => __DIR__ . '/GuzzleHttp/Cookie/CookieJar.php',

    'GuzzleHttp\Cookie\FileCookieJar' => __DIR__ . '/GuzzleHttp/Cookie/FileCookieJar.php',

    'GuzzleHttp\Cookie\SessionCookieJar' => __DIR__ . '/GuzzleHttp/Cookie/SessionCookieJar.php',

    'GuzzleHttp\Cookie\CookieJarInterface' => __DIR__ . '/GuzzleHttp/Cookie/CookieJarInterface.php',

    'GuzzleHttp\ClientInterface' => __DIR__ . '/GuzzleHttp/ClientInterface.php',

    'GuzzleHttp\Handler\CurlFactory' => __DIR__ . '/GuzzleHttp/Handler/CurlFactory.php',

    'GuzzleHttp\Handler\CurlMultiHandler' => __DIR__ . '/GuzzleHttp/Handler/CurlMultiHandler.php',

    'GuzzleHttp\Handler\CurlFactoryInterface' => __DIR__ . '/GuzzleHttp/Handler/CurlFactoryInterface.php',

    'GuzzleHttp\Handler\StreamHandler' => __DIR__ . '/GuzzleHttp/Handler/StreamHandler.php',

    'GuzzleHttp\Handler\EasyHandle' => __DIR__ . '/GuzzleHttp/Handler/EasyHandle.php',

    'GuzzleHttp\Handler\Proxy' => __DIR__ . '/GuzzleHttp/Handler/Proxy.php',

    'GuzzleHttp\Handler\MockHandler' => __DIR__ . '/GuzzleHttp/Handler/MockHandler.php',

    'GuzzleHttp\Handler\CurlHandler' => __DIR__ . '/GuzzleHttp/Handler/CurlHandler.php',

    'GuzzleHttp\PrepareBodyMiddleware' => __DIR__ . '/GuzzleHttp/PrepareBodyMiddleware.php',

    'GuzzleHttp\Middleware' => __DIR__ . '/GuzzleHttp/Middleware.php',

    'GuzzleHttp\TransferStats' => __DIR__ . '/GuzzleHttp/TransferStats.php',

    'GuzzleHttp\HandlerStack' => __DIR__ . '/GuzzleHttp/HandlerStack.php',

    'GuzzleHttp\functions' => __DIR__ . '/GuzzleHttp/functions.php',

    'GuzzleHttp\RequestOptions' => __DIR__ . '/GuzzleHttp/RequestOptions.php',

    'GuzzleHttp\functions_include' => __DIR__ . '/GuzzleHttp/functions_include.php',

    'GuzzleHttp\Client' => __DIR__ . '/GuzzleHttp/Client.php',

    'GuzzleHttp\Promise\CancellationException' => __DIR__ . '/GuzzleHttp/Promise/CancellationException.php',

    'GuzzleHttp\Promise\RejectedPromise' => __DIR__ . '/GuzzleHttp/Promise/RejectedPromise.php',

    'GuzzleHttp\Promise\Coroutine' => __DIR__ . '/GuzzleHttp/Promise/Coroutine.php',

    'GuzzleHttp\Promise\TaskQueueInterface' => __DIR__ . '/GuzzleHttp/Promise/TaskQueueInterface.php',

    'GuzzleHttp\Promise\EachPromise' => __DIR__ . '/GuzzleHttp/Promise/EachPromise.php',

    'GuzzleHttp\Promise\PromisorInterface' => __DIR__ . '/GuzzleHttp/Promise/PromisorInterface.php',

    'GuzzleHttp\Promise\functions' => __DIR__ . '/GuzzleHttp/Promise/functions.php',

    'GuzzleHttp\Promise\functions_include' => __DIR__ . '/GuzzleHttp/Promise/functions_include.php',

    'GuzzleHttp\Promise\PromiseInterface' => __DIR__ . '/GuzzleHttp/Promise/PromiseInterface.php',

    'GuzzleHttp\Promise\Promise' => __DIR__ . '/GuzzleHttp/Promise/Promise.php',

    'GuzzleHttp\Promise\RejectionException' => __DIR__ . '/GuzzleHttp/Promise/RejectionException.php',

    'GuzzleHttp\Promise\TaskQueue' => __DIR__ . '/GuzzleHttp/Promise/TaskQueue.php',

    'GuzzleHttp\Promise\FulfilledPromise' => __DIR__ . '/GuzzleHttp/Promise/FulfilledPromise.php',

    'GuzzleHttp\Promise\AggregateException' => __DIR__ . '/GuzzleHttp/Promise/AggregateException.php',

    'GuzzleHttp\RedirectMiddleware' => __DIR__ . '/GuzzleHttp/RedirectMiddleware.php',

    'GuzzleHttp\Exception\TransferException' => __DIR__ . '/GuzzleHttp/Exception/TransferException.php',

    'GuzzleHttp\Exception\BadResponseException' => __DIR__ . '/GuzzleHttp/Exception/BadResponseException.php',

    'GuzzleHttp\Exception\ServerException' => __DIR__ . '/GuzzleHttp/Exception/ServerException.php',

    'GuzzleHttp\Exception\ConnectException' => __DIR__ . '/GuzzleHttp/Exception/ConnectException.php',

    'GuzzleHttp\Exception\TooManyRedirectsException' => __DIR__ . '/GuzzleHttp/Exception/TooManyRedirectsException.php',

    'GuzzleHttp\Exception\SeekException' => __DIR__ . '/GuzzleHttp/Exception/SeekException.php',

    'GuzzleHttp\Exception\RequestException' => __DIR__ . '/GuzzleHttp/Exception/RequestException.php',

    'GuzzleHttp\Exception\ClientException' => __DIR__ . '/GuzzleHttp/Exception/ClientException.php',

    'GuzzleHttp\Exception\GuzzleException' => __DIR__ . '/GuzzleHttp/Exception/GuzzleException.php',

    'GuzzleHttp\Psr7\Response' => __DIR__ . '/GuzzleHttp/Psr7/Response.php',

    'GuzzleHttp\Psr7\Uri' => __DIR__ . '/GuzzleHttp/Psr7/Uri.php',

    'GuzzleHttp\Psr7\LimitStream' => __DIR__ . '/GuzzleHttp/Psr7/LimitStream.php',

    'GuzzleHttp\Psr7\PumpStream' => __DIR__ . '/GuzzleHttp/Psr7/PumpStream.php',

    'GuzzleHttp\Psr7\FnStream' => __DIR__ . '/GuzzleHttp/Psr7/FnStream.php',

    'GuzzleHttp\Psr7\UriResolver' => __DIR__ . '/GuzzleHttp/Psr7/UriResolver.php',

    'GuzzleHttp\Psr7\LazyOpenStream' => __DIR__ . '/GuzzleHttp/Psr7/LazyOpenStream.php',

    'GuzzleHttp\Psr7\InflateStream' => __DIR__ . '/GuzzleHttp/Psr7/InflateStream.php',

    'GuzzleHttp\Psr7\ServerRequest' => __DIR__ . '/GuzzleHttp/Psr7/ServerRequest.php',

    'GuzzleHttp\Psr7\functions' => __DIR__ . '/GuzzleHttp/Psr7/functions.php',

    'GuzzleHttp\Psr7\functions_include' => __DIR__ . '/GuzzleHttp/Psr7/functions_include.php',

    'GuzzleHttp\Psr7\StreamWrapper' => __DIR__ . '/GuzzleHttp/Psr7/StreamWrapper.php',

    'GuzzleHttp\Psr7\StreamDecoratorTrait' => __DIR__ . '/GuzzleHttp/Psr7/StreamDecoratorTrait.php',

    'GuzzleHttp\Psr7\MessageTrait' => __DIR__ . '/GuzzleHttp/Psr7/MessageTrait.php',

    'GuzzleHttp\Psr7\Request' => __DIR__ . '/GuzzleHttp/Psr7/Request.php',

    'GuzzleHttp\Psr7\UploadedFile' => __DIR__ . '/GuzzleHttp/Psr7/UploadedFile.php',

    'GuzzleHttp\Psr7\UriNormalizer' => __DIR__ . '/GuzzleHttp/Psr7/UriNormalizer.php',

    'GuzzleHttp\Psr7\BufferStream' => __DIR__ . '/GuzzleHttp/Psr7/BufferStream.php',

    'GuzzleHttp\Psr7\MultipartStream' => __DIR__ . '/GuzzleHttp/Psr7/MultipartStream.php',

    'GuzzleHttp\Psr7\CachingStream' => __DIR__ . '/GuzzleHttp/Psr7/CachingStream.php',

    'GuzzleHttp\Psr7\Rfc7230' => __DIR__ . '/GuzzleHttp/Psr7/Rfc7230.php',

    'GuzzleHttp\Psr7\AppendStream' => __DIR__ . '/GuzzleHttp/Psr7/AppendStream.php',

    'GuzzleHttp\Psr7\NoSeekStream' => __DIR__ . '/GuzzleHttp/Psr7/NoSeekStream.php',

    'GuzzleHttp\Psr7\Stream' => __DIR__ . '/GuzzleHttp/Psr7/Stream.php',

    'GuzzleHttp\Psr7\DroppingStream' => __DIR__ . '/GuzzleHttp/Psr7/DroppingStream.php',

    'GuzzleHttp\UriTemplate' => __DIR__ . '/GuzzleHttp/UriTemplate.php',

    'Psr\Http\Message\StreamInterface' => __DIR__ . '/Psr/Http/Message/StreamInterface.php',

    'Psr\Http\Message\UriInterface' => __DIR__ . '/Psr/Http/Message/UriInterface.php',

    'Psr\Http\Message\MessageInterface' => __DIR__ . '/Psr/Http/Message/MessageInterface.php',

    'Psr\Http\Message\ResponseInterface' => __DIR__ . '/Psr/Http/Message/ResponseInterface.php',

    'Psr\Http\Message\ServerRequestInterface' => __DIR__ . '/Psr/Http/Message/ServerRequestInterface.php',

    'Psr\Http\Message\RequestInterface' => __DIR__ . '/Psr/Http/Message/RequestInterface.php',

    'Psr\Http\Message\UploadedFileInterface' => __DIR__ . '/Psr/Http/Message/UploadedFileInterface.php',

    'Aws\Route53\Route53Client' => __DIR__ . '/Aws/Route53/Route53Client.php',

    'Aws\Route53\Exception\Route53Exception' => __DIR__ . '/Aws/Route53/Exception/Route53Exception.php',

    'Aws\RoboMaker\RoboMakerClient' => __DIR__ . '/Aws/RoboMaker/RoboMakerClient.php',

    'Aws\RoboMaker\Exception\RoboMakerException' => __DIR__ . '/Aws/RoboMaker/Exception/RoboMakerException.php',

    'Aws\ElasticsearchService\Exception\ElasticsearchServiceException' => __DIR__ . '/Aws/ElasticsearchService/Exception/ElasticsearchServiceException.php',

    'Aws\ElasticsearchService\ElasticsearchServiceClient' => __DIR__ . '/Aws/ElasticsearchService/ElasticsearchServiceClient.php',

    'Aws\WorkMail\Exception\WorkMailException' => __DIR__ . '/Aws/WorkMail/Exception/WorkMailException.php',

    'Aws\WorkMail\WorkMailClient' => __DIR__ . '/Aws/WorkMail/WorkMailClient.php',

    'Aws\Sns\Message' => __DIR__ . '/Aws/Sns/Message.php',

    'Aws\Sns\SnsClient' => __DIR__ . '/Aws/Sns/SnsClient.php',

    'Aws\Sns\Exception\SnsException' => __DIR__ . '/Aws/Sns/Exception/SnsException.php',

    'Aws\Sns\Exception\InvalidSnsMessageException' => __DIR__ . '/Aws/Sns/Exception/InvalidSnsMessageException.php',

    'Aws\Sns\MessageValidator' => __DIR__ . '/Aws/Sns/MessageValidator.php',

    'Aws\Polly\Exception\PollyException' => __DIR__ . '/Aws/Polly/Exception/PollyException.php',

    'Aws\Polly\PollyClient' => __DIR__ . '/Aws/Polly/PollyClient.php',

    'Aws\ApiGatewayManagementApi\ApiGatewayManagementApiClient' => __DIR__ . '/Aws/ApiGatewayManagementApi/ApiGatewayManagementApiClient.php',

    'Aws\ApiGatewayManagementApi\Exception\ApiGatewayManagementApiException' => __DIR__ . '/Aws/ApiGatewayManagementApi/Exception/ApiGatewayManagementApiException.php',

    'Aws\Textract\TextractClient' => __DIR__ . '/Aws/Textract/TextractClient.php',

    'Aws\Textract\Exception\TextractException' => __DIR__ . '/Aws/Textract/Exception/TextractException.php',

    'Aws\MultiRegionClient' => __DIR__ . '/Aws/MultiRegionClient.php',

    'Aws\GuardDuty\GuardDutyClient' => __DIR__ . '/Aws/GuardDuty/GuardDutyClient.php',

    'Aws\GuardDuty\Exception\GuardDutyException' => __DIR__ . '/Aws/GuardDuty/Exception/GuardDutyException.php',

    'Aws\TranscribeService\Exception\TranscribeServiceException' => __DIR__ . '/Aws/TranscribeService/Exception/TranscribeServiceException.php',

    'Aws\TranscribeService\TranscribeServiceClient' => __DIR__ . '/Aws/TranscribeService/TranscribeServiceClient.php',

    'Aws\OpsWorks\Exception\OpsWorksException' => __DIR__ . '/Aws/OpsWorks/Exception/OpsWorksException.php',

    'Aws\OpsWorks\OpsWorksClient' => __DIR__ . '/Aws/OpsWorks/OpsWorksClient.php',

    'Aws\CognitoSync\CognitoSyncClient' => __DIR__ . '/Aws/CognitoSync/CognitoSyncClient.php',

    'Aws\CognitoSync\Exception\CognitoSyncException' => __DIR__ . '/Aws/CognitoSync/Exception/CognitoSyncException.php',

    'Aws\data\lambda\2015-03-31\api-2.json' => __DIR__ . '/Aws/data/lambda/2015-03-31/api-2.json.php',

    'Aws\data\lambda\2015-03-31\smoke.json' => __DIR__ . '/Aws/data/lambda/2015-03-31/smoke.json.php',

    'Aws\data\lambda\2015-03-31\paginators-1.json' => __DIR__ . '/Aws/data/lambda/2015-03-31/paginators-1.json.php',

    'Aws\data\textract\2018-06-27\api-2.json' => __DIR__ . '/Aws/data/textract/2018-06-27/api-2.json.php',

    'Aws\data\textract\2018-06-27\paginators-1.json' => __DIR__ . '/Aws/data/textract/2018-06-27/paginators-1.json.php',

    'Aws\data\inspector\2016-02-16\api-2.json' => __DIR__ . '/Aws/data/inspector/2016-02-16/api-2.json.php',

    'Aws\data\inspector\2016-02-16\smoke.json' => __DIR__ . '/Aws/data/inspector/2016-02-16/smoke.json.php',

    'Aws\data\inspector\2016-02-16\paginators-1.json' => __DIR__ . '/Aws/data/inspector/2016-02-16/paginators-1.json.php',

    'Aws\data\resource-groups\2017-11-27\api-2.json' => __DIR__ . '/Aws/data/resource-groups/2017-11-27/api-2.json.php',

    'Aws\data\resource-groups\2017-11-27\paginators-1.json' => __DIR__ . '/Aws/data/resource-groups/2017-11-27/paginators-1.json.php',

    'Aws\data\pi\2018-02-27\api-2.json' => __DIR__ . '/Aws/data/pi/2018-02-27/api-2.json.php',

    'Aws\data\pi\2018-02-27\paginators-1.json' => __DIR__ . '/Aws/data/pi/2018-02-27/paginators-1.json.php',

    'Aws\data\batch\2016-08-10\api-2.json' => __DIR__ . '/Aws/data/batch/2016-08-10/api-2.json.php',

    'Aws\data\batch\2016-08-10\smoke.json' => __DIR__ . '/Aws/data/batch/2016-08-10/smoke.json.php',

    'Aws\data\batch\2016-08-10\paginators-1.json' => __DIR__ . '/Aws/data/batch/2016-08-10/paginators-1.json.php',

    'Aws\data\pinpoint-email\2018-07-26\api-2.json' => __DIR__ . '/Aws/data/pinpoint-email/2018-07-26/api-2.json.php',

    'Aws\data\pinpoint-email\2018-07-26\paginators-1.json' => __DIR__ . '/Aws/data/pinpoint-email/2018-07-26/paginators-1.json.php',

    'Aws\data\codecommit\2015-04-13\api-2.json' => __DIR__ . '/Aws/data/codecommit/2015-04-13/api-2.json.php',

    'Aws\data\codecommit\2015-04-13\smoke.json' => __DIR__ . '/Aws/data/codecommit/2015-04-13/smoke.json.php',

    'Aws\data\codecommit\2015-04-13\paginators-1.json' => __DIR__ . '/Aws/data/codecommit/2015-04-13/paginators-1.json.php',

    'Aws\data\workspaces\2015-04-08\api-2.json' => __DIR__ . '/Aws/data/workspaces/2015-04-08/api-2.json.php',

    'Aws\data\workspaces\2015-04-08\smoke.json' => __DIR__ . '/Aws/data/workspaces/2015-04-08/smoke.json.php',

    'Aws\data\workspaces\2015-04-08\paginators-1.json' => __DIR__ . '/Aws/data/workspaces/2015-04-08/paginators-1.json.php',

    'Aws\data\connect\2017-08-08\api-2.json' => __DIR__ . '/Aws/data/connect/2017-08-08/api-2.json.php',

    'Aws\data\connect\2017-08-08\paginators-1.json' => __DIR__ . '/Aws/data/connect/2017-08-08/paginators-1.json.php',

    'Aws\data\events\2015-10-07\api-2.json' => __DIR__ . '/Aws/data/events/2015-10-07/api-2.json.php',

    'Aws\data\events\2015-10-07\smoke.json' => __DIR__ . '/Aws/data/events/2015-10-07/smoke.json.php',

    'Aws\data\events\2015-10-07\paginators-1.json' => __DIR__ . '/Aws/data/events/2015-10-07/paginators-1.json.php',

    'Aws\data\alexaforbusiness\2017-11-09\api-2.json' => __DIR__ . '/Aws/data/alexaforbusiness/2017-11-09/api-2.json.php',

    'Aws\data\alexaforbusiness\2017-11-09\paginators-1.json' => __DIR__ . '/Aws/data/alexaforbusiness/2017-11-09/paginators-1.json.php',

    'Aws\data\greengrass\2017-06-07\api-2.json' => __DIR__ . '/Aws/data/greengrass/2017-06-07/api-2.json.php',

    'Aws\data\mediastore\2017-09-01\api-2.json' => __DIR__ . '/Aws/data/mediastore/2017-09-01/api-2.json.php',

    'Aws\data\mediastore\2017-09-01\paginators-1.json' => __DIR__ . '/Aws/data/mediastore/2017-09-01/paginators-1.json.php',

    'Aws\data\entitlement.marketplace\2017-01-11\api-2.json' => __DIR__ . '/Aws/data/entitlement.marketplace/2017-01-11/api-2.json.php',

    'Aws\data\entitlement.marketplace\2017-01-11\paginators-1.json' => __DIR__ . '/Aws/data/entitlement.marketplace/2017-01-11/paginators-1.json.php',

    'Aws\data\chime\2018-05-01\api-2.json' => __DIR__ . '/Aws/data/chime/2018-05-01/api-2.json.php',

    'Aws\data\chime\2018-05-01\paginators-1.json' => __DIR__ . '/Aws/data/chime/2018-05-01/paginators-1.json.php',

    'Aws\data\kinesisanalytics\2015-08-14\api-2.json' => __DIR__ . '/Aws/data/kinesisanalytics/2015-08-14/api-2.json.php',

    'Aws\data\kinesisanalytics\2015-08-14\paginators-1.json' => __DIR__ . '/Aws/data/kinesisanalytics/2015-08-14/paginators-1.json.php',

    'Aws\data\guardduty\2017-11-28\api-2.json' => __DIR__ . '/Aws/data/guardduty/2017-11-28/api-2.json.php',

    'Aws\data\guardduty\2017-11-28\paginators-1.json' => __DIR__ . '/Aws/data/guardduty/2017-11-28/paginators-1.json.php',

    'Aws\data\xray\2016-04-12\api-2.json' => __DIR__ . '/Aws/data/xray/2016-04-12/api-2.json.php',

    'Aws\data\xray\2016-04-12\paginators-1.json' => __DIR__ . '/Aws/data/xray/2016-04-12/paginators-1.json.php',

    'Aws\data\elasticloadbalancingv2\2015-12-01\api-2.json' => __DIR__ . '/Aws/data/elasticloadbalancingv2/2015-12-01/api-2.json.php',

    'Aws\data\elasticloadbalancingv2\2015-12-01\smoke.json' => __DIR__ . '/Aws/data/elasticloadbalancingv2/2015-12-01/smoke.json.php',

    'Aws\data\elasticloadbalancingv2\2015-12-01\waiters-2.json' => __DIR__ . '/Aws/data/elasticloadbalancingv2/2015-12-01/waiters-2.json.php',

    'Aws\data\elasticloadbalancingv2\2015-12-01\paginators-1.json' => __DIR__ . '/Aws/data/elasticloadbalancingv2/2015-12-01/paginators-1.json.php',

    'Aws\data\s3\2006-03-01\api-2.json' => __DIR__ . '/Aws/data/s3/2006-03-01/api-2.json.php',

    'Aws\data\s3\2006-03-01\smoke.json' => __DIR__ . '/Aws/data/s3/2006-03-01/smoke.json.php',

    'Aws\data\s3\2006-03-01\waiters-2.json' => __DIR__ . '/Aws/data/s3/2006-03-01/waiters-2.json.php',

    'Aws\data\s3\2006-03-01\paginators-1.json' => __DIR__ . '/Aws/data/s3/2006-03-01/paginators-1.json.php',

    'Aws\data\s3\2006-03-01\waiters-1.json' => __DIR__ . '/Aws/data/s3/2006-03-01/waiters-1.json.php',

    'Aws\data\ecs\2014-11-13\api-2.json' => __DIR__ . '/Aws/data/ecs/2014-11-13/api-2.json.php',

    'Aws\data\ecs\2014-11-13\smoke.json' => __DIR__ . '/Aws/data/ecs/2014-11-13/smoke.json.php',

    'Aws\data\ecs\2014-11-13\waiters-2.json' => __DIR__ . '/Aws/data/ecs/2014-11-13/waiters-2.json.php',

    'Aws\data\ecs\2014-11-13\paginators-1.json' => __DIR__ . '/Aws/data/ecs/2014-11-13/paginators-1.json.php',

    'Aws\data\cloudformation\2010-05-15\api-2.json' => __DIR__ . '/Aws/data/cloudformation/2010-05-15/api-2.json.php',

    'Aws\data\cloudformation\2010-05-15\waiters-2.json' => __DIR__ . '/Aws/data/cloudformation/2010-05-15/waiters-2.json.php',

    'Aws\data\cloudformation\2010-05-15\paginators-1.json' => __DIR__ . '/Aws/data/cloudformation/2010-05-15/paginators-1.json.php',

    'Aws\data\data.iot\2015-05-28\api-2.json' => __DIR__ . '/Aws/data/data.iot/2015-05-28/api-2.json.php',

    'Aws\data\glue\2017-03-31\api-2.json' => __DIR__ . '/Aws/data/glue/2017-03-31/api-2.json.php',

    'Aws\data\glue\2017-03-31\smoke.json' => __DIR__ . '/Aws/data/glue/2017-03-31/smoke.json.php',

    'Aws\data\glue\2017-03-31\paginators-1.json' => __DIR__ . '/Aws/data/glue/2017-03-31/paginators-1.json.php',

    'Aws\data\apigatewaymanagementapi\2018-11-29\api-2.json' => __DIR__ . '/Aws/data/apigatewaymanagementapi/2018-11-29/api-2.json.php',

    'Aws\data\apigatewaymanagementapi\2018-11-29\paginators-1.json' => __DIR__ . '/Aws/data/apigatewaymanagementapi/2018-11-29/paginators-1.json.php',

    'Aws\data\kafka\2018-11-14\api-2.json' => __DIR__ . '/Aws/data/kafka/2018-11-14/api-2.json.php',

    'Aws\data\kafka\2018-11-14\paginators-1.json' => __DIR__ . '/Aws/data/kafka/2018-11-14/paginators-1.json.php',

    'Aws\data\mgh\2017-05-31\api-2.json' => __DIR__ . '/Aws/data/mgh/2017-05-31/api-2.json.php',

    'Aws\data\mgh\2017-05-31\paginators-1.json' => __DIR__ . '/Aws/data/mgh/2017-05-31/paginators-1.json.php',

    'Aws\data\opsworkscm\2016-11-01\api-2.json' => __DIR__ . '/Aws/data/opsworkscm/2016-11-01/api-2.json.php',

    'Aws\data\opsworkscm\2016-11-01\waiters-2.json' => __DIR__ . '/Aws/data/opsworkscm/2016-11-01/waiters-2.json.php',

    'Aws\data\opsworkscm\2016-11-01\paginators-1.json' => __DIR__ . '/Aws/data/opsworkscm/2016-11-01/paginators-1.json.php',

    'Aws\data\mobile\2017-07-01\api-2.json' => __DIR__ . '/Aws/data/mobile/2017-07-01/api-2.json.php',

    'Aws\data\mobile\2017-07-01\paginators-1.json' => __DIR__ . '/Aws/data/mobile/2017-07-01/paginators-1.json.php',

    'Aws\data\shield\2016-06-02\api-2.json' => __DIR__ . '/Aws/data/shield/2016-06-02/api-2.json.php',

    'Aws\data\shield\2016-06-02\smoke.json' => __DIR__ . '/Aws/data/shield/2016-06-02/smoke.json.php',

    'Aws\data\shield\2016-06-02\paginators-1.json' => __DIR__ . '/Aws/data/shield/2016-06-02/paginators-1.json.php',

    'Aws\data\gamelift\2015-10-01\api-2.json' => __DIR__ . '/Aws/data/gamelift/2015-10-01/api-2.json.php',

    'Aws\data\gamelift\2015-10-01\smoke.json' => __DIR__ . '/Aws/data/gamelift/2015-10-01/smoke.json.php',

    'Aws\data\gamelift\2015-10-01\paginators-1.json' => __DIR__ . '/Aws/data/gamelift/2015-10-01/paginators-1.json.php',

    'Aws\data\autoscaling-plans\2018-01-06\api-2.json' => __DIR__ . '/Aws/data/autoscaling-plans/2018-01-06/api-2.json.php',

    'Aws\data\autoscaling-plans\2018-01-06\paginators-1.json' => __DIR__ . '/Aws/data/autoscaling-plans/2018-01-06/paginators-1.json.php',

    'Aws\data\storagegateway\2013-06-30\api-2.json' => __DIR__ . '/Aws/data/storagegateway/2013-06-30/api-2.json.php',

    'Aws\data\storagegateway\2013-06-30\paginators-1.json' => __DIR__ . '/Aws/data/storagegateway/2013-06-30/paginators-1.json.php',

    'Aws\data\apigateway\2015-07-09\api-2.json' => __DIR__ . '/Aws/data/apigateway/2015-07-09/api-2.json.php',

    'Aws\data\apigateway\2015-07-09\smoke.json' => __DIR__ . '/Aws/data/apigateway/2015-07-09/smoke.json.php',

    'Aws\data\apigateway\2015-07-09\paginators-1.json' => __DIR__ . '/Aws/data/apigateway/2015-07-09/paginators-1.json.php',

    'Aws\data\pricing\2017-10-15\api-2.json' => __DIR__ . '/Aws/data/pricing/2017-10-15/api-2.json.php',

    'Aws\data\pricing\2017-10-15\paginators-1.json' => __DIR__ . '/Aws/data/pricing/2017-10-15/paginators-1.json.php',

    'Aws\data\elasticmapreduce\2009-03-31\api-2.json' => __DIR__ . '/Aws/data/elasticmapreduce/2009-03-31/api-2.json.php',

    'Aws\data\elasticmapreduce\2009-03-31\smoke.json' => __DIR__ . '/Aws/data/elasticmapreduce/2009-03-31/smoke.json.php',

    'Aws\data\elasticmapreduce\2009-03-31\waiters-2.json' => __DIR__ . '/Aws/data/elasticmapreduce/2009-03-31/waiters-2.json.php',

    'Aws\data\elasticmapreduce\2009-03-31\paginators-1.json' => __DIR__ . '/Aws/data/elasticmapreduce/2009-03-31/paginators-1.json.php',

    'Aws\data\cloudtrail\2013-11-01\api-2.json' => __DIR__ . '/Aws/data/cloudtrail/2013-11-01/api-2.json.php',

    'Aws\data\cloudtrail\2013-11-01\smoke.json' => __DIR__ . '/Aws/data/cloudtrail/2013-11-01/smoke.json.php',

    'Aws\data\cloudtrail\2013-11-01\paginators-1.json' => __DIR__ . '/Aws/data/cloudtrail/2013-11-01/paginators-1.json.php',

    'Aws\data\robomaker\2018-06-29\api-2.json' => __DIR__ . '/Aws/data/robomaker/2018-06-29/api-2.json.php',

    'Aws\data\robomaker\2018-06-29\paginators-1.json' => __DIR__ . '/Aws/data/robomaker/2018-06-29/paginators-1.json.php',

    'Aws\data\codebuild\2016-10-06\api-2.json' => __DIR__ . '/Aws/data/codebuild/2016-10-06/api-2.json.php',

    'Aws\data\codebuild\2016-10-06\smoke.json' => __DIR__ . '/Aws/data/codebuild/2016-10-06/smoke.json.php',

    'Aws\data\codebuild\2016-10-06\paginators-1.json' => __DIR__ . '/Aws/data/codebuild/2016-10-06/paginators-1.json.php',

    'Aws\data\iam\2010-05-08\api-2.json' => __DIR__ . '/Aws/data/iam/2010-05-08/api-2.json.php',

    'Aws\data\iam\2010-05-08\smoke.json' => __DIR__ . '/Aws/data/iam/2010-05-08/smoke.json.php',

    'Aws\data\iam\2010-05-08\waiters-2.json' => __DIR__ . '/Aws/data/iam/2010-05-08/waiters-2.json.php',

    'Aws\data\iam\2010-05-08\paginators-1.json' => __DIR__ . '/Aws/data/iam/2010-05-08/paginators-1.json.php',

    'Aws\data\mturk-requester\2017-01-17\api-2.json' => __DIR__ . '/Aws/data/mturk-requester/2017-01-17/api-2.json.php',

    'Aws\data\mturk-requester\2017-01-17\smoke.json' => __DIR__ . '/Aws/data/mturk-requester/2017-01-17/smoke.json.php',

    'Aws\data\mturk-requester\2017-01-17\paginators-1.json' => __DIR__ . '/Aws/data/mturk-requester/2017-01-17/paginators-1.json.php',

    'Aws\data\securityhub\2018-10-26\api-2.json' => __DIR__ . '/Aws/data/securityhub/2018-10-26/api-2.json.php',

    'Aws\data\securityhub\2018-10-26\paginators-1.json' => __DIR__ . '/Aws/data/securityhub/2018-10-26/paginators-1.json.php',

    'Aws\data\dms\2016-01-01\api-2.json' => __DIR__ . '/Aws/data/dms/2016-01-01/api-2.json.php',

    'Aws\data\dms\2016-01-01\smoke.json' => __DIR__ . '/Aws/data/dms/2016-01-01/smoke.json.php',

    'Aws\data\dms\2016-01-01\waiters-2.json' => __DIR__ . '/Aws/data/dms/2016-01-01/waiters-2.json.php',

    'Aws\data\dms\2016-01-01\paginators-1.json' => __DIR__ . '/Aws/data/dms/2016-01-01/paginators-1.json.php',

    'Aws\data\cur\2017-01-06\api-2.json' => __DIR__ . '/Aws/data/cur/2017-01-06/api-2.json.php',

    'Aws\data\cur\2017-01-06\smoke.json' => __DIR__ . '/Aws/data/cur/2017-01-06/smoke.json.php',

    'Aws\data\cur\2017-01-06\paginators-1.json' => __DIR__ . '/Aws/data/cur/2017-01-06/paginators-1.json.php',

    'Aws\data\ssm\2014-11-06\api-2.json' => __DIR__ . '/Aws/data/ssm/2014-11-06/api-2.json.php',

    'Aws\data\ssm\2014-11-06\smoke.json' => __DIR__ . '/Aws/data/ssm/2014-11-06/smoke.json.php',

    'Aws\data\ssm\2014-11-06\paginators-1.json' => __DIR__ . '/Aws/data/ssm/2014-11-06/paginators-1.json.php',

    'Aws\data\route53domains\2014-05-15\api-2.json' => __DIR__ . '/Aws/data/route53domains/2014-05-15/api-2.json.php',

    'Aws\data\route53domains\2014-05-15\paginators-1.json' => __DIR__ . '/Aws/data/route53domains/2014-05-15/paginators-1.json.php',

    'Aws\data\marketplacecommerceanalytics\2015-07-01\api-2.json' => __DIR__ . '/Aws/data/marketplacecommerceanalytics/2015-07-01/api-2.json.php',

    'Aws\data\marketplacecommerceanalytics\2015-07-01\paginators-1.json' => __DIR__ . '/Aws/data/marketplacecommerceanalytics/2015-07-01/paginators-1.json.php',

    'Aws\data\importexport\2010-06-01\api-2.json' => __DIR__ . '/Aws/data/importexport/2010-06-01/api-2.json.php',

    'Aws\data\importexport\2010-06-01\paginators-1.json' => __DIR__ . '/Aws/data/importexport/2010-06-01/paginators-1.json.php',

    'Aws\data\email\2010-12-01\api-2.json' => __DIR__ . '/Aws/data/email/2010-12-01/api-2.json.php',

    'Aws\data\email\2010-12-01\smoke.json' => __DIR__ . '/Aws/data/email/2010-12-01/smoke.json.php',

    'Aws\data\email\2010-12-01\waiters-2.json' => __DIR__ . '/Aws/data/email/2010-12-01/waiters-2.json.php',

    'Aws\data\email\2010-12-01\paginators-1.json' => __DIR__ . '/Aws/data/email/2010-12-01/paginators-1.json.php',

    'Aws\data\email\2010-12-01\waiters-1.json' => __DIR__ . '/Aws/data/email/2010-12-01/waiters-1.json.php',

    'Aws\data\comprehend\2017-11-27\api-2.json' => __DIR__ . '/Aws/data/comprehend/2017-11-27/api-2.json.php',

    'Aws\data\comprehend\2017-11-27\paginators-1.json' => __DIR__ . '/Aws/data/comprehend/2017-11-27/paginators-1.json.php',

    'Aws\data\macie\2017-12-19\api-2.json' => __DIR__ . '/Aws/data/macie/2017-12-19/api-2.json.php',

    'Aws\data\macie\2017-12-19\paginators-1.json' => __DIR__ . '/Aws/data/macie/2017-12-19/paginators-1.json.php',

    'Aws\data\iot1click-projects\2018-05-14\api-2.json' => __DIR__ . '/Aws/data/iot1click-projects/2018-05-14/api-2.json.php',

    'Aws\data\iot1click-projects\2018-05-14\paginators-1.json' => __DIR__ . '/Aws/data/iot1click-projects/2018-05-14/paginators-1.json.php',

    'Aws\data\iot-jobs-data\2017-09-29\api-2.json' => __DIR__ . '/Aws/data/iot-jobs-data/2017-09-29/api-2.json.php',

    'Aws\data\iot-jobs-data\2017-09-29\paginators-1.json' => __DIR__ . '/Aws/data/iot-jobs-data/2017-09-29/paginators-1.json.php',

    'Aws\data\es\2015-01-01\api-2.json' => __DIR__ . '/Aws/data/es/2015-01-01/api-2.json.php',

    'Aws\data\es\2015-01-01\smoke.json' => __DIR__ . '/Aws/data/es/2015-01-01/smoke.json.php',

    'Aws\data\es\2015-01-01\paginators-1.json' => __DIR__ . '/Aws/data/es/2015-01-01/paginators-1.json.php',

    'Aws\data\transfer\2018-11-05\api-2.json' => __DIR__ . '/Aws/data/transfer/2018-11-05/api-2.json.php',

    'Aws\data\transfer\2018-11-05\paginators-1.json' => __DIR__ . '/Aws/data/transfer/2018-11-05/paginators-1.json.php',

    'Aws\data\iotanalytics\2017-11-27\api-2.json' => __DIR__ . '/Aws/data/iotanalytics/2017-11-27/api-2.json.php',

    'Aws\data\iotanalytics\2017-11-27\paginators-1.json' => __DIR__ . '/Aws/data/iotanalytics/2017-11-27/paginators-1.json.php',

    'Aws\data\health\2016-08-04\api-2.json' => __DIR__ . '/Aws/data/health/2016-08-04/api-2.json.php',

    'Aws\data\health\2016-08-04\paginators-1.json' => __DIR__ . '/Aws/data/health/2016-08-04/paginators-1.json.php',

    'Aws\data\runtime.lex\2016-11-28\api-2.json' => __DIR__ . '/Aws/data/runtime.lex/2016-11-28/api-2.json.php',

    'Aws\data\runtime.lex\2016-11-28\paginators-1.json' => __DIR__ . '/Aws/data/runtime.lex/2016-11-28/paginators-1.json.php',

    'Aws\data\discovery\2015-11-01\api-2.json' => __DIR__ . '/Aws/data/discovery/2015-11-01/api-2.json.php',

    'Aws\data\discovery\2015-11-01\smoke.json' => __DIR__ . '/Aws/data/discovery/2015-11-01/smoke.json.php',

    'Aws\data\discovery\2015-11-01\paginators-1.json' => __DIR__ . '/Aws/data/discovery/2015-11-01/paginators-1.json.php',

    'Aws\data\machinelearning\2014-12-12\api-2.json' => __DIR__ . '/Aws/data/machinelearning/2014-12-12/api-2.json.php',

    'Aws\data\machinelearning\2014-12-12\waiters-2.json' => __DIR__ . '/Aws/data/machinelearning/2014-12-12/waiters-2.json.php',

    'Aws\data\machinelearning\2014-12-12\paginators-1.json' => __DIR__ . '/Aws/data/machinelearning/2014-12-12/paginators-1.json.php',

    'Aws\data\sagemaker\2017-07-24\api-2.json' => __DIR__ . '/Aws/data/sagemaker/2017-07-24/api-2.json.php',

    'Aws\data\sagemaker\2017-07-24\waiters-2.json' => __DIR__ . '/Aws/data/sagemaker/2017-07-24/waiters-2.json.php',

    'Aws\data\sagemaker\2017-07-24\paginators-1.json' => __DIR__ . '/Aws/data/sagemaker/2017-07-24/paginators-1.json.php',

    'Aws\data\translate\2017-07-01\api-2.json' => __DIR__ . '/Aws/data/translate/2017-07-01/api-2.json.php',

    'Aws\data\translate\2017-07-01\paginators-1.json' => __DIR__ . '/Aws/data/translate/2017-07-01/paginators-1.json.php',

    'Aws\data\cognito-sync\2014-06-30\api-2.json' => __DIR__ . '/Aws/data/cognito-sync/2014-06-30/api-2.json.php',

    'Aws\data\kinesisvideo\2017-09-30\api-2.json' => __DIR__ . '/Aws/data/kinesisvideo/2017-09-30/api-2.json.php',

    'Aws\data\kinesisvideo\2017-09-30\paginators-1.json' => __DIR__ . '/Aws/data/kinesisvideo/2017-09-30/paginators-1.json.php',

    'Aws\data\manifest.json' => __DIR__ . '/Aws/data/manifest.json.php',

    'Aws\data\pinpoint\2016-12-01\api-2.json' => __DIR__ . '/Aws/data/pinpoint/2016-12-01/api-2.json.php',

    'Aws\data\resourcegroupstaggingapi\2017-01-26\api-2.json' => __DIR__ . '/Aws/data/resourcegroupstaggingapi/2017-01-26/api-2.json.php',

    'Aws\data\resourcegroupstaggingapi\2017-01-26\paginators-1.json' => __DIR__ . '/Aws/data/resourcegroupstaggingapi/2017-01-26/paginators-1.json.php',

    'Aws\data\elasticbeanstalk\2010-12-01\api-2.json' => __DIR__ . '/Aws/data/elasticbeanstalk/2010-12-01/api-2.json.php',

    'Aws\data\elasticbeanstalk\2010-12-01\smoke.json' => __DIR__ . '/Aws/data/elasticbeanstalk/2010-12-01/smoke.json.php',

    'Aws\data\elasticbeanstalk\2010-12-01\paginators-1.json' => __DIR__ . '/Aws/data/elasticbeanstalk/2010-12-01/paginators-1.json.php',

    'Aws\data\apigatewayv2\2018-11-29\api-2.json' => __DIR__ . '/Aws/data/apigatewayv2/2018-11-29/api-2.json.php',

    'Aws\data\apigatewayv2\2018-11-29\paginators-1.json' => __DIR__ . '/Aws/data/apigatewayv2/2018-11-29/paginators-1.json.php',

    'Aws\data\dlm\2018-01-12\api-2.json' => __DIR__ . '/Aws/data/dlm/2018-01-12/api-2.json.php',

    'Aws\data\dlm\2018-01-12\paginators-1.json' => __DIR__ . '/Aws/data/dlm/2018-01-12/paginators-1.json.php',

    'Aws\data\worklink\2018-09-25\api-2.json' => __DIR__ . '/Aws/data/worklink/2018-09-25/api-2.json.php',

    'Aws\data\worklink\2018-09-25\paginators-1.json' => __DIR__ . '/Aws/data/worklink/2018-09-25/paginators-1.json.php',

    'Aws\data\cloud9\2017-09-23\api-2.json' => __DIR__ . '/Aws/data/cloud9/2017-09-23/api-2.json.php',

    'Aws\data\cloud9\2017-09-23\paginators-1.json' => __DIR__ . '/Aws/data/cloud9/2017-09-23/paginators-1.json.php',

    'Aws\data\autoscaling\2011-01-01\api-2.json' => __DIR__ . '/Aws/data/autoscaling/2011-01-01/api-2.json.php',

    'Aws\data\autoscaling\2011-01-01\smoke.json' => __DIR__ . '/Aws/data/autoscaling/2011-01-01/smoke.json.php',

    'Aws\data\autoscaling\2011-01-01\waiters-2.json' => __DIR__ . '/Aws/data/autoscaling/2011-01-01/waiters-2.json.php',

    'Aws\data\autoscaling\2011-01-01\paginators-1.json' => __DIR__ . '/Aws/data/autoscaling/2011-01-01/paginators-1.json.php',

    'Aws\data\logs\2014-03-28\api-2.json' => __DIR__ . '/Aws/data/logs/2014-03-28/api-2.json.php',

    'Aws\data\logs\2014-03-28\smoke.json' => __DIR__ . '/Aws/data/logs/2014-03-28/smoke.json.php',

    'Aws\data\logs\2014-03-28\paginators-1.json' => __DIR__ . '/Aws/data/logs/2014-03-28/paginators-1.json.php',

    'Aws\data\transcribe\2017-10-26\api-2.json' => __DIR__ . '/Aws/data/transcribe/2017-10-26/api-2.json.php',

    'Aws\data\transcribe\2017-10-26\paginators-1.json' => __DIR__ . '/Aws/data/transcribe/2017-10-26/paginators-1.json.php',

    'Aws\data\elasticache\2015-02-02\api-2.json' => __DIR__ . '/Aws/data/elasticache/2015-02-02/api-2.json.php',

    'Aws\data\elasticache\2015-02-02\smoke.json' => __DIR__ . '/Aws/data/elasticache/2015-02-02/smoke.json.php',

    'Aws\data\elasticache\2015-02-02\waiters-2.json' => __DIR__ . '/Aws/data/elasticache/2015-02-02/waiters-2.json.php',

    'Aws\data\elasticache\2015-02-02\paginators-1.json' => __DIR__ . '/Aws/data/elasticache/2015-02-02/paginators-1.json.php',

    'Aws\data\sts\2011-06-15\api-2.json' => __DIR__ . '/Aws/data/sts/2011-06-15/api-2.json.php',

    'Aws\data\sts\2011-06-15\smoke.json' => __DIR__ . '/Aws/data/sts/2011-06-15/smoke.json.php',

    'Aws\data\sts\2011-06-15\paginators-1.json' => __DIR__ . '/Aws/data/sts/2011-06-15/paginators-1.json.php',

    'Aws\data\waf-regional\2016-11-28\api-2.json' => __DIR__ . '/Aws/data/waf-regional/2016-11-28/api-2.json.php',

    'Aws\data\waf-regional\2016-11-28\smoke.json' => __DIR__ . '/Aws/data/waf-regional/2016-11-28/smoke.json.php',

    'Aws\data\waf-regional\2016-11-28\paginators-1.json' => __DIR__ . '/Aws/data/waf-regional/2016-11-28/paginators-1.json.php',

    'Aws\data\servicecatalog\2015-12-10\api-2.json' => __DIR__ . '/Aws/data/servicecatalog/2015-12-10/api-2.json.php',

    'Aws\data\servicecatalog\2015-12-10\smoke.json' => __DIR__ . '/Aws/data/servicecatalog/2015-12-10/smoke.json.php',

    'Aws\data\servicecatalog\2015-12-10\paginators-1.json' => __DIR__ . '/Aws/data/servicecatalog/2015-12-10/paginators-1.json.php',

    'Aws\data\appmesh\2019-01-25\api-2.json' => __DIR__ . '/Aws/data/appmesh/2019-01-25/api-2.json.php',

    'Aws\data\appmesh\2019-01-25\paginators-1.json' => __DIR__ . '/Aws/data/appmesh/2019-01-25/paginators-1.json.php',

    'Aws\data\appmesh\2018-10-01\api-2.json' => __DIR__ . '/Aws/data/appmesh/2018-10-01/api-2.json.php',

    'Aws\data\appmesh\2018-10-01\paginators-1.json' => __DIR__ . '/Aws/data/appmesh/2018-10-01/paginators-1.json.php',

    'Aws\data\organizations\2016-11-28\api-2.json' => __DIR__ . '/Aws/data/organizations/2016-11-28/api-2.json.php',

    'Aws\data\organizations\2016-11-28\paginators-1.json' => __DIR__ . '/Aws/data/organizations/2016-11-28/paginators-1.json.php',

    'Aws\data\mediastore-data\2017-09-01\api-2.json' => __DIR__ . '/Aws/data/mediastore-data/2017-09-01/api-2.json.php',

    'Aws\data\mediastore-data\2017-09-01\paginators-1.json' => __DIR__ . '/Aws/data/mediastore-data/2017-09-01/paginators-1.json.php',

    'Aws\data\cloudsearch\2013-01-01\api-2.json' => __DIR__ . '/Aws/data/cloudsearch/2013-01-01/api-2.json.php',

    'Aws\data\cloudsearch\2013-01-01\paginators-1.json' => __DIR__ . '/Aws/data/cloudsearch/2013-01-01/paginators-1.json.php',

    'Aws\data\dynamodb\2011-12-05\api-2.json' => __DIR__ . '/Aws/data/dynamodb/2011-12-05/api-2.json.php',

    'Aws\data\dynamodb\2011-12-05\smoke.json' => __DIR__ . '/Aws/data/dynamodb/2011-12-05/smoke.json.php',

    'Aws\data\dynamodb\2011-12-05\waiters-2.json' => __DIR__ . '/Aws/data/dynamodb/2011-12-05/waiters-2.json.php',

    'Aws\data\dynamodb\2011-12-05\paginators-1.json' => __DIR__ . '/Aws/data/dynamodb/2011-12-05/paginators-1.json.php',

    'Aws\data\dynamodb\2011-12-05\waiters-1.json' => __DIR__ . '/Aws/data/dynamodb/2011-12-05/waiters-1.json.php',

    'Aws\data\dynamodb\2012-08-10\api-2.json' => __DIR__ . '/Aws/data/dynamodb/2012-08-10/api-2.json.php',

    'Aws\data\dynamodb\2012-08-10\smoke.json' => __DIR__ . '/Aws/data/dynamodb/2012-08-10/smoke.json.php',

    'Aws\data\dynamodb\2012-08-10\waiters-2.json' => __DIR__ . '/Aws/data/dynamodb/2012-08-10/waiters-2.json.php',

    'Aws\data\dynamodb\2012-08-10\paginators-1.json' => __DIR__ . '/Aws/data/dynamodb/2012-08-10/paginators-1.json.php',

    'Aws\data\dynamodb\2012-08-10\waiters-1.json' => __DIR__ . '/Aws/data/dynamodb/2012-08-10/waiters-1.json.php',

    'Aws\data\neptune\2014-10-31\api-2.json' => __DIR__ . '/Aws/data/neptune/2014-10-31/api-2.json.php',

    'Aws\data\neptune\2014-10-31\waiters-2.json' => __DIR__ . '/Aws/data/neptune/2014-10-31/waiters-2.json.php',

    'Aws\data\neptune\2014-10-31\paginators-1.json' => __DIR__ . '/Aws/data/neptune/2014-10-31/paginators-1.json.php',

    'Aws\data\mediaconnect\2018-11-14\api-2.json' => __DIR__ . '/Aws/data/mediaconnect/2018-11-14/api-2.json.php',

    'Aws\data\mediaconnect\2018-11-14\paginators-1.json' => __DIR__ . '/Aws/data/mediaconnect/2018-11-14/paginators-1.json.php',

    'Aws\data\datapipeline\2012-10-29\api-2.json' => __DIR__ . '/Aws/data/datapipeline/2012-10-29/api-2.json.php',

    'Aws\data\datapipeline\2012-10-29\paginators-1.json' => __DIR__ . '/Aws/data/datapipeline/2012-10-29/paginators-1.json.php',

    'Aws\data\budgets\2016-10-20\api-2.json' => __DIR__ . '/Aws/data/budgets/2016-10-20/api-2.json.php',

    'Aws\data\budgets\2016-10-20\paginators-1.json' => __DIR__ . '/Aws/data/budgets/2016-10-20/paginators-1.json.php',

    'Aws\data\monitoring\2010-08-01\api-2.json' => __DIR__ . '/Aws/data/monitoring/2010-08-01/api-2.json.php',

    'Aws\data\monitoring\2010-08-01\smoke.json' => __DIR__ . '/Aws/data/monitoring/2010-08-01/smoke.json.php',

    'Aws\data\monitoring\2010-08-01\waiters-2.json' => __DIR__ . '/Aws/data/monitoring/2010-08-01/waiters-2.json.php',

    'Aws\data\monitoring\2010-08-01\paginators-1.json' => __DIR__ . '/Aws/data/monitoring/2010-08-01/paginators-1.json.php',

    'Aws\data\elastictranscoder\2012-09-25\api-2.json' => __DIR__ . '/Aws/data/elastictranscoder/2012-09-25/api-2.json.php',

    'Aws\data\elastictranscoder\2012-09-25\smoke.json' => __DIR__ . '/Aws/data/elastictranscoder/2012-09-25/smoke.json.php',

    'Aws\data\elastictranscoder\2012-09-25\waiters-2.json' => __DIR__ . '/Aws/data/elastictranscoder/2012-09-25/waiters-2.json.php',

    'Aws\data\elastictranscoder\2012-09-25\paginators-1.json' => __DIR__ . '/Aws/data/elastictranscoder/2012-09-25/paginators-1.json.php',

    'Aws\data\elastictranscoder\2012-09-25\waiters-1.json' => __DIR__ . '/Aws/data/elastictranscoder/2012-09-25/waiters-1.json.php',

    'Aws\data\kinesis\2013-12-02\api-2.json' => __DIR__ . '/Aws/data/kinesis/2013-12-02/api-2.json.php',

    'Aws\data\kinesis\2013-12-02\smoke.json' => __DIR__ . '/Aws/data/kinesis/2013-12-02/smoke.json.php',

    'Aws\data\kinesis\2013-12-02\waiters-2.json' => __DIR__ . '/Aws/data/kinesis/2013-12-02/waiters-2.json.php',

    'Aws\data\kinesis\2013-12-02\paginators-1.json' => __DIR__ . '/Aws/data/kinesis/2013-12-02/paginators-1.json.php',

    'Aws\data\ec2\2016-04-01\api-2.json' => __DIR__ . '/Aws/data/ec2/2016-04-01/api-2.json.php',

    'Aws\data\ec2\2016-04-01\waiters-2.json' => __DIR__ . '/Aws/data/ec2/2016-04-01/waiters-2.json.php',

    'Aws\data\ec2\2016-04-01\paginators-1.json' => __DIR__ . '/Aws/data/ec2/2016-04-01/paginators-1.json.php',

    'Aws\data\ec2\2016-09-15\api-2.json' => __DIR__ . '/Aws/data/ec2/2016-09-15/api-2.json.php',

    'Aws\data\ec2\2016-09-15\waiters-2.json' => __DIR__ . '/Aws/data/ec2/2016-09-15/waiters-2.json.php',

    'Aws\data\ec2\2016-09-15\paginators-1.json' => __DIR__ . '/Aws/data/ec2/2016-09-15/paginators-1.json.php',

    'Aws\data\ec2\2016-09-15\waiters-1.json' => __DIR__ . '/Aws/data/ec2/2016-09-15/waiters-1.json.php',

    'Aws\data\ec2\2015-10-01\api-2.json' => __DIR__ . '/Aws/data/ec2/2015-10-01/api-2.json.php',

    'Aws\data\ec2\2015-10-01\waiters-2.json' => __DIR__ . '/Aws/data/ec2/2015-10-01/waiters-2.json.php',

    'Aws\data\ec2\2015-10-01\paginators-1.json' => __DIR__ . '/Aws/data/ec2/2015-10-01/paginators-1.json.php',

    'Aws\data\ec2\2015-10-01\waiters-1.json' => __DIR__ . '/Aws/data/ec2/2015-10-01/waiters-1.json.php',

    'Aws\data\ec2\2016-11-15\api-2.json' => __DIR__ . '/Aws/data/ec2/2016-11-15/api-2.json.php',

    'Aws\data\ec2\2016-11-15\smoke.json' => __DIR__ . '/Aws/data/ec2/2016-11-15/smoke.json.php',

    'Aws\data\ec2\2016-11-15\waiters-2.json' => __DIR__ . '/Aws/data/ec2/2016-11-15/waiters-2.json.php',

    'Aws\data\ec2\2016-11-15\paginators-1.json' => __DIR__ . '/Aws/data/ec2/2016-11-15/paginators-1.json.php',

    'Aws\data\ec2\2016-11-15\waiters-1.json' => __DIR__ . '/Aws/data/ec2/2016-11-15/waiters-1.json.php',

    'Aws\data\medialive\2017-10-14\api-2.json' => __DIR__ . '/Aws/data/medialive/2017-10-14/api-2.json.php',

    'Aws\data\medialive\2017-10-14\paginators-1.json' => __DIR__ . '/Aws/data/medialive/2017-10-14/paginators-1.json.php',

    'Aws\data\kinesisanalyticsv2\2018-05-23\api-2.json' => __DIR__ . '/Aws/data/kinesisanalyticsv2/2018-05-23/api-2.json.php',

    'Aws\data\kinesisanalyticsv2\2018-05-23\paginators-1.json' => __DIR__ . '/Aws/data/kinesisanalyticsv2/2018-05-23/paginators-1.json.php',

    'Aws\data\rds\2014-10-31\api-2.json' => __DIR__ . '/Aws/data/rds/2014-10-31/api-2.json.php',

    'Aws\data\rds\2014-10-31\smoke.json' => __DIR__ . '/Aws/data/rds/2014-10-31/smoke.json.php',

    'Aws\data\rds\2014-10-31\waiters-2.json' => __DIR__ . '/Aws/data/rds/2014-10-31/waiters-2.json.php',

    'Aws\data\rds\2014-10-31\paginators-1.json' => __DIR__ . '/Aws/data/rds/2014-10-31/paginators-1.json.php',

    'Aws\data\rds\2014-10-31\waiters-1.json' => __DIR__ . '/Aws/data/rds/2014-10-31/waiters-1.json.php',

    'Aws\data\rds\2014-09-01\api-2.json' => __DIR__ . '/Aws/data/rds/2014-09-01/api-2.json.php',

    'Aws\data\rds\2014-09-01\smoke.json' => __DIR__ . '/Aws/data/rds/2014-09-01/smoke.json.php',

    'Aws\data\rds\2014-09-01\paginators-1.json' => __DIR__ . '/Aws/data/rds/2014-09-01/paginators-1.json.php',

    'Aws\data\route53\2013-04-01\api-2.json' => __DIR__ . '/Aws/data/route53/2013-04-01/api-2.json.php',

    'Aws\data\route53\2013-04-01\smoke.json' => __DIR__ . '/Aws/data/route53/2013-04-01/smoke.json.php',

    'Aws\data\route53\2013-04-01\waiters-2.json' => __DIR__ . '/Aws/data/route53/2013-04-01/waiters-2.json.php',

    'Aws\data\route53\2013-04-01\paginators-1.json' => __DIR__ . '/Aws/data/route53/2013-04-01/paginators-1.json.php',

    'Aws\data\devicefarm\2015-06-23\api-2.json' => __DIR__ . '/Aws/data/devicefarm/2015-06-23/api-2.json.php',

    'Aws\data\devicefarm\2015-06-23\smoke.json' => __DIR__ . '/Aws/data/devicefarm/2015-06-23/smoke.json.php',

    'Aws\data\devicefarm\2015-06-23\paginators-1.json' => __DIR__ . '/Aws/data/devicefarm/2015-06-23/paginators-1.json.php',

    'Aws\data\iot\2015-05-28\api-2.json' => __DIR__ . '/Aws/data/iot/2015-05-28/api-2.json.php',

    'Aws\data\iot\2015-05-28\smoke.json' => __DIR__ . '/Aws/data/iot/2015-05-28/smoke.json.php',

    'Aws\data\iot\2015-05-28\paginators-1.json' => __DIR__ . '/Aws/data/iot/2015-05-28/paginators-1.json.php',

    'Aws\data\signer\2017-08-25\api-2.json' => __DIR__ . '/Aws/data/signer/2017-08-25/api-2.json.php',

    'Aws\data\signer\2017-08-25\waiters-2.json' => __DIR__ . '/Aws/data/signer/2017-08-25/waiters-2.json.php',

    'Aws\data\signer\2017-08-25\paginators-1.json' => __DIR__ . '/Aws/data/signer/2017-08-25/paginators-1.json.php',

    'Aws\data\directconnect\2012-10-25\api-2.json' => __DIR__ . '/Aws/data/directconnect/2012-10-25/api-2.json.php',

    'Aws\data\directconnect\2012-10-25\smoke.json' => __DIR__ . '/Aws/data/directconnect/2012-10-25/smoke.json.php',

    'Aws\data\directconnect\2012-10-25\paginators-1.json' => __DIR__ . '/Aws/data/directconnect/2012-10-25/paginators-1.json.php',

    'Aws\data\route53resolver\2018-04-01\api-2.json' => __DIR__ . '/Aws/data/route53resolver/2018-04-01/api-2.json.php',

    'Aws\data\route53resolver\2018-04-01\smoke.json' => __DIR__ . '/Aws/data/route53resolver/2018-04-01/smoke.json.php',

    'Aws\data\route53resolver\2018-04-01\paginators-1.json' => __DIR__ . '/Aws/data/route53resolver/2018-04-01/paginators-1.json.php',

    'Aws\data\application-autoscaling\2016-02-06\api-2.json' => __DIR__ . '/Aws/data/application-autoscaling/2016-02-06/api-2.json.php',

    'Aws\data\application-autoscaling\2016-02-06\smoke.json' => __DIR__ . '/Aws/data/application-autoscaling/2016-02-06/smoke.json.php',

    'Aws\data\application-autoscaling\2016-02-06\paginators-1.json' => __DIR__ . '/Aws/data/application-autoscaling/2016-02-06/paginators-1.json.php',

    'Aws\data\backup\2018-11-15\api-2.json' => __DIR__ . '/Aws/data/backup/2018-11-15/api-2.json.php',

    'Aws\data\backup\2018-11-15\paginators-1.json' => __DIR__ . '/Aws/data/backup/2018-11-15/paginators-1.json.php',

    'Aws\data\workdocs\2016-05-01\api-2.json' => __DIR__ . '/Aws/data/workdocs/2016-05-01/api-2.json.php',

    'Aws\data\workdocs\2016-05-01\paginators-1.json' => __DIR__ . '/Aws/data/workdocs/2016-05-01/paginators-1.json.php',

    'Aws\data\cognito-idp\2016-04-18\api-2.json' => __DIR__ . '/Aws/data/cognito-idp/2016-04-18/api-2.json.php',

    'Aws\data\cognito-idp\2016-04-18\smoke.json' => __DIR__ . '/Aws/data/cognito-idp/2016-04-18/smoke.json.php',

    'Aws\data\cognito-idp\2016-04-18\paginators-1.json' => __DIR__ . '/Aws/data/cognito-idp/2016-04-18/paginators-1.json.php',

    'Aws\data\appstream\2016-12-01\api-2.json' => __DIR__ . '/Aws/data/appstream/2016-12-01/api-2.json.php',

    'Aws\data\appstream\2016-12-01\smoke.json' => __DIR__ . '/Aws/data/appstream/2016-12-01/smoke.json.php',

    'Aws\data\appstream\2016-12-01\waiters-2.json' => __DIR__ . '/Aws/data/appstream/2016-12-01/waiters-2.json.php',

    'Aws\data\appstream\2016-12-01\paginators-1.json' => __DIR__ . '/Aws/data/appstream/2016-12-01/paginators-1.json.php',

    'Aws\data\support\2013-04-15\api-2.json' => __DIR__ . '/Aws/data/support/2013-04-15/api-2.json.php',

    'Aws\data\support\2013-04-15\paginators-1.json' => __DIR__ . '/Aws/data/support/2013-04-15/paginators-1.json.php',

    'Aws\data\ce\2017-10-25\api-2.json' => __DIR__ . '/Aws/data/ce/2017-10-25/api-2.json.php',

    'Aws\data\ce\2017-10-25\paginators-1.json' => __DIR__ . '/Aws/data/ce/2017-10-25/paginators-1.json.php',

    'Aws\data\lightsail\2016-11-28\api-2.json' => __DIR__ . '/Aws/data/lightsail/2016-11-28/api-2.json.php',

    'Aws\data\lightsail\2016-11-28\smoke.json' => __DIR__ . '/Aws/data/lightsail/2016-11-28/smoke.json.php',

    'Aws\data\lightsail\2016-11-28\paginators-1.json' => __DIR__ . '/Aws/data/lightsail/2016-11-28/paginators-1.json.php',

    'Aws\data\firehose\2015-08-04\api-2.json' => __DIR__ . '/Aws/data/firehose/2015-08-04/api-2.json.php',

    'Aws\data\firehose\2015-08-04\smoke.json' => __DIR__ . '/Aws/data/firehose/2015-08-04/smoke.json.php',

    'Aws\data\firehose\2015-08-04\paginators-1.json' => __DIR__ . '/Aws/data/firehose/2015-08-04/paginators-1.json.php',

    'Aws\data\mediaconvert\2017-08-29\api-2.json' => __DIR__ . '/Aws/data/mediaconvert/2017-08-29/api-2.json.php',

    'Aws\data\mediaconvert\2017-08-29\paginators-1.json' => __DIR__ . '/Aws/data/mediaconvert/2017-08-29/paginators-1.json.php',

    'Aws\data\docdb\2014-10-31\api-2.json' => __DIR__ . '/Aws/data/docdb/2014-10-31/api-2.json.php',

    'Aws\data\docdb\2014-10-31\smoke.json' => __DIR__ . '/Aws/data/docdb/2014-10-31/smoke.json.php',

    'Aws\data\docdb\2014-10-31\waiters-2.json' => __DIR__ . '/Aws/data/docdb/2014-10-31/waiters-2.json.php',

    'Aws\data\docdb\2014-10-31\paginators-1.json' => __DIR__ . '/Aws/data/docdb/2014-10-31/paginators-1.json.php',

    'Aws\data\comprehendmedical\2018-10-30\api-2.json' => __DIR__ . '/Aws/data/comprehendmedical/2018-10-30/api-2.json.php',

    'Aws\data\comprehendmedical\2018-10-30\paginators-1.json' => __DIR__ . '/Aws/data/comprehendmedical/2018-10-30/paginators-1.json.php',

    'Aws\data\acm-pca\2017-08-22\api-2.json' => __DIR__ . '/Aws/data/acm-pca/2017-08-22/api-2.json.php',

    'Aws\data\acm-pca\2017-08-22\waiters-2.json' => __DIR__ . '/Aws/data/acm-pca/2017-08-22/waiters-2.json.php',

    'Aws\data\acm-pca\2017-08-22\paginators-1.json' => __DIR__ . '/Aws/data/acm-pca/2017-08-22/paginators-1.json.php',

    'Aws\data\secretsmanager\2017-10-17\api-2.json' => __DIR__ . '/Aws/data/secretsmanager/2017-10-17/api-2.json.php',

    'Aws\data\secretsmanager\2017-10-17\smoke.json' => __DIR__ . '/Aws/data/secretsmanager/2017-10-17/smoke.json.php',

    'Aws\data\secretsmanager\2017-10-17\paginators-1.json' => __DIR__ . '/Aws/data/secretsmanager/2017-10-17/paginators-1.json.php',

    'Aws\data\athena\2017-05-18\api-2.json' => __DIR__ . '/Aws/data/athena/2017-05-18/api-2.json.php',

    'Aws\data\athena\2017-05-18\smoke.json' => __DIR__ . '/Aws/data/athena/2017-05-18/smoke.json.php',

    'Aws\data\athena\2017-05-18\paginators-1.json' => __DIR__ . '/Aws/data/athena/2017-05-18/paginators-1.json.php',

    'Aws\data\mq\2017-11-27\api-2.json' => __DIR__ . '/Aws/data/mq/2017-11-27/api-2.json.php',

    'Aws\data\mq\2017-11-27\paginators-1.json' => __DIR__ . '/Aws/data/mq/2017-11-27/paginators-1.json.php',

    'Aws\data\rds-data\2018-08-01\api-2.json' => __DIR__ . '/Aws/data/rds-data/2018-08-01/api-2.json.php',

    'Aws\data\rds-data\2018-08-01\paginators-1.json' => __DIR__ . '/Aws/data/rds-data/2018-08-01/paginators-1.json.php',

    'Aws\data\codedeploy\2014-10-06\api-2.json' => __DIR__ . '/Aws/data/codedeploy/2014-10-06/api-2.json.php',

    'Aws\data\codedeploy\2014-10-06\smoke.json' => __DIR__ . '/Aws/data/codedeploy/2014-10-06/smoke.json.php',

    'Aws\data\codedeploy\2014-10-06\waiters-2.json' => __DIR__ . '/Aws/data/codedeploy/2014-10-06/waiters-2.json.php',

    'Aws\data\codedeploy\2014-10-06\paginators-1.json' => __DIR__ . '/Aws/data/codedeploy/2014-10-06/paginators-1.json.php',

    'Aws\data\codedeploy\2014-10-06\waiters-1.json' => __DIR__ . '/Aws/data/codedeploy/2014-10-06/waiters-1.json.php',

    'Aws\data\workmail\2017-10-01\api-2.json' => __DIR__ . '/Aws/data/workmail/2017-10-01/api-2.json.php',

    'Aws\data\workmail\2017-10-01\paginators-1.json' => __DIR__ . '/Aws/data/workmail/2017-10-01/paginators-1.json.php',

    'Aws\data\metering.marketplace\2016-01-14\api-2.json' => __DIR__ . '/Aws/data/metering.marketplace/2016-01-14/api-2.json.php',

    'Aws\data\metering.marketplace\2016-01-14\paginators-1.json' => __DIR__ . '/Aws/data/metering.marketplace/2016-01-14/paginators-1.json.php',

    'Aws\data\dax\2017-04-19\api-2.json' => __DIR__ . '/Aws/data/dax/2017-04-19/api-2.json.php',

    'Aws\data\dax\2017-04-19\paginators-1.json' => __DIR__ . '/Aws/data/dax/2017-04-19/paginators-1.json.php',

    'Aws\data\ecr\2015-09-21\api-2.json' => __DIR__ . '/Aws/data/ecr/2015-09-21/api-2.json.php',

    'Aws\data\ecr\2015-09-21\smoke.json' => __DIR__ . '/Aws/data/ecr/2015-09-21/smoke.json.php',

    'Aws\data\ecr\2015-09-21\paginators-1.json' => __DIR__ . '/Aws/data/ecr/2015-09-21/paginators-1.json.php',

    'Aws\data\endpoints_prefix_history.json' => __DIR__ . '/Aws/data/endpoints_prefix_history.json.php',

    'Aws\data\glacier\2012-06-01\api-2.json' => __DIR__ . '/Aws/data/glacier/2012-06-01/api-2.json.php',

    'Aws\data\glacier\2012-06-01\smoke.json' => __DIR__ . '/Aws/data/glacier/2012-06-01/smoke.json.php',

    'Aws\data\glacier\2012-06-01\waiters-2.json' => __DIR__ . '/Aws/data/glacier/2012-06-01/waiters-2.json.php',

    'Aws\data\glacier\2012-06-01\paginators-1.json' => __DIR__ . '/Aws/data/glacier/2012-06-01/paginators-1.json.php',

    'Aws\data\glacier\2012-06-01\waiters-1.json' => __DIR__ . '/Aws/data/glacier/2012-06-01/waiters-1.json.php',

    'Aws\data\license-manager\2018-08-01\api-2.json' => __DIR__ . '/Aws/data/license-manager/2018-08-01/api-2.json.php',

    'Aws\data\license-manager\2018-08-01\paginators-1.json' => __DIR__ . '/Aws/data/license-manager/2018-08-01/paginators-1.json.php',

    'Aws\data\ram\2018-01-04\api-2.json' => __DIR__ . '/Aws/data/ram/2018-01-04/api-2.json.php',

    'Aws\data\ram\2018-01-04\paginators-1.json' => __DIR__ . '/Aws/data/ram/2018-01-04/paginators-1.json.php',

    'Aws\data\streams.dynamodb\2012-08-10\api-2.json' => __DIR__ . '/Aws/data/streams.dynamodb/2012-08-10/api-2.json.php',

    'Aws\data\streams.dynamodb\2012-08-10\paginators-1.json' => __DIR__ . '/Aws/data/streams.dynamodb/2012-08-10/paginators-1.json.php',

    'Aws\data\elasticfilesystem\2015-02-01\api-2.json' => __DIR__ . '/Aws/data/elasticfilesystem/2015-02-01/api-2.json.php',

    'Aws\data\elasticfilesystem\2015-02-01\smoke.json' => __DIR__ . '/Aws/data/elasticfilesystem/2015-02-01/smoke.json.php',

    'Aws\data\elasticfilesystem\2015-02-01\paginators-1.json' => __DIR__ . '/Aws/data/elasticfilesystem/2015-02-01/paginators-1.json.php',

    'Aws\data\datasync\2018-11-09\api-2.json' => __DIR__ . '/Aws/data/datasync/2018-11-09/api-2.json.php',

    'Aws\data\datasync\2018-11-09\paginators-1.json' => __DIR__ . '/Aws/data/datasync/2018-11-09/paginators-1.json.php',

    'Aws\data\swf\2012-01-25\api-2.json' => __DIR__ . '/Aws/data/swf/2012-01-25/api-2.json.php',

    'Aws\data\swf\2012-01-25\paginators-1.json' => __DIR__ . '/Aws/data/swf/2012-01-25/paginators-1.json.php',

    'Aws\data\elasticloadbalancing\2012-06-01\api-2.json' => __DIR__ . '/Aws/data/elasticloadbalancing/2012-06-01/api-2.json.php',

    'Aws\data\elasticloadbalancing\2012-06-01\smoke.json' => __DIR__ . '/Aws/data/elasticloadbalancing/2012-06-01/smoke.json.php',

    'Aws\data\elasticloadbalancing\2012-06-01\waiters-2.json' => __DIR__ . '/Aws/data/elasticloadbalancing/2012-06-01/waiters-2.json.php',

    'Aws\data\elasticloadbalancing\2012-06-01\paginators-1.json' => __DIR__ . '/Aws/data/elasticloadbalancing/2012-06-01/paginators-1.json.php',

    'Aws\data\lex-models\2017-04-19\api-2.json' => __DIR__ . '/Aws/data/lex-models/2017-04-19/api-2.json.php',

    'Aws\data\lex-models\2017-04-19\paginators-1.json' => __DIR__ . '/Aws/data/lex-models/2017-04-19/paginators-1.json.php',

    'Aws\data\kms\2014-11-01\api-2.json' => __DIR__ . '/Aws/data/kms/2014-11-01/api-2.json.php',

    'Aws\data\kms\2014-11-01\smoke.json' => __DIR__ . '/Aws/data/kms/2014-11-01/smoke.json.php',

    'Aws\data\kms\2014-11-01\paginators-1.json' => __DIR__ . '/Aws/data/kms/2014-11-01/paginators-1.json.php',

    'Aws\data\amplify\2017-07-25\api-2.json' => __DIR__ . '/Aws/data/amplify/2017-07-25/api-2.json.php',

    'Aws\data\amplify\2017-07-25\paginators-1.json' => __DIR__ . '/Aws/data/amplify/2017-07-25/paginators-1.json.php',

    'Aws\data\polly\2016-06-10\api-2.json' => __DIR__ . '/Aws/data/polly/2016-06-10/api-2.json.php',

    'Aws\data\polly\2016-06-10\smoke.json' => __DIR__ . '/Aws/data/polly/2016-06-10/smoke.json.php',

    'Aws\data\polly\2016-06-10\paginators-1.json' => __DIR__ . '/Aws/data/polly/2016-06-10/paginators-1.json.php',

    'Aws\data\kinesis-video-archived-media\2017-09-30\api-2.json' => __DIR__ . '/Aws/data/kinesis-video-archived-media/2017-09-30/api-2.json.php',

    'Aws\data\kinesis-video-archived-media\2017-09-30\paginators-1.json' => __DIR__ . '/Aws/data/kinesis-video-archived-media/2017-09-30/paginators-1.json.php',

    'Aws\data\endpoints.json' => __DIR__ . '/Aws/data/endpoints.json.php',

    'Aws\data\clouddirectory\2016-05-10\api-2.json' => __DIR__ . '/Aws/data/clouddirectory/2016-05-10/api-2.json.php',

    'Aws\data\clouddirectory\2016-05-10\paginators-1.json' => __DIR__ . '/Aws/data/clouddirectory/2016-05-10/paginators-1.json.php',

    'Aws\data\clouddirectory\2017-01-11\api-2.json' => __DIR__ . '/Aws/data/clouddirectory/2017-01-11/api-2.json.php',

    'Aws\data\clouddirectory\2017-01-11\paginators-1.json' => __DIR__ . '/Aws/data/clouddirectory/2017-01-11/paginators-1.json.php',

    'Aws\data\eks\2017-11-01\api-2.json' => __DIR__ . '/Aws/data/eks/2017-11-01/api-2.json.php',

    'Aws\data\eks\2017-11-01\waiters-2.json' => __DIR__ . '/Aws/data/eks/2017-11-01/waiters-2.json.php',

    'Aws\data\eks\2017-11-01\paginators-1.json' => __DIR__ . '/Aws/data/eks/2017-11-01/paginators-1.json.php',

    'Aws\data\ds\2015-04-16\api-2.json' => __DIR__ . '/Aws/data/ds/2015-04-16/api-2.json.php',

    'Aws\data\ds\2015-04-16\smoke.json' => __DIR__ . '/Aws/data/ds/2015-04-16/smoke.json.php',

    'Aws\data\ds\2015-04-16\paginators-1.json' => __DIR__ . '/Aws/data/ds/2015-04-16/paginators-1.json.php',

    'Aws\data\quicksight\2018-04-01\api-2.json' => __DIR__ . '/Aws/data/quicksight/2018-04-01/api-2.json.php',

    'Aws\data\quicksight\2018-04-01\paginators-1.json' => __DIR__ . '/Aws/data/quicksight/2018-04-01/paginators-1.json.php',

    'Aws\data\cloudsearchdomain\2013-01-01\api-2.json' => __DIR__ . '/Aws/data/cloudsearchdomain/2013-01-01/api-2.json.php',

    'Aws\data\serverlessrepo\2017-09-08\api-2.json' => __DIR__ . '/Aws/data/serverlessrepo/2017-09-08/api-2.json.php',

    'Aws\data\serverlessrepo\2017-09-08\paginators-1.json' => __DIR__ . '/Aws/data/serverlessrepo/2017-09-08/paginators-1.json.php',

    'Aws\data\fsx\2018-03-01\api-2.json' => __DIR__ . '/Aws/data/fsx/2018-03-01/api-2.json.php',

    'Aws\data\fsx\2018-03-01\paginators-1.json' => __DIR__ . '/Aws/data/fsx/2018-03-01/paginators-1.json.php',

    'Aws\data\snowball\2016-06-30\api-2.json' => __DIR__ . '/Aws/data/snowball/2016-06-30/api-2.json.php',

    'Aws\data\snowball\2016-06-30\smoke.json' => __DIR__ . '/Aws/data/snowball/2016-06-30/smoke.json.php',

    'Aws\data\snowball\2016-06-30\paginators-1.json' => __DIR__ . '/Aws/data/snowball/2016-06-30/paginators-1.json.php',

    'Aws\data\iot1click-devices\2018-05-14\api-2.json' => __DIR__ . '/Aws/data/iot1click-devices/2018-05-14/api-2.json.php',

    'Aws\data\acm\2015-12-08\api-2.json' => __DIR__ . '/Aws/data/acm/2015-12-08/api-2.json.php',

    'Aws\data\acm\2015-12-08\smoke.json' => __DIR__ . '/Aws/data/acm/2015-12-08/smoke.json.php',

    'Aws\data\acm\2015-12-08\waiters-2.json' => __DIR__ . '/Aws/data/acm/2015-12-08/waiters-2.json.php',

    'Aws\data\acm\2015-12-08\paginators-1.json' => __DIR__ . '/Aws/data/acm/2015-12-08/paginators-1.json.php',

    'Aws\data\codestar\2017-04-19\api-2.json' => __DIR__ . '/Aws/data/codestar/2017-04-19/api-2.json.php',

    'Aws\data\codestar\2017-04-19\smoke.json' => __DIR__ . '/Aws/data/codestar/2017-04-19/smoke.json.php',

    'Aws\data\codestar\2017-04-19\paginators-1.json' => __DIR__ . '/Aws/data/codestar/2017-04-19/paginators-1.json.php',

    'Aws\data\rekognition\2016-06-27\api-2.json' => __DIR__ . '/Aws/data/rekognition/2016-06-27/api-2.json.php',

    'Aws\data\rekognition\2016-06-27\smoke.json' => __DIR__ . '/Aws/data/rekognition/2016-06-27/smoke.json.php',

    'Aws\data\rekognition\2016-06-27\paginators-1.json' => __DIR__ . '/Aws/data/rekognition/2016-06-27/paginators-1.json.php',

    'Aws\data\runtime.sagemaker\2017-05-13\api-2.json' => __DIR__ . '/Aws/data/runtime.sagemaker/2017-05-13/api-2.json.php',

    'Aws\data\runtime.sagemaker\2017-05-13\paginators-1.json' => __DIR__ . '/Aws/data/runtime.sagemaker/2017-05-13/paginators-1.json.php',

    'Aws\data\sns\2010-03-31\api-2.json' => __DIR__ . '/Aws/data/sns/2010-03-31/api-2.json.php',

    'Aws\data\sns\2010-03-31\smoke.json' => __DIR__ . '/Aws/data/sns/2010-03-31/smoke.json.php',

    'Aws\data\sns\2010-03-31\paginators-1.json' => __DIR__ . '/Aws/data/sns/2010-03-31/paginators-1.json.php',

    'Aws\data\redshift\2012-12-01\api-2.json' => __DIR__ . '/Aws/data/redshift/2012-12-01/api-2.json.php',

    'Aws\data\redshift\2012-12-01\smoke.json' => __DIR__ . '/Aws/data/redshift/2012-12-01/smoke.json.php',

    'Aws\data\redshift\2012-12-01\waiters-2.json' => __DIR__ . '/Aws/data/redshift/2012-12-01/waiters-2.json.php',

    'Aws\data\redshift\2012-12-01\paginators-1.json' => __DIR__ . '/Aws/data/redshift/2012-12-01/paginators-1.json.php',

    'Aws\data\redshift\2012-12-01\waiters-1.json' => __DIR__ . '/Aws/data/redshift/2012-12-01/waiters-1.json.php',

    'Aws\data\states\2016-11-23\api-2.json' => __DIR__ . '/Aws/data/states/2016-11-23/api-2.json.php',

    'Aws\data\states\2016-11-23\smoke.json' => __DIR__ . '/Aws/data/states/2016-11-23/smoke.json.php',

    'Aws\data\states\2016-11-23\paginators-1.json' => __DIR__ . '/Aws/data/states/2016-11-23/paginators-1.json.php',

    'Aws\data\sms\2016-10-24\api-2.json' => __DIR__ . '/Aws/data/sms/2016-10-24/api-2.json.php',

    'Aws\data\sms\2016-10-24\smoke.json' => __DIR__ . '/Aws/data/sms/2016-10-24/smoke.json.php',

    'Aws\data\sms\2016-10-24\paginators-1.json' => __DIR__ . '/Aws/data/sms/2016-10-24/paginators-1.json.php',

    'Aws\data\kinesis-video-media\2017-09-30\api-2.json' => __DIR__ . '/Aws/data/kinesis-video-media/2017-09-30/api-2.json.php',

    'Aws\data\kinesis-video-media\2017-09-30\paginators-1.json' => __DIR__ . '/Aws/data/kinesis-video-media/2017-09-30/paginators-1.json.php',

    'Aws\data\codepipeline\2015-07-09\api-2.json' => __DIR__ . '/Aws/data/codepipeline/2015-07-09/api-2.json.php',

    'Aws\data\codepipeline\2015-07-09\smoke.json' => __DIR__ . '/Aws/data/codepipeline/2015-07-09/smoke.json.php',

    'Aws\data\codepipeline\2015-07-09\paginators-1.json' => __DIR__ . '/Aws/data/codepipeline/2015-07-09/paginators-1.json.php',

    'Aws\data\cloudhsm\2014-05-30\api-2.json' => __DIR__ . '/Aws/data/cloudhsm/2014-05-30/api-2.json.php',

    'Aws\data\cloudhsm\2014-05-30\paginators-1.json' => __DIR__ . '/Aws/data/cloudhsm/2014-05-30/paginators-1.json.php',

    'Aws\data\opsworks\2013-02-18\api-2.json' => __DIR__ . '/Aws/data/opsworks/2013-02-18/api-2.json.php',

    'Aws\data\opsworks\2013-02-18\smoke.json' => __DIR__ . '/Aws/data/opsworks/2013-02-18/smoke.json.php',

    'Aws\data\opsworks\2013-02-18\waiters-2.json' => __DIR__ . '/Aws/data/opsworks/2013-02-18/waiters-2.json.php',

    'Aws\data\opsworks\2013-02-18\paginators-1.json' => __DIR__ . '/Aws/data/opsworks/2013-02-18/paginators-1.json.php',

    'Aws\data\cloudhsmv2\2017-04-28\api-2.json' => __DIR__ . '/Aws/data/cloudhsmv2/2017-04-28/api-2.json.php',

    'Aws\data\cloudhsmv2\2017-04-28\smoke.json' => __DIR__ . '/Aws/data/cloudhsmv2/2017-04-28/smoke.json.php',

    'Aws\data\cloudhsmv2\2017-04-28\paginators-1.json' => __DIR__ . '/Aws/data/cloudhsmv2/2017-04-28/paginators-1.json.php',

    'Aws\data\mediapackage\2017-10-12\api-2.json' => __DIR__ . '/Aws/data/mediapackage/2017-10-12/api-2.json.php',

    'Aws\data\mediapackage\2017-10-12\paginators-1.json' => __DIR__ . '/Aws/data/mediapackage/2017-10-12/paginators-1.json.php',

    'Aws\data\cognito-identity\2014-06-30\api-2.json' => __DIR__ . '/Aws/data/cognito-identity/2014-06-30/api-2.json.php',

    'Aws\data\cognito-identity\2014-06-30\paginators-1.json' => __DIR__ . '/Aws/data/cognito-identity/2014-06-30/paginators-1.json.php',

    'Aws\data\waf\2015-08-24\api-2.json' => __DIR__ . '/Aws/data/waf/2015-08-24/api-2.json.php',

    'Aws\data\waf\2015-08-24\smoke.json' => __DIR__ . '/Aws/data/waf/2015-08-24/smoke.json.php',

    'Aws\data\waf\2015-08-24\paginators-1.json' => __DIR__ . '/Aws/data/waf/2015-08-24/paginators-1.json.php',

    'Aws\data\mediatailor\2018-04-23\api-2.json' => __DIR__ . '/Aws/data/mediatailor/2018-04-23/api-2.json.php',

    'Aws\data\mediatailor\2018-04-23\paginators-1.json' => __DIR__ . '/Aws/data/mediatailor/2018-04-23/paginators-1.json.php',

    'Aws\data\appsync\2017-07-25\api-2.json' => __DIR__ . '/Aws/data/appsync/2017-07-25/api-2.json.php',

    'Aws\data\appsync\2017-07-25\paginators-1.json' => __DIR__ . '/Aws/data/appsync/2017-07-25/paginators-1.json.php',

    'Aws\data\cloudfront\2016-08-01\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-08-01/api-2.json.php',

    'Aws\data\cloudfront\2016-08-01\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-08-01/waiters-2.json.php',

    'Aws\data\cloudfront\2016-08-01\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2016-08-01/paginators-1.json.php',

    'Aws\data\cloudfront\2015-07-27\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2015-07-27/api-2.json.php',

    'Aws\data\cloudfront\2015-07-27\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2015-07-27/waiters-2.json.php',

    'Aws\data\cloudfront\2015-07-27\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2015-07-27/paginators-1.json.php',

    'Aws\data\cloudfront\2016-08-20\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-08-20/api-2.json.php',

    'Aws\data\cloudfront\2016-08-20\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-08-20/waiters-2.json.php',

    'Aws\data\cloudfront\2016-08-20\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2016-08-20/paginators-1.json.php',

    'Aws\data\cloudfront\2018-06-18\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2018-06-18/api-2.json.php',

    'Aws\data\cloudfront\2018-06-18\smoke.json' => __DIR__ . '/Aws/data/cloudfront/2018-06-18/smoke.json.php',

    'Aws\data\cloudfront\2018-06-18\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2018-06-18/waiters-2.json.php',

    'Aws\data\cloudfront\2018-06-18\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2018-06-18/paginators-1.json.php',

    'Aws\data\cloudfront\2018-06-18\waiters-1.json' => __DIR__ . '/Aws/data/cloudfront/2018-06-18/waiters-1.json.php',

    'Aws\data\cloudfront\2017-03-25\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2017-03-25/api-2.json.php',

    'Aws\data\cloudfront\2017-03-25\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2017-03-25/waiters-2.json.php',

    'Aws\data\cloudfront\2017-03-25\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2017-03-25/paginators-1.json.php',

    'Aws\data\cloudfront\2017-03-25\waiters-1.json' => __DIR__ . '/Aws/data/cloudfront/2017-03-25/waiters-1.json.php',

    'Aws\data\cloudfront\2018-11-05\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2018-11-05/api-2.json.php',

    'Aws\data\cloudfront\2018-11-05\smoke.json' => __DIR__ . '/Aws/data/cloudfront/2018-11-05/smoke.json.php',

    'Aws\data\cloudfront\2018-11-05\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2018-11-05/waiters-2.json.php',

    'Aws\data\cloudfront\2018-11-05\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2018-11-05/paginators-1.json.php',

    'Aws\data\cloudfront\2018-11-05\waiters-1.json' => __DIR__ . '/Aws/data/cloudfront/2018-11-05/waiters-1.json.php',

    'Aws\data\cloudfront\2017-10-30\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2017-10-30/api-2.json.php',

    'Aws\data\cloudfront\2017-10-30\smoke.json' => __DIR__ . '/Aws/data/cloudfront/2017-10-30/smoke.json.php',

    'Aws\data\cloudfront\2017-10-30\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2017-10-30/waiters-2.json.php',

    'Aws\data\cloudfront\2017-10-30\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2017-10-30/paginators-1.json.php',

    'Aws\data\cloudfront\2017-10-30\waiters-1.json' => __DIR__ . '/Aws/data/cloudfront/2017-10-30/waiters-1.json.php',

    'Aws\data\cloudfront\2016-09-07\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-09-07/api-2.json.php',

    'Aws\data\cloudfront\2016-09-07\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-09-07/waiters-2.json.php',

    'Aws\data\cloudfront\2016-09-07\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2016-09-07/paginators-1.json.php',

    'Aws\data\cloudfront\2016-09-07\waiters-1.json' => __DIR__ . '/Aws/data/cloudfront/2016-09-07/waiters-1.json.php',

    'Aws\data\cloudfront\2016-09-29\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-09-29/api-2.json.php',

    'Aws\data\cloudfront\2016-09-29\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-09-29/waiters-2.json.php',

    'Aws\data\cloudfront\2016-09-29\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2016-09-29/paginators-1.json.php',

    'Aws\data\cloudfront\2016-09-29\waiters-1.json' => __DIR__ . '/Aws/data/cloudfront/2016-09-29/waiters-1.json.php',

    'Aws\data\cloudfront\2016-11-25\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-11-25/api-2.json.php',

    'Aws\data\cloudfront\2016-11-25\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-11-25/waiters-2.json.php',

    'Aws\data\cloudfront\2016-11-25\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2016-11-25/paginators-1.json.php',

    'Aws\data\cloudfront\2016-11-25\waiters-1.json' => __DIR__ . '/Aws/data/cloudfront/2016-11-25/waiters-1.json.php',

    'Aws\data\cloudfront\2016-01-28\api-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-01-28/api-2.json.php',

    'Aws\data\cloudfront\2016-01-28\waiters-2.json' => __DIR__ . '/Aws/data/cloudfront/2016-01-28/waiters-2.json.php',

    'Aws\data\cloudfront\2016-01-28\paginators-1.json' => __DIR__ . '/Aws/data/cloudfront/2016-01-28/paginators-1.json.php',

    'Aws\data\servicediscovery\2017-03-14\api-2.json' => __DIR__ . '/Aws/data/servicediscovery/2017-03-14/api-2.json.php',

    'Aws\data\servicediscovery\2017-03-14\paginators-1.json' => __DIR__ . '/Aws/data/servicediscovery/2017-03-14/paginators-1.json.php',

    'Aws\data\sms-voice\2018-09-05\api-2.json' => __DIR__ . '/Aws/data/sms-voice/2018-09-05/api-2.json.php',

    'Aws\data\config\2014-11-12\api-2.json' => __DIR__ . '/Aws/data/config/2014-11-12/api-2.json.php',

    'Aws\data\config\2014-11-12\smoke.json' => __DIR__ . '/Aws/data/config/2014-11-12/smoke.json.php',

    'Aws\data\config\2014-11-12\paginators-1.json' => __DIR__ . '/Aws/data/config/2014-11-12/paginators-1.json.php',

    'Aws\data\globalaccelerator\2018-08-08\api-2.json' => __DIR__ . '/Aws/data/globalaccelerator/2018-08-08/api-2.json.php',

    'Aws\data\globalaccelerator\2018-08-08\paginators-1.json' => __DIR__ . '/Aws/data/globalaccelerator/2018-08-08/paginators-1.json.php',

    'Aws\data\sqs\2012-11-05\api-2.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/api-2.json.php',

    'Aws\data\sqs\2012-11-05\smoke.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/smoke.json.php',

    'Aws\data\sqs\2012-11-05\waiters-2.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/waiters-2.json.php',

    'Aws\data\sqs\2012-11-05\paginators-1.json' => __DIR__ . '/Aws/data/sqs/2012-11-05/paginators-1.json.php',

    'Aws\data\fms\2018-01-01\api-2.json' => __DIR__ . '/Aws/data/fms/2018-01-01/api-2.json.php',

    'Aws\data\fms\2018-01-01\paginators-1.json' => __DIR__ . '/Aws/data/fms/2018-01-01/paginators-1.json.php',

    'Aws\data\s3control\2018-08-20\api-2.json' => __DIR__ . '/Aws/data/s3control/2018-08-20/api-2.json.php',

    'Aws\data\s3control\2018-08-20\paginators-1.json' => __DIR__ . '/Aws/data/s3control/2018-08-20/paginators-1.json.php',

    'Aws\Route53Resolver\Route53ResolverClient' => __DIR__ . '/Aws/Route53Resolver/Route53ResolverClient.php',

    'Aws\Route53Resolver\Exception\Route53ResolverException' => __DIR__ . '/Aws/Route53Resolver/Exception/Route53ResolverException.php',

    'Aws\DeviceFarm\DeviceFarmClient' => __DIR__ . '/Aws/DeviceFarm/DeviceFarmClient.php',

    'Aws\DeviceFarm\Exception\DeviceFarmException' => __DIR__ . '/Aws/DeviceFarm/Exception/DeviceFarmException.php',

    'Aws\Api\Shape' => __DIR__ . '/Aws/Api/Shape.php',

    'Aws\Api\TimestampShape' => __DIR__ . '/Aws/Api/TimestampShape.php',

    'Aws\Api\ApiProvider' => __DIR__ . '/Aws/Api/ApiProvider.php',

    'Aws\Api\AbstractModel' => __DIR__ . '/Aws/Api/AbstractModel.php',

    'Aws\Api\Parser\PayloadParserTrait' => __DIR__ . '/Aws/Api/Parser/PayloadParserTrait.php',

    'Aws\Api\Parser\DecodingEventStreamIterator' => __DIR__ . '/Aws/Api/Parser/DecodingEventStreamIterator.php',

    'Aws\Api\Parser\JsonRpcParser' => __DIR__ . '/Aws/Api/Parser/JsonRpcParser.php',

    'Aws\Api\Parser\AbstractParser' => __DIR__ . '/Aws/Api/Parser/AbstractParser.php',

    'Aws\Api\Parser\RestJsonParser' => __DIR__ . '/Aws/Api/Parser/RestJsonParser.php',

    'Aws\Api\Parser\QueryParser' => __DIR__ . '/Aws/Api/Parser/QueryParser.php',

    'Aws\Api\Parser\XmlParser' => __DIR__ . '/Aws/Api/Parser/XmlParser.php',

    'Aws\Api\Parser\Exception\ParserException' => __DIR__ . '/Aws/Api/Parser/Exception/ParserException.php',

    'Aws\Api\Parser\AbstractRestParser' => __DIR__ . '/Aws/Api/Parser/AbstractRestParser.php',

    'Aws\Api\Parser\JsonParser' => __DIR__ . '/Aws/Api/Parser/JsonParser.php',

    'Aws\Api\Parser\EventParsingIterator' => __DIR__ . '/Aws/Api/Parser/EventParsingIterator.php',

    'Aws\Api\Parser\Crc32ValidatingParser' => __DIR__ . '/Aws/Api/Parser/Crc32ValidatingParser.php',

    'Aws\Api\Parser\RestXmlParser' => __DIR__ . '/Aws/Api/Parser/RestXmlParser.php',

    'Aws\Api\MapShape' => __DIR__ . '/Aws/Api/MapShape.php',

    'Aws\Api\Validator' => __DIR__ . '/Aws/Api/Validator.php',

    'Aws\Api\ShapeMap' => __DIR__ . '/Aws/Api/ShapeMap.php',

    'Aws\Api\DateTimeResult' => __DIR__ . '/Aws/Api/DateTimeResult.php',

    'Aws\Api\Serializer\RestSerializer' => __DIR__ . '/Aws/Api/Serializer/RestSerializer.php',

    'Aws\Api\Serializer\JsonBody' => __DIR__ . '/Aws/Api/Serializer/JsonBody.php',

    'Aws\Api\Serializer\QuerySerializer' => __DIR__ . '/Aws/Api/Serializer/QuerySerializer.php',

    'Aws\Api\Serializer\RestXmlSerializer' => __DIR__ . '/Aws/Api/Serializer/RestXmlSerializer.php',

    'Aws\Api\Serializer\JsonRpcSerializer' => __DIR__ . '/Aws/Api/Serializer/JsonRpcSerializer.php',

    'Aws\Api\Serializer\XmlBody' => __DIR__ . '/Aws/Api/Serializer/XmlBody.php',

    'Aws\Api\Serializer\QueryParamBuilder' => __DIR__ . '/Aws/Api/Serializer/QueryParamBuilder.php',

    'Aws\Api\Serializer\Ec2ParamBuilder' => __DIR__ . '/Aws/Api/Serializer/Ec2ParamBuilder.php',

    'Aws\Api\Serializer\RestJsonSerializer' => __DIR__ . '/Aws/Api/Serializer/RestJsonSerializer.php',

    'Aws\Api\Service' => __DIR__ . '/Aws/Api/Service.php',

    'Aws\Api\StructureShape' => __DIR__ . '/Aws/Api/StructureShape.php',

    'Aws\Api\Operation' => __DIR__ . '/Aws/Api/Operation.php',

    'Aws\Api\ErrorParser\XmlErrorParser' => __DIR__ . '/Aws/Api/ErrorParser/XmlErrorParser.php',

    'Aws\Api\ErrorParser\JsonParserTrait' => __DIR__ . '/Aws/Api/ErrorParser/JsonParserTrait.php',

    'Aws\Api\ErrorParser\JsonRpcErrorParser' => __DIR__ . '/Aws/Api/ErrorParser/JsonRpcErrorParser.php',

    'Aws\Api\ErrorParser\RestJsonErrorParser' => __DIR__ . '/Aws/Api/ErrorParser/RestJsonErrorParser.php',

    'Aws\Api\ListShape' => __DIR__ . '/Aws/Api/ListShape.php',

    'Aws\Api\DocModel' => __DIR__ . '/Aws/Api/DocModel.php',

    'Aws\MediaConnect\Exception\MediaConnectException' => __DIR__ . '/Aws/MediaConnect/Exception/MediaConnectException.php',

    'Aws\MediaConnect\MediaConnectClient' => __DIR__ . '/Aws/MediaConnect/MediaConnectClient.php',

    'Aws\MediaStore\MediaStoreClient' => __DIR__ . '/Aws/MediaStore/MediaStoreClient.php',

    'Aws\MediaStore\Exception\MediaStoreException' => __DIR__ . '/Aws/MediaStore/Exception/MediaStoreException.php',

    'Aws\QuickSight\QuickSightClient' => __DIR__ . '/Aws/QuickSight/QuickSightClient.php',

    'Aws\QuickSight\Exception\QuickSightException' => __DIR__ . '/Aws/QuickSight/Exception/QuickSightException.php',

    'Aws\S3Control\S3ControlEndpointMiddleware' => __DIR__ . '/Aws/S3Control/S3ControlEndpointMiddleware.php',

    'Aws\S3Control\Exception\S3ControlException' => __DIR__ . '/Aws/S3Control/Exception/S3ControlException.php',

    'Aws\S3Control\S3ControlClient' => __DIR__ . '/Aws/S3Control/S3ControlClient.php',

    'Aws\AwsClientInterface' => __DIR__ . '/Aws/AwsClientInterface.php',

    'Aws\IoTJobsDataPlane\IoTJobsDataPlaneClient' => __DIR__ . '/Aws/IoTJobsDataPlane/IoTJobsDataPlaneClient.php',

    'Aws\IoTJobsDataPlane\Exception\IoTJobsDataPlaneException' => __DIR__ . '/Aws/IoTJobsDataPlane/Exception/IoTJobsDataPlaneException.php',

    'Aws\Sms\SmsClient' => __DIR__ . '/Aws/Sms/SmsClient.php',

    'Aws\Sms\Exception\SmsException' => __DIR__ . '/Aws/Sms/Exception/SmsException.php',

    'Aws\RetryMiddleware' => __DIR__ . '/Aws/RetryMiddleware.php',

    'Aws\ElasticLoadBalancingV2\Exception\ElasticLoadBalancingV2Exception' => __DIR__ . '/Aws/ElasticLoadBalancingV2/Exception/ElasticLoadBalancingV2Exception.php',

    'Aws\ElasticLoadBalancingV2\ElasticLoadBalancingV2Client' => __DIR__ . '/Aws/ElasticLoadBalancingV2/ElasticLoadBalancingV2Client.php',

    'Aws\CloudHSMV2\CloudHSMV2Client' => __DIR__ . '/Aws/CloudHSMV2/CloudHSMV2Client.php',

    'Aws\CloudHSMV2\Exception\CloudHSMV2Exception' => __DIR__ . '/Aws/CloudHSMV2/Exception/CloudHSMV2Exception.php',

    'Aws\DataPipeline\Exception\DataPipelineException' => __DIR__ . '/Aws/DataPipeline/Exception/DataPipelineException.php',

    'Aws\DataPipeline\DataPipelineClient' => __DIR__ . '/Aws/DataPipeline/DataPipelineClient.php',

    'Aws\ServiceCatalog\ServiceCatalogClient' => __DIR__ . '/Aws/ServiceCatalog/ServiceCatalogClient.php',

    'Aws\ServiceCatalog\Exception\ServiceCatalogException' => __DIR__ . '/Aws/ServiceCatalog/Exception/ServiceCatalogException.php',

    'Aws\ElasticTranscoder\ElasticTranscoderClient' => __DIR__ . '/Aws/ElasticTranscoder/ElasticTranscoderClient.php',

    'Aws\ElasticTranscoder\Exception\ElasticTranscoderException' => __DIR__ . '/Aws/ElasticTranscoder/Exception/ElasticTranscoderException.php',

    'Aws\Acm\Exception\AcmException' => __DIR__ . '/Aws/Acm/Exception/AcmException.php',

    'Aws\Acm\AcmClient' => __DIR__ . '/Aws/Acm/AcmClient.php',

    'Aws\MediaStoreData\MediaStoreDataClient' => __DIR__ . '/Aws/MediaStoreData/MediaStoreDataClient.php',

    'Aws\MediaStoreData\Exception\MediaStoreDataException' => __DIR__ . '/Aws/MediaStoreData/Exception/MediaStoreDataException.php',

    'Aws\Appstream\Exception\AppstreamException' => __DIR__ . '/Aws/Appstream/Exception/AppstreamException.php',

    'Aws\Appstream\AppstreamClient' => __DIR__ . '/Aws/Appstream/AppstreamClient.php',

    'Aws\Neptune\NeptuneClient' => __DIR__ . '/Aws/Neptune/NeptuneClient.php',

    'Aws\Neptune\Exception\NeptuneException' => __DIR__ . '/Aws/Neptune/Exception/NeptuneException.php',

    'Aws\PsrCacheAdapter' => __DIR__ . '/Aws/PsrCacheAdapter.php',

    'Aws\MediaConvert\MediaConvertClient' => __DIR__ . '/Aws/MediaConvert/MediaConvertClient.php',

    'Aws\MediaConvert\Exception\MediaConvertException' => __DIR__ . '/Aws/MediaConvert/Exception/MediaConvertException.php',

    'Aws\Chime\ChimeClient' => __DIR__ . '/Aws/Chime/ChimeClient.php',

    'Aws\Chime\Exception\ChimeException' => __DIR__ . '/Aws/Chime/Exception/ChimeException.php',

    'Aws\Ecr\EcrClient' => __DIR__ . '/Aws/Ecr/EcrClient.php',

    'Aws\Ecr\Exception\EcrException' => __DIR__ . '/Aws/Ecr/Exception/EcrException.php',

    'Aws\ApiGatewayV2\ApiGatewayV2Client' => __DIR__ . '/Aws/ApiGatewayV2/ApiGatewayV2Client.php',

    'Aws\ApiGatewayV2\Exception\ApiGatewayV2Exception' => __DIR__ . '/Aws/ApiGatewayV2/Exception/ApiGatewayV2Exception.php',

    'Aws\EndpointDiscovery\Configuration' => __DIR__ . '/Aws/EndpointDiscovery/Configuration.php',

    'Aws\EndpointDiscovery\Exception\ConfigurationException' => __DIR__ . '/Aws/EndpointDiscovery/Exception/ConfigurationException.php',

    'Aws\EndpointDiscovery\ConfigurationProvider' => __DIR__ . '/Aws/EndpointDiscovery/ConfigurationProvider.php',

    'Aws\EndpointDiscovery\EndpointDiscoveryMiddleware' => __DIR__ . '/Aws/EndpointDiscovery/EndpointDiscoveryMiddleware.php',

    'Aws\EndpointDiscovery\EndpointList' => __DIR__ . '/Aws/EndpointDiscovery/EndpointList.php',

    'Aws\EndpointDiscovery\ConfigurationInterface' => __DIR__ . '/Aws/EndpointDiscovery/ConfigurationInterface.php',

    'Aws\LruArrayCache' => __DIR__ . '/Aws/LruArrayCache.php',

    'Aws\MonitoringEventsInterface' => __DIR__ . '/Aws/MonitoringEventsInterface.php',

    'Aws\CloudSearchDomain\CloudSearchDomainClient' => __DIR__ . '/Aws/CloudSearchDomain/CloudSearchDomainClient.php',

    'Aws\CloudSearchDomain\Exception\CloudSearchDomainException' => __DIR__ . '/Aws/CloudSearchDomain/Exception/CloudSearchDomainException.php',

    'Aws\Redshift\Exception\RedshiftException' => __DIR__ . '/Aws/Redshift/Exception/RedshiftException.php',

    'Aws\Redshift\RedshiftClient' => __DIR__ . '/Aws/Redshift/RedshiftClient.php',

    'Aws\Handler\GuzzleV6\GuzzleHandler' => __DIR__ . '/Aws/Handler/GuzzleV6/GuzzleHandler.php',

    'Aws\Handler\GuzzleV5\PsrStream' => __DIR__ . '/Aws/Handler/GuzzleV5/PsrStream.php',

    'Aws\Handler\GuzzleV5\GuzzleHandler' => __DIR__ . '/Aws/Handler/GuzzleV5/GuzzleHandler.php',

    'Aws\Handler\GuzzleV5\GuzzleStream' => __DIR__ . '/Aws/Handler/GuzzleV5/GuzzleStream.php',

    'Aws\MigrationHub\Exception\MigrationHubException' => __DIR__ . '/Aws/MigrationHub/Exception/MigrationHubException.php',

    'Aws\MigrationHub\MigrationHubClient' => __DIR__ . '/Aws/MigrationHub/MigrationHubClient.php',

    'Aws\KinesisAnalyticsV2\KinesisAnalyticsV2Client' => __DIR__ . '/Aws/KinesisAnalyticsV2/KinesisAnalyticsV2Client.php',

    'Aws\KinesisAnalyticsV2\Exception\KinesisAnalyticsV2Exception' => __DIR__ . '/Aws/KinesisAnalyticsV2/Exception/KinesisAnalyticsV2Exception.php',

    'Aws\Health\HealthClient' => __DIR__ . '/Aws/Health/HealthClient.php',

    'Aws\Health\Exception\HealthException' => __DIR__ . '/Aws/Health/Exception/HealthException.php',

    'Aws\Budgets\BudgetsClient' => __DIR__ . '/Aws/Budgets/BudgetsClient.php',

    'Aws\Budgets\Exception\BudgetsException' => __DIR__ . '/Aws/Budgets/Exception/BudgetsException.php',

    'Aws\MarketplaceCommerceAnalytics\MarketplaceCommerceAnalyticsClient' => __DIR__ . '/Aws/MarketplaceCommerceAnalytics/MarketplaceCommerceAnalyticsClient.php',

    'Aws\MarketplaceCommerceAnalytics\Exception\MarketplaceCommerceAnalyticsException' => __DIR__ . '/Aws/MarketplaceCommerceAnalytics/Exception/MarketplaceCommerceAnalyticsException.php',

    'Aws\ElastiCache\ElastiCacheClient' => __DIR__ . '/Aws/ElastiCache/ElastiCacheClient.php',

    'Aws\ElastiCache\Exception\ElastiCacheException' => __DIR__ . '/Aws/ElastiCache/Exception/ElastiCacheException.php',

    'Aws\DataSync\DataSyncClient' => __DIR__ . '/Aws/DataSync/DataSyncClient.php',

    'Aws\DataSync\Exception\DataSyncException' => __DIR__ . '/Aws/DataSync/Exception/DataSyncException.php',

    'Aws\HashingStream' => __DIR__ . '/Aws/HashingStream.php',

    'Aws\AppSync\Exception\AppSyncException' => __DIR__ . '/Aws/AppSync/Exception/AppSyncException.php',

    'Aws\AppSync\AppSyncClient' => __DIR__ . '/Aws/AppSync/AppSyncClient.php',

    'Aws\Amplify\Exception\AmplifyException' => __DIR__ . '/Aws/Amplify/Exception/AmplifyException.php',

    'Aws\Amplify\AmplifyClient' => __DIR__ . '/Aws/Amplify/AmplifyClient.php',

    'Aws\CloudFormation\CloudFormationClient' => __DIR__ . '/Aws/CloudFormation/CloudFormationClient.php',

    'Aws\CloudFormation\Exception\CloudFormationException' => __DIR__ . '/Aws/CloudFormation/Exception/CloudFormationException.php',

    'Aws\Efs\EfsClient' => __DIR__ . '/Aws/Efs/EfsClient.php',

    'Aws\Efs\Exception\EfsException' => __DIR__ . '/Aws/Efs/Exception/EfsException.php',

    'Aws\TraceMiddleware' => __DIR__ . '/Aws/TraceMiddleware.php',

    'Aws\MarketplaceMetering\MarketplaceMeteringClient' => __DIR__ . '/Aws/MarketplaceMetering/MarketplaceMeteringClient.php',

    'Aws\MarketplaceMetering\Exception\MarketplaceMeteringException' => __DIR__ . '/Aws/MarketplaceMetering/Exception/MarketplaceMeteringException.php',

    'Aws\Comprehend\Exception\ComprehendException' => __DIR__ . '/Aws/Comprehend/Exception/ComprehendException.php',

    'Aws\Comprehend\ComprehendClient' => __DIR__ . '/Aws/Comprehend/ComprehendClient.php',

    'Aws\CloudWatch\Exception\CloudWatchException' => __DIR__ . '/Aws/CloudWatch/Exception/CloudWatchException.php',

    'Aws\CloudWatch\CloudWatchClient' => __DIR__ . '/Aws/CloudWatch/CloudWatchClient.php',

    'Aws\StorageGateway\Exception\StorageGatewayException' => __DIR__ . '/Aws/StorageGateway/Exception/StorageGatewayException.php',

    'Aws\StorageGateway\StorageGatewayClient' => __DIR__ . '/Aws/StorageGateway/StorageGatewayClient.php',

    'Aws\Emr\EmrClient' => __DIR__ . '/Aws/Emr/EmrClient.php',

    'Aws\Emr\Exception\EmrException' => __DIR__ . '/Aws/Emr/Exception/EmrException.php',

    'Aws\Sfn\Exception\SfnException' => __DIR__ . '/Aws/Sfn/Exception/SfnException.php',

    'Aws\Sfn\SfnClient' => __DIR__ . '/Aws/Sfn/SfnClient.php',

    'Aws\Middleware' => __DIR__ . '/Aws/Middleware.php',

    'Aws\RAM\RAMClient' => __DIR__ . '/Aws/RAM/RAMClient.php',

    'Aws\RAM\Exception\RAMException' => __DIR__ . '/Aws/RAM/Exception/RAMException.php',

    'Aws\Shield\ShieldClient' => __DIR__ . '/Aws/Shield/ShieldClient.php',

    'Aws\Shield\Exception\ShieldException' => __DIR__ . '/Aws/Shield/Exception/ShieldException.php',

    'Aws\GameLift\GameLiftClient' => __DIR__ . '/Aws/GameLift/GameLiftClient.php',

    'Aws\GameLift\Exception\GameLiftException' => __DIR__ . '/Aws/GameLift/Exception/GameLiftException.php',

    'Aws\PinpointEmail\PinpointEmailClient' => __DIR__ . '/Aws/PinpointEmail/PinpointEmailClient.php',

    'Aws\PinpointEmail\Exception\PinpointEmailException' => __DIR__ . '/Aws/PinpointEmail/Exception/PinpointEmailException.php',

    'Aws\Sdk' => __DIR__ . '/Aws/Sdk.php',

    'Aws\CodeDeploy\Exception\CodeDeployException' => __DIR__ . '/Aws/CodeDeploy/Exception/CodeDeployException.php',

    'Aws\CodeDeploy\CodeDeployClient' => __DIR__ . '/Aws/CodeDeploy/CodeDeployClient.php',

    'Aws\AwsClient' => __DIR__ . '/Aws/AwsClient.php',

    'Aws\FMS\Exception\FMSException' => __DIR__ . '/Aws/FMS/Exception/FMSException.php',

    'Aws\FMS\FMSClient' => __DIR__ . '/Aws/FMS/FMSClient.php',

    'Aws\SecurityHub\SecurityHubClient' => __DIR__ . '/Aws/SecurityHub/SecurityHubClient.php',

    'Aws\SecurityHub\Exception\SecurityHubException' => __DIR__ . '/Aws/SecurityHub/Exception/SecurityHubException.php',

    'Aws\Crypto\MaterialsProvider' => __DIR__ . '/Aws/Crypto/MaterialsProvider.php',

    'Aws\Crypto\AbstractCryptoClient' => __DIR__ . '/Aws/Crypto/AbstractCryptoClient.php',

    'Aws\Crypto\KmsMaterialsProvider' => __DIR__ . '/Aws/Crypto/KmsMaterialsProvider.php',

    'Aws\Crypto\AesStreamInterface' => __DIR__ . '/Aws/Crypto/AesStreamInterface.php',

    'Aws\Crypto\Cipher\Cbc' => __DIR__ . '/Aws/Crypto/Cipher/Cbc.php',

    'Aws\Crypto\Cipher\CipherBuilderTrait' => __DIR__ . '/Aws/Crypto/Cipher/CipherBuilderTrait.php',

    'Aws\Crypto\Cipher\CipherMethod' => __DIR__ . '/Aws/Crypto/Cipher/CipherMethod.php',

    'Aws\Crypto\DecryptionTrait' => __DIR__ . '/Aws/Crypto/DecryptionTrait.php',

    'Aws\Crypto\AesEncryptingStream' => __DIR__ . '/Aws/Crypto/AesEncryptingStream.php',

    'Aws\Crypto\MetadataStrategyInterface' => __DIR__ . '/Aws/Crypto/MetadataStrategyInterface.php',

    'Aws\Crypto\MetadataEnvelope' => __DIR__ . '/Aws/Crypto/MetadataEnvelope.php',

    'Aws\Crypto\AesGcmEncryptingStream' => __DIR__ . '/Aws/Crypto/AesGcmEncryptingStream.php',

    'Aws\Crypto\AesGcmDecryptingStream' => __DIR__ . '/Aws/Crypto/AesGcmDecryptingStream.php',

    'Aws\Crypto\AesDecryptingStream' => __DIR__ . '/Aws/Crypto/AesDecryptingStream.php',

    'Aws\Crypto\EncryptionTrait' => __DIR__ . '/Aws/Crypto/EncryptionTrait.php',

    'Aws\ResultPaginator' => __DIR__ . '/Aws/ResultPaginator.php',

    'Aws\ClientResolver' => __DIR__ . '/Aws/ClientResolver.php',

    'Aws\CommandPool' => __DIR__ . '/Aws/CommandPool.php',

    'Aws\DatabaseMigrationService\DatabaseMigrationServiceClient' => __DIR__ . '/Aws/DatabaseMigrationService/DatabaseMigrationServiceClient.php',

    'Aws\DatabaseMigrationService\Exception\DatabaseMigrationServiceException' => __DIR__ . '/Aws/DatabaseMigrationService/Exception/DatabaseMigrationServiceException.php',

    'Aws\S3\ApplyChecksumMiddleware' => __DIR__ . '/Aws/S3/ApplyChecksumMiddleware.php',

    'Aws\S3\MultipartUploader' => __DIR__ . '/Aws/S3/MultipartUploader.php',

    'Aws\S3\SSECMiddleware' => __DIR__ . '/Aws/S3/SSECMiddleware.php',

    'Aws\S3\RetryableMalformedResponseParser' => __DIR__ . '/Aws/S3/RetryableMalformedResponseParser.php',

    'Aws\S3\S3ClientTrait' => __DIR__ . '/Aws/S3/S3ClientTrait.php',

    'Aws\S3\PostObjectV4' => __DIR__ . '/Aws/S3/PostObjectV4.php',

    'Aws\S3\MultipartUploadingTrait' => __DIR__ . '/Aws/S3/MultipartUploadingTrait.php',

    'Aws\S3\GetBucketLocationParser' => __DIR__ . '/Aws/S3/GetBucketLocationParser.php',

    'Aws\S3\S3Client' => __DIR__ . '/Aws/S3/S3Client.php',

    'Aws\S3\ObjectCopier' => __DIR__ . '/Aws/S3/ObjectCopier.php',

    'Aws\S3\Crypto\S3EncryptionClient' => __DIR__ . '/Aws/S3/Crypto/S3EncryptionClient.php',

    'Aws\S3\Crypto\S3EncryptionMultipartUploader' => __DIR__ . '/Aws/S3/Crypto/S3EncryptionMultipartUploader.php',

    'Aws\S3\Crypto\CryptoParamsTrait' => __DIR__ . '/Aws/S3/Crypto/CryptoParamsTrait.php',

    'Aws\S3\Crypto\InstructionFileMetadataStrategy' => __DIR__ . '/Aws/S3/Crypto/InstructionFileMetadataStrategy.php',

    'Aws\S3\Crypto\HeadersMetadataStrategy' => __DIR__ . '/Aws/S3/Crypto/HeadersMetadataStrategy.php',

    'Aws\S3\ObjectUploader' => __DIR__ . '/Aws/S3/ObjectUploader.php',

    'Aws\S3\PermanentRedirectMiddleware' => __DIR__ . '/Aws/S3/PermanentRedirectMiddleware.php',

    'Aws\S3\StreamWrapper' => __DIR__ . '/Aws/S3/StreamWrapper.php',

    'Aws\S3\BatchDelete' => __DIR__ . '/Aws/S3/BatchDelete.php',

    'Aws\S3\S3EndpointMiddleware' => __DIR__ . '/Aws/S3/S3EndpointMiddleware.php',

    'Aws\S3\S3ClientInterface' => __DIR__ . '/Aws/S3/S3ClientInterface.php',

    'Aws\S3\Exception\PermanentRedirectException' => __DIR__ . '/Aws/S3/Exception/PermanentRedirectException.php',

    'Aws\S3\Exception\DeleteMultipleObjectsException' => __DIR__ . '/Aws/S3/Exception/DeleteMultipleObjectsException.php',

    'Aws\S3\Exception\S3Exception' => __DIR__ . '/Aws/S3/Exception/S3Exception.php',

    'Aws\S3\Exception\S3MultipartUploadException' => __DIR__ . '/Aws/S3/Exception/S3MultipartUploadException.php',

    'Aws\S3\MultipartCopy' => __DIR__ . '/Aws/S3/MultipartCopy.php',

    'Aws\S3\S3MultiRegionClient' => __DIR__ . '/Aws/S3/S3MultiRegionClient.php',

    'Aws\S3\AmbiguousSuccessParser' => __DIR__ . '/Aws/S3/AmbiguousSuccessParser.php',

    'Aws\S3\BucketEndpointMiddleware' => __DIR__ . '/Aws/S3/BucketEndpointMiddleware.php',

    'Aws\S3\S3UriParser' => __DIR__ . '/Aws/S3/S3UriParser.php',

    'Aws\S3\PutObjectUrlMiddleware' => __DIR__ . '/Aws/S3/PutObjectUrlMiddleware.php',

    'Aws\S3\PostObject' => __DIR__ . '/Aws/S3/PostObject.php',

    'Aws\S3\Transfer' => __DIR__ . '/Aws/S3/Transfer.php',

    'Aws\XRay\Exception\XRayException' => __DIR__ . '/Aws/XRay/Exception/XRayException.php',

    'Aws\XRay\XRayClient' => __DIR__ . '/Aws/XRay/XRayClient.php',

    'Aws\ResourceGroupsTaggingAPI\Exception\ResourceGroupsTaggingAPIException' => __DIR__ . '/Aws/ResourceGroupsTaggingAPI/Exception/ResourceGroupsTaggingAPIException.php',

    'Aws\ResourceGroupsTaggingAPI\ResourceGroupsTaggingAPIClient' => __DIR__ . '/Aws/ResourceGroupsTaggingAPI/ResourceGroupsTaggingAPIClient.php',

    'Aws\ConfigService\ConfigServiceClient' => __DIR__ . '/Aws/ConfigService/ConfigServiceClient.php',

    'Aws\ConfigService\Exception\ConfigServiceException' => __DIR__ . '/Aws/ConfigService/Exception/ConfigServiceException.php',

    'Aws\MediaTailor\MediaTailorClient' => __DIR__ . '/Aws/MediaTailor/MediaTailorClient.php',

    'Aws\MediaTailor\Exception\MediaTailorException' => __DIR__ . '/Aws/MediaTailor/Exception/MediaTailorException.php',

    'Aws\CloudHsm\Exception\CloudHsmException' => __DIR__ . '/Aws/CloudHsm/Exception/CloudHsmException.php',

    'Aws\CloudHsm\CloudHsmClient' => __DIR__ . '/Aws/CloudHsm/CloudHsmClient.php',

    'Aws\ElasticLoadBalancing\ElasticLoadBalancingClient' => __DIR__ . '/Aws/ElasticLoadBalancing/ElasticLoadBalancingClient.php',

    'Aws\ElasticLoadBalancing\Exception\ElasticLoadBalancingException' => __DIR__ . '/Aws/ElasticLoadBalancing/Exception/ElasticLoadBalancingException.php',

    'Aws\SageMakerRuntime\SageMakerRuntimeClient' => __DIR__ . '/Aws/SageMakerRuntime/SageMakerRuntimeClient.php',

    'Aws\SageMakerRuntime\Exception\SageMakerRuntimeException' => __DIR__ . '/Aws/SageMakerRuntime/Exception/SageMakerRuntimeException.php',

    'Aws\Macie\Exception\MacieException' => __DIR__ . '/Aws/Macie/Exception/MacieException.php',

    'Aws\Macie\MacieClient' => __DIR__ . '/Aws/Macie/MacieClient.php',

    'Aws\CognitoIdentity\Exception\CognitoIdentityException' => __DIR__ . '/Aws/CognitoIdentity/Exception/CognitoIdentityException.php',

    'Aws\CognitoIdentity\CognitoIdentityProvider' => __DIR__ . '/Aws/CognitoIdentity/CognitoIdentityProvider.php',

    'Aws\CognitoIdentity\CognitoIdentityClient' => __DIR__ . '/Aws/CognitoIdentity/CognitoIdentityClient.php',

    'Aws\PhpHash' => __DIR__ . '/Aws/PhpHash.php',

    'Aws\MQ\MQClient' => __DIR__ . '/Aws/MQ/MQClient.php',

    'Aws\MQ\Exception\MQException' => __DIR__ . '/Aws/MQ/Exception/MQException.php',

    'Aws\Greengrass\GreengrassClient' => __DIR__ . '/Aws/Greengrass/GreengrassClient.php',

    'Aws\Greengrass\Exception\GreengrassException' => __DIR__ . '/Aws/Greengrass/Exception/GreengrassException.php',

    'Aws\KinesisVideoArchivedMedia\KinesisVideoArchivedMediaClient' => __DIR__ . '/Aws/KinesisVideoArchivedMedia/KinesisVideoArchivedMediaClient.php',

    'Aws\KinesisVideoArchivedMedia\Exception\KinesisVideoArchivedMediaException' => __DIR__ . '/Aws/KinesisVideoArchivedMedia/Exception/KinesisVideoArchivedMediaException.php',

    'Aws\CostExplorer\Exception\CostExplorerException' => __DIR__ . '/Aws/CostExplorer/Exception/CostExplorerException.php',

    'Aws\CostExplorer\CostExplorerClient' => __DIR__ . '/Aws/CostExplorer/CostExplorerClient.php',

    'Aws\Rds\Exception\RdsException' => __DIR__ . '/Aws/Rds/Exception/RdsException.php',

    'Aws\Rds\AuthTokenGenerator' => __DIR__ . '/Aws/Rds/AuthTokenGenerator.php',

    'Aws\Rds\RdsClient' => __DIR__ . '/Aws/Rds/RdsClient.php',

    'Aws\AutoScalingPlans\Exception\AutoScalingPlansException' => __DIR__ . '/Aws/AutoScalingPlans/Exception/AutoScalingPlansException.php',

    'Aws\AutoScalingPlans\AutoScalingPlansClient' => __DIR__ . '/Aws/AutoScalingPlans/AutoScalingPlansClient.php',

    'Aws\CloudWatchEvents\CloudWatchEventsClient' => __DIR__ . '/Aws/CloudWatchEvents/CloudWatchEventsClient.php',

    'Aws\CloudWatchEvents\Exception\CloudWatchEventsException' => __DIR__ . '/Aws/CloudWatchEvents/Exception/CloudWatchEventsException.php',

    'Aws\functions' => __DIR__ . '/Aws/functions.php',

    'Aws\Ssm\SsmClient' => __DIR__ . '/Aws/Ssm/SsmClient.php',

    'Aws\Ssm\Exception\SsmException' => __DIR__ . '/Aws/Ssm/Exception/SsmException.php',

    'Aws\DocDB\DocDBClient' => __DIR__ . '/Aws/DocDB/DocDBClient.php',

    'Aws\DocDB\Exception\DocDBException' => __DIR__ . '/Aws/DocDB/Exception/DocDBException.php',

    'Aws\ApiGateway\Exception\ApiGatewayException' => __DIR__ . '/Aws/ApiGateway/Exception/ApiGatewayException.php',

    'Aws\ApiGateway\ApiGatewayClient' => __DIR__ . '/Aws/ApiGateway/ApiGatewayClient.php',

    'Aws\CloudWatchLogs\CloudWatchLogsClient' => __DIR__ . '/Aws/CloudWatchLogs/CloudWatchLogsClient.php',

    'Aws\CloudWatchLogs\Exception\CloudWatchLogsException' => __DIR__ . '/Aws/CloudWatchLogs/Exception/CloudWatchLogsException.php',

    'Aws\DynamoDbStreams\DynamoDbStreamsClient' => __DIR__ . '/Aws/DynamoDbStreams/DynamoDbStreamsClient.php',

    'Aws\DynamoDbStreams\Exception\DynamoDbStreamsException' => __DIR__ . '/Aws/DynamoDbStreams/Exception/DynamoDbStreamsException.php',

    'Aws\AlexaForBusiness\AlexaForBusinessClient' => __DIR__ . '/Aws/AlexaForBusiness/AlexaForBusinessClient.php',

    'Aws\AlexaForBusiness\Exception\AlexaForBusinessException' => __DIR__ . '/Aws/AlexaForBusiness/Exception/AlexaForBusinessException.php',

    'Aws\MediaLive\MediaLiveClient' => __DIR__ . '/Aws/MediaLive/MediaLiveClient.php',

    'Aws\MediaLive\Exception\MediaLiveException' => __DIR__ . '/Aws/MediaLive/Exception/MediaLiveException.php',

    'Aws\AwsClientTrait' => __DIR__ . '/Aws/AwsClientTrait.php',

    'Aws\Credentials\CredentialsInterface' => __DIR__ . '/Aws/Credentials/CredentialsInterface.php',

    'Aws\Credentials\CredentialProvider' => __DIR__ . '/Aws/Credentials/CredentialProvider.php',

    'Aws\Credentials\InstanceProfileProvider' => __DIR__ . '/Aws/Credentials/InstanceProfileProvider.php',

    'Aws\Credentials\AssumeRoleCredentialProvider' => __DIR__ . '/Aws/Credentials/AssumeRoleCredentialProvider.php',

    'Aws\Credentials\EcsCredentialProvider' => __DIR__ . '/Aws/Credentials/EcsCredentialProvider.php',

    'Aws\Credentials\Credentials' => __DIR__ . '/Aws/Credentials/Credentials.php',

    'Aws\HasDataTrait' => __DIR__ . '/Aws/HasDataTrait.php',

    'Aws\Iam\Exception\IamException' => __DIR__ . '/Aws/Iam/Exception/IamException.php',

    'Aws\Iam\IamClient' => __DIR__ . '/Aws/Iam/IamClient.php',

    'Aws\Command' => __DIR__ . '/Aws/Command.php',

    'Aws\Backup\Exception\BackupException' => __DIR__ . '/Aws/Backup/Exception/BackupException.php',

    'Aws\Backup\BackupClient' => __DIR__ . '/Aws/Backup/BackupClient.php',

    'Aws\IotDataPlane\IotDataPlaneClient' => __DIR__ . '/Aws/IotDataPlane/IotDataPlaneClient.php',

    'Aws\IotDataPlane\Exception\IotDataPlaneException' => __DIR__ . '/Aws/IotDataPlane/Exception/IotDataPlaneException.php',

    'Aws\CostandUsageReportService\CostandUsageReportServiceClient' => __DIR__ . '/Aws/CostandUsageReportService/CostandUsageReportServiceClient.php',

    'Aws\CostandUsageReportService\Exception\CostandUsageReportServiceException' => __DIR__ . '/Aws/CostandUsageReportService/Exception/CostandUsageReportServiceException.php',

    'Aws\DAX\DAXClient' => __DIR__ . '/Aws/DAX/DAXClient.php',

    'Aws\DAX\Exception\DAXException' => __DIR__ . '/Aws/DAX/Exception/DAXException.php',

    'Aws\Kms\KmsClient' => __DIR__ . '/Aws/Kms/KmsClient.php',

    'Aws\Kms\Exception\KmsException' => __DIR__ . '/Aws/Kms/Exception/KmsException.php',

    'Aws\WafRegional\WafRegionalClient' => __DIR__ . '/Aws/WafRegional/WafRegionalClient.php',

    'Aws\WafRegional\Exception\WafRegionalException' => __DIR__ . '/Aws/WafRegional/Exception/WafRegionalException.php',

    'Aws\DynamoDb\DynamoDbClient' => __DIR__ . '/Aws/DynamoDb/DynamoDbClient.php',

    'Aws\DynamoDb\StandardSessionConnection' => __DIR__ . '/Aws/DynamoDb/StandardSessionConnection.php',

    'Aws\DynamoDb\BinaryValue' => __DIR__ . '/Aws/DynamoDb/BinaryValue.php',

    'Aws\DynamoDb\SessionConnectionInterface' => __DIR__ . '/Aws/DynamoDb/SessionConnectionInterface.php',

    'Aws\DynamoDb\Exception\DynamoDbException' => __DIR__ . '/Aws/DynamoDb/Exception/DynamoDbException.php',

    'Aws\DynamoDb\LockingSessionConnection' => __DIR__ . '/Aws/DynamoDb/LockingSessionConnection.php',

    'Aws\DynamoDb\Marshaler' => __DIR__ . '/Aws/DynamoDb/Marshaler.php',

    'Aws\DynamoDb\WriteRequestBatch' => __DIR__ . '/Aws/DynamoDb/WriteRequestBatch.php',

    'Aws\DynamoDb\SessionHandler' => __DIR__ . '/Aws/DynamoDb/SessionHandler.php',

    'Aws\DynamoDb\SetValue' => __DIR__ . '/Aws/DynamoDb/SetValue.php',

    'Aws\DynamoDb\NumberValue' => __DIR__ . '/Aws/DynamoDb/NumberValue.php',

    'Aws\Iot\Exception\IotException' => __DIR__ . '/Aws/Iot/Exception/IotException.php',

    'Aws\Iot\IotClient' => __DIR__ . '/Aws/Iot/IotClient.php',

    'Aws\Batch\BatchClient' => __DIR__ . '/Aws/Batch/BatchClient.php',

    'Aws\Batch\Exception\BatchException' => __DIR__ . '/Aws/Batch/Exception/BatchException.php',

    'Aws\EKS\EKSClient' => __DIR__ . '/Aws/EKS/EKSClient.php',

    'Aws\EKS\Exception\EKSException' => __DIR__ . '/Aws/EKS/Exception/EKSException.php',

    'Aws\Glue\GlueClient' => __DIR__ . '/Aws/Glue/GlueClient.php',

    'Aws\Glue\Exception\GlueException' => __DIR__ . '/Aws/Glue/Exception/GlueException.php',

    'Aws\PinpointSMSVoice\PinpointSMSVoiceClient' => __DIR__ . '/Aws/PinpointSMSVoice/PinpointSMSVoiceClient.php',

    'Aws\PinpointSMSVoice\Exception\PinpointSMSVoiceException' => __DIR__ . '/Aws/PinpointSMSVoice/Exception/PinpointSMSVoiceException.php',

    'Aws\CommandInterface' => __DIR__ . '/Aws/CommandInterface.php',

    'Aws\MediaPackage\MediaPackageClient' => __DIR__ . '/Aws/MediaPackage/MediaPackageClient.php',

    'Aws\MediaPackage\Exception\MediaPackageException' => __DIR__ . '/Aws/MediaPackage/Exception/MediaPackageException.php',

    'Aws\CacheInterface' => __DIR__ . '/Aws/CacheInterface.php',

    'Aws\HasMonitoringEventsTrait' => __DIR__ . '/Aws/HasMonitoringEventsTrait.php',

    'Aws\Connect\ConnectClient' => __DIR__ . '/Aws/Connect/ConnectClient.php',

    'Aws\Connect\Exception\ConnectException' => __DIR__ . '/Aws/Connect/Exception/ConnectException.php',

    'Aws\Firehose\FirehoseClient' => __DIR__ . '/Aws/Firehose/FirehoseClient.php',

    'Aws\Firehose\Exception\FirehoseException' => __DIR__ . '/Aws/Firehose/Exception/FirehoseException.php',

    'Aws\ServerlessApplicationRepository\ServerlessApplicationRepositoryClient' => __DIR__ . '/Aws/ServerlessApplicationRepository/ServerlessApplicationRepositoryClient.php',

    'Aws\ServerlessApplicationRepository\Exception\ServerlessApplicationRepositoryException' => __DIR__ . '/Aws/ServerlessApplicationRepository/Exception/ServerlessApplicationRepositoryException.php',

    'Aws\IoT1ClickDevicesService\Exception\IoT1ClickDevicesServiceException' => __DIR__ . '/Aws/IoT1ClickDevicesService/Exception/IoT1ClickDevicesServiceException.php',

    'Aws\IoT1ClickDevicesService\IoT1ClickDevicesServiceClient' => __DIR__ . '/Aws/IoT1ClickDevicesService/IoT1ClickDevicesServiceClient.php',

    'Aws\Kinesis\Exception\KinesisException' => __DIR__ . '/Aws/Kinesis/Exception/KinesisException.php',

    'Aws\Kinesis\KinesisClient' => __DIR__ . '/Aws/Kinesis/KinesisClient.php',

    'Aws\ResourceGroups\ResourceGroupsClient' => __DIR__ . '/Aws/ResourceGroups/ResourceGroupsClient.php',

    'Aws\ResourceGroups\Exception\ResourceGroupsException' => __DIR__ . '/Aws/ResourceGroups/Exception/ResourceGroupsException.php',

    'Aws\LicenseManager\LicenseManagerClient' => __DIR__ . '/Aws/LicenseManager/LicenseManagerClient.php',

    'Aws\LicenseManager\Exception\LicenseManagerException' => __DIR__ . '/Aws/LicenseManager/Exception/LicenseManagerException.php',

    'Aws\CloudSearch\CloudSearchClient' => __DIR__ . '/Aws/CloudSearch/CloudSearchClient.php',

    'Aws\CloudSearch\Exception\CloudSearchException' => __DIR__ . '/Aws/CloudSearch/Exception/CloudSearchException.php',

    'Aws\Mobile\MobileClient' => __DIR__ . '/Aws/Mobile/MobileClient.php',

    'Aws\Mobile\Exception\MobileException' => __DIR__ . '/Aws/Mobile/Exception/MobileException.php',

    'Aws\Endpoint\EndpointProvider' => __DIR__ . '/Aws/Endpoint/EndpointProvider.php',

    'Aws\Endpoint\Partition' => __DIR__ . '/Aws/Endpoint/Partition.php',

    'Aws\Endpoint\PartitionInterface' => __DIR__ . '/Aws/Endpoint/PartitionInterface.php',

    'Aws\Endpoint\PartitionEndpointProvider' => __DIR__ . '/Aws/Endpoint/PartitionEndpointProvider.php',

    'Aws\Endpoint\PatternEndpointProvider' => __DIR__ . '/Aws/Endpoint/PatternEndpointProvider.php',

    'Aws\MTurk\MTurkClient' => __DIR__ . '/Aws/MTurk/MTurkClient.php',

    'Aws\MTurk\Exception\MTurkException' => __DIR__ . '/Aws/MTurk/Exception/MTurkException.php',

    'Aws\KinesisVideo\KinesisVideoClient' => __DIR__ . '/Aws/KinesisVideo/KinesisVideoClient.php',

    'Aws\KinesisVideo\Exception\KinesisVideoException' => __DIR__ . '/Aws/KinesisVideo/Exception/KinesisVideoException.php',

    'Aws\Sqs\Exception\SqsException' => __DIR__ . '/Aws/Sqs/Exception/SqsException.php',

    'Aws\Sqs\SqsClient' => __DIR__ . '/Aws/Sqs/SqsClient.php',

    'Aws\Waf\WafClient' => __DIR__ . '/Aws/Waf/WafClient.php',

    'Aws\Waf\Exception\WafException' => __DIR__ . '/Aws/Waf/Exception/WafException.php',

    'Aws\Ecs\EcsClient' => __DIR__ . '/Aws/Ecs/EcsClient.php',

    'Aws\Ecs\Exception\EcsException' => __DIR__ . '/Aws/Ecs/Exception/EcsException.php',

    'Aws\signer\signerClient' => __DIR__ . '/Aws/signer/signerClient.php',

    'Aws\signer\Exception\signerException' => __DIR__ . '/Aws/signer/Exception/signerException.php',

    'Aws\ApplicationAutoScaling\ApplicationAutoScalingClient' => __DIR__ . '/Aws/ApplicationAutoScaling/ApplicationAutoScalingClient.php',

    'Aws\ApplicationAutoScaling\Exception\ApplicationAutoScalingException' => __DIR__ . '/Aws/ApplicationAutoScaling/Exception/ApplicationAutoScalingException.php',

    'Aws\Cloud9\Exception\Cloud9Exception' => __DIR__ . '/Aws/Cloud9/Exception/Cloud9Exception.php',

    'Aws\Cloud9\Cloud9Client' => __DIR__ . '/Aws/Cloud9/Cloud9Client.php',

    'Aws\ImportExport\Exception\ImportExportException' => __DIR__ . '/Aws/ImportExport/Exception/ImportExportException.php',

    'Aws\ImportExport\ImportExportClient' => __DIR__ . '/Aws/ImportExport/ImportExportClient.php',

    'Aws\Rekognition\RekognitionClient' => __DIR__ . '/Aws/Rekognition/RekognitionClient.php',

    'Aws\Rekognition\Exception\RekognitionException' => __DIR__ . '/Aws/Rekognition/Exception/RekognitionException.php',

    'Aws\RDSDataService\Exception\RDSDataServiceException' => __DIR__ . '/Aws/RDSDataService/Exception/RDSDataServiceException.php',

    'Aws\RDSDataService\RDSDataServiceClient' => __DIR__ . '/Aws/RDSDataService/RDSDataServiceClient.php',

    'Aws\CodeCommit\CodeCommitClient' => __DIR__ . '/Aws/CodeCommit/CodeCommitClient.php',

    'Aws\CodeCommit\Exception\CodeCommitException' => __DIR__ . '/Aws/CodeCommit/Exception/CodeCommitException.php',

    'Aws\Inspector\Exception\InspectorException' => __DIR__ . '/Aws/Inspector/Exception/InspectorException.php',

    'Aws\Inspector\InspectorClient' => __DIR__ . '/Aws/Inspector/InspectorClient.php',

    'Aws\LexModelBuildingService\Exception\LexModelBuildingServiceException' => __DIR__ . '/Aws/LexModelBuildingService/Exception/LexModelBuildingServiceException.php',

    'Aws\LexModelBuildingService\LexModelBuildingServiceClient' => __DIR__ . '/Aws/LexModelBuildingService/LexModelBuildingServiceClient.php',

    'Aws\AppMesh\AppMeshClient' => __DIR__ . '/Aws/AppMesh/AppMeshClient.php',

    'Aws\AppMesh\Exception\AppMeshException' => __DIR__ . '/Aws/AppMesh/Exception/AppMeshException.php',

    'Aws\ResponseContainerInterface' => __DIR__ . '/Aws/ResponseContainerInterface.php',

    'Aws\Exception\UnresolvedEndpointException' => __DIR__ . '/Aws/Exception/UnresolvedEndpointException.php',

    'Aws\Exception\CredentialsException' => __DIR__ . '/Aws/Exception/CredentialsException.php',

    'Aws\Exception\UnresolvedSignatureException' => __DIR__ . '/Aws/Exception/UnresolvedSignatureException.php',

    'Aws\Exception\AwsException' => __DIR__ . '/Aws/Exception/AwsException.php',

    'Aws\Exception\MultipartUploadException' => __DIR__ . '/Aws/Exception/MultipartUploadException.php',

    'Aws\Exception\CouldNotCreateChecksumException' => __DIR__ . '/Aws/Exception/CouldNotCreateChecksumException.php',

    'Aws\Exception\UnresolvedApiException' => __DIR__ . '/Aws/Exception/UnresolvedApiException.php',

    'Aws\Exception\EventStreamDataException' => __DIR__ . '/Aws/Exception/EventStreamDataException.php',

    'Aws\WorkSpaces\WorkSpacesClient' => __DIR__ . '/Aws/WorkSpaces/WorkSpacesClient.php',

    'Aws\WorkSpaces\Exception\WorkSpacesException' => __DIR__ . '/Aws/WorkSpaces/Exception/WorkSpacesException.php',

    'Aws\ResultInterface' => __DIR__ . '/Aws/ResultInterface.php',

    'Aws\Translate\TranslateClient' => __DIR__ . '/Aws/Translate/TranslateClient.php',

    'Aws\Translate\Exception\TranslateException' => __DIR__ . '/Aws/Translate/Exception/TranslateException.php',

    'Aws\CodeBuild\Exception\CodeBuildException' => __DIR__ . '/Aws/CodeBuild/Exception/CodeBuildException.php',

    'Aws\CodeBuild\CodeBuildClient' => __DIR__ . '/Aws/CodeBuild/CodeBuildClient.php',

    'Aws\Signature\SignatureProvider' => __DIR__ . '/Aws/Signature/SignatureProvider.php',

    'Aws\Signature\SignatureInterface' => __DIR__ . '/Aws/Signature/SignatureInterface.php',

    'Aws\Signature\S3SignatureV4' => __DIR__ . '/Aws/Signature/S3SignatureV4.php',

    'Aws\Signature\SignatureV4' => __DIR__ . '/Aws/Signature/SignatureV4.php',

    'Aws\Signature\AnonymousSignature' => __DIR__ . '/Aws/Signature/AnonymousSignature.php',

    'Aws\Signature\SignatureTrait' => __DIR__ . '/Aws/Signature/SignatureTrait.php',

    'Aws\HashInterface' => __DIR__ . '/Aws/HashInterface.php',

    'Aws\SecretsManager\SecretsManagerClient' => __DIR__ . '/Aws/SecretsManager/SecretsManagerClient.php',

    'Aws\SecretsManager\Exception\SecretsManagerException' => __DIR__ . '/Aws/SecretsManager/Exception/SecretsManagerException.php',

    'Aws\ClientSideMonitoring\ApiCallMonitoringMiddleware' => __DIR__ . '/Aws/ClientSideMonitoring/ApiCallMonitoringMiddleware.php',

    'Aws\ClientSideMonitoring\ApiCallAttemptMonitoringMiddleware' => __DIR__ . '/Aws/ClientSideMonitoring/ApiCallAttemptMonitoringMiddleware.php',

    'Aws\ClientSideMonitoring\Configuration' => __DIR__ . '/Aws/ClientSideMonitoring/Configuration.php',

    'Aws\ClientSideMonitoring\Exception\ConfigurationException' => __DIR__ . '/Aws/ClientSideMonitoring/Exception/ConfigurationException.php',

    'Aws\ClientSideMonitoring\MonitoringMiddlewareInterface' => __DIR__ . '/Aws/ClientSideMonitoring/MonitoringMiddlewareInterface.php',

    'Aws\ClientSideMonitoring\AbstractMonitoringMiddleware' => __DIR__ . '/Aws/ClientSideMonitoring/AbstractMonitoringMiddleware.php',

    'Aws\ClientSideMonitoring\ConfigurationProvider' => __DIR__ . '/Aws/ClientSideMonitoring/ConfigurationProvider.php',

    'Aws\ClientSideMonitoring\ConfigurationInterface' => __DIR__ . '/Aws/ClientSideMonitoring/ConfigurationInterface.php',

    'Aws\MachineLearning\MachineLearningClient' => __DIR__ . '/Aws/MachineLearning/MachineLearningClient.php',

    'Aws\MachineLearning\Exception\MachineLearningException' => __DIR__ . '/Aws/MachineLearning/Exception/MachineLearningException.php',

    'Aws\EndpointParameterMiddleware' => __DIR__ . '/Aws/EndpointParameterMiddleware.php',

    'Aws\DirectoryService\DirectoryServiceClient' => __DIR__ . '/Aws/DirectoryService/DirectoryServiceClient.php',

    'Aws\DirectoryService\Exception\DirectoryServiceException' => __DIR__ . '/Aws/DirectoryService/Exception/DirectoryServiceException.php',

    'Aws\Multipart\UploadState' => __DIR__ . '/Aws/Multipart/UploadState.php',

    'Aws\Multipart\AbstractUploadManager' => __DIR__ . '/Aws/Multipart/AbstractUploadManager.php',

    'Aws\Multipart\AbstractUploader' => __DIR__ . '/Aws/Multipart/AbstractUploader.php',

    'Aws\SageMaker\Exception\SageMakerException' => __DIR__ . '/Aws/SageMaker/Exception/SageMakerException.php',

    'Aws\SageMaker\SageMakerClient' => __DIR__ . '/Aws/SageMaker/SageMakerClient.php',

    'Aws\IdempotencyTokenMiddleware' => __DIR__ . '/Aws/IdempotencyTokenMiddleware.php',

    'Aws\KinesisVideoMedia\Exception\KinesisVideoMediaException' => __DIR__ . '/Aws/KinesisVideoMedia/Exception/KinesisVideoMediaException.php',

    'Aws\KinesisVideoMedia\KinesisVideoMediaClient' => __DIR__ . '/Aws/KinesisVideoMedia/KinesisVideoMediaClient.php',

    'Aws\WorkDocs\Exception\WorkDocsException' => __DIR__ . '/Aws/WorkDocs/Exception/WorkDocsException.php',

    'Aws\WorkDocs\WorkDocsClient' => __DIR__ . '/Aws/WorkDocs/WorkDocsClient.php',

    'Aws\CodePipeline\Exception\CodePipelineException' => __DIR__ . '/Aws/CodePipeline/Exception/CodePipelineException.php',

    'Aws\CodePipeline\CodePipelineClient' => __DIR__ . '/Aws/CodePipeline/CodePipelineClient.php',

    'Aws\CloudDirectory\CloudDirectoryClient' => __DIR__ . '/Aws/CloudDirectory/CloudDirectoryClient.php',

    'Aws\CloudDirectory\Exception\CloudDirectoryException' => __DIR__ . '/Aws/CloudDirectory/Exception/CloudDirectoryException.php',

    'Aws\Waiter' => __DIR__ . '/Aws/Waiter.php',

    'Aws\Lightsail\LightsailClient' => __DIR__ . '/Aws/Lightsail/LightsailClient.php',

    'Aws\Lightsail\Exception\LightsailException' => __DIR__ . '/Aws/Lightsail/Exception/LightsailException.php',

    'Aws\WorkLink\WorkLinkClient' => __DIR__ . '/Aws/WorkLink/WorkLinkClient.php',

    'Aws\WorkLink\Exception\WorkLinkException' => __DIR__ . '/Aws/WorkLink/Exception/WorkLinkException.php',

    'Aws\Lambda\Exception\LambdaException' => __DIR__ . '/Aws/Lambda/Exception/LambdaException.php',

    'Aws\Lambda\LambdaClient' => __DIR__ . '/Aws/Lambda/LambdaClient.php',

    'Aws\CloudTrail\LogRecordIterator' => __DIR__ . '/Aws/CloudTrail/LogRecordIterator.php',

    'Aws\CloudTrail\CloudTrailClient' => __DIR__ . '/Aws/CloudTrail/CloudTrailClient.php',

    'Aws\CloudTrail\Exception\CloudTrailException' => __DIR__ . '/Aws/CloudTrail/Exception/CloudTrailException.php',

    'Aws\CloudTrail\LogFileIterator' => __DIR__ . '/Aws/CloudTrail/LogFileIterator.php',

    'Aws\CloudTrail\LogFileReader' => __DIR__ . '/Aws/CloudTrail/LogFileReader.php',

    'Aws\Ec2\Ec2Client' => __DIR__ . '/Aws/Ec2/Ec2Client.php',

    'Aws\Ec2\Exception\Ec2Exception' => __DIR__ . '/Aws/Ec2/Exception/Ec2Exception.php',

    'Aws\CodeStar\CodeStarClient' => __DIR__ . '/Aws/CodeStar/CodeStarClient.php',

    'Aws\CodeStar\Exception\CodeStarException' => __DIR__ . '/Aws/CodeStar/Exception/CodeStarException.php',

    'Aws\GlobalAccelerator\Exception\GlobalAcceleratorException' => __DIR__ . '/Aws/GlobalAccelerator/Exception/GlobalAcceleratorException.php',

    'Aws\GlobalAccelerator\GlobalAcceleratorClient' => __DIR__ . '/Aws/GlobalAccelerator/GlobalAcceleratorClient.php',

    'Aws\KinesisAnalytics\KinesisAnalyticsClient' => __DIR__ . '/Aws/KinesisAnalytics/KinesisAnalyticsClient.php',

    'Aws\KinesisAnalytics\Exception\KinesisAnalyticsException' => __DIR__ . '/Aws/KinesisAnalytics/Exception/KinesisAnalyticsException.php',

    'Aws\Ses\SesClient' => __DIR__ . '/Aws/Ses/SesClient.php',

    'Aws\Ses\Exception\SesException' => __DIR__ . '/Aws/Ses/Exception/SesException.php',

    'Aws\DoctrineCacheAdapter' => __DIR__ . '/Aws/DoctrineCacheAdapter.php',

    'Aws\PresignUrlMiddleware' => __DIR__ . '/Aws/PresignUrlMiddleware.php',

    'Aws\LexRuntimeService\LexRuntimeServiceClient' => __DIR__ . '/Aws/LexRuntimeService/LexRuntimeServiceClient.php',

    'Aws\LexRuntimeService\Exception\LexRuntimeServiceException' => __DIR__ . '/Aws/LexRuntimeService/Exception/LexRuntimeServiceException.php',

    'Aws\Pinpoint\PinpointClient' => __DIR__ . '/Aws/Pinpoint/PinpointClient.php',

    'Aws\Pinpoint\Exception\PinpointException' => __DIR__ . '/Aws/Pinpoint/Exception/PinpointException.php',

    'Aws\ComprehendMedical\ComprehendMedicalClient' => __DIR__ . '/Aws/ComprehendMedical/ComprehendMedicalClient.php',

    'Aws\ComprehendMedical\Exception\ComprehendMedicalException' => __DIR__ . '/Aws/ComprehendMedical/Exception/ComprehendMedicalException.php',

    'Aws\IoTAnalytics\Exception\IoTAnalyticsException' => __DIR__ . '/Aws/IoTAnalytics/Exception/IoTAnalyticsException.php',

    'Aws\IoTAnalytics\IoTAnalyticsClient' => __DIR__ . '/Aws/IoTAnalytics/IoTAnalyticsClient.php',

    'Aws\Result' => __DIR__ . '/Aws/Result.php',

    'Aws\Route53Domains\Exception\Route53DomainsException' => __DIR__ . '/Aws/Route53Domains/Exception/Route53DomainsException.php',

    'Aws\Route53Domains\Route53DomainsClient' => __DIR__ . '/Aws/Route53Domains/Route53DomainsClient.php',

    'Aws\Sts\Exception\StsException' => __DIR__ . '/Aws/Sts/Exception/StsException.php',

    'Aws\Sts\StsClient' => __DIR__ . '/Aws/Sts/StsClient.php',

    'Aws\ElasticBeanstalk\ElasticBeanstalkClient' => __DIR__ . '/Aws/ElasticBeanstalk/ElasticBeanstalkClient.php',

    'Aws\ElasticBeanstalk\Exception\ElasticBeanstalkException' => __DIR__ . '/Aws/ElasticBeanstalk/Exception/ElasticBeanstalkException.php',

    'Aws\Swf\SwfClient' => __DIR__ . '/Aws/Swf/SwfClient.php',

    'Aws\Swf\Exception\SwfException' => __DIR__ . '/Aws/Swf/Exception/SwfException.php',

    'Aws\Support\SupportClient' => __DIR__ . '/Aws/Support/SupportClient.php',

    'Aws\Support\Exception\SupportException' => __DIR__ . '/Aws/Support/Exception/SupportException.php',

    'Aws\Transfer\TransferClient' => __DIR__ . '/Aws/Transfer/TransferClient.php',

    'Aws\Transfer\Exception\TransferException' => __DIR__ . '/Aws/Transfer/Exception/TransferException.php',

    'Aws\DirectConnect\DirectConnectClient' => __DIR__ . '/Aws/DirectConnect/DirectConnectClient.php',

    'Aws\DirectConnect\Exception\DirectConnectException' => __DIR__ . '/Aws/DirectConnect/Exception/DirectConnectException.php',

    'Aws\CloudFront\CloudFrontClient' => __DIR__ . '/Aws/CloudFront/CloudFrontClient.php',

    'Aws\CloudFront\Signer' => __DIR__ . '/Aws/CloudFront/Signer.php',

    'Aws\CloudFront\CookieSigner' => __DIR__ . '/Aws/CloudFront/CookieSigner.php',

    'Aws\CloudFront\Exception\CloudFrontException' => __DIR__ . '/Aws/CloudFront/Exception/CloudFrontException.php',

    'Aws\CloudFront\UrlSigner' => __DIR__ . '/Aws/CloudFront/UrlSigner.php',

    'Aws\CognitoIdentityProvider\CognitoIdentityProviderClient' => __DIR__ . '/Aws/CognitoIdentityProvider/CognitoIdentityProviderClient.php',

    'Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException' => __DIR__ . '/Aws/CognitoIdentityProvider/Exception/CognitoIdentityProviderException.php',

    'Aws\AutoScaling\AutoScalingClient' => __DIR__ . '/Aws/AutoScaling/AutoScalingClient.php',

    'Aws\AutoScaling\Exception\AutoScalingException' => __DIR__ . '/Aws/AutoScaling/Exception/AutoScalingException.php',

    'Aws\MarketplaceEntitlementService\Exception\MarketplaceEntitlementServiceException' => __DIR__ . '/Aws/MarketplaceEntitlementService/Exception/MarketplaceEntitlementServiceException.php',

    'Aws\MarketplaceEntitlementService\MarketplaceEntitlementServiceClient' => __DIR__ . '/Aws/MarketplaceEntitlementService/MarketplaceEntitlementServiceClient.php',

    'Aws\PI\PIClient' => __DIR__ . '/Aws/PI/PIClient.php',

    'Aws\PI\Exception\PIException' => __DIR__ . '/Aws/PI/Exception/PIException.php',

    'Aws\DLM\Exception\DLMException' => __DIR__ . '/Aws/DLM/Exception/DLMException.php',

    'Aws\DLM\DLMClient' => __DIR__ . '/Aws/DLM/DLMClient.php',

    'Aws\ServiceDiscovery\ServiceDiscoveryClient' => __DIR__ . '/Aws/ServiceDiscovery/ServiceDiscoveryClient.php',

    'Aws\ServiceDiscovery\Exception\ServiceDiscoveryException' => __DIR__ . '/Aws/ServiceDiscovery/Exception/ServiceDiscoveryException.php',

    'Aws\SnowBall\SnowBallClient' => __DIR__ . '/Aws/SnowBall/SnowBallClient.php',

    'Aws\SnowBall\Exception\SnowBallException' => __DIR__ . '/Aws/SnowBall/Exception/SnowBallException.php',

    'Aws\MockHandler' => __DIR__ . '/Aws/MockHandler.php',

    'Aws\ApplicationDiscoveryService\Exception\ApplicationDiscoveryServiceException' => __DIR__ . '/Aws/ApplicationDiscoveryService/Exception/ApplicationDiscoveryServiceException.php',

    'Aws\ApplicationDiscoveryService\ApplicationDiscoveryServiceClient' => __DIR__ . '/Aws/ApplicationDiscoveryService/ApplicationDiscoveryServiceClient.php',

    'Aws\ACMPCA\Exception\ACMPCAException' => __DIR__ . '/Aws/ACMPCA/Exception/ACMPCAException.php',

    'Aws\ACMPCA\ACMPCAClient' => __DIR__ . '/Aws/ACMPCA/ACMPCAClient.php',

    'Aws\JsonCompiler' => __DIR__ . '/Aws/JsonCompiler.php',

    'Aws\IoT1ClickProjects\IoT1ClickProjectsClient' => __DIR__ . '/Aws/IoT1ClickProjects/IoT1ClickProjectsClient.php',

    'Aws\IoT1ClickProjects\Exception\IoT1ClickProjectsException' => __DIR__ . '/Aws/IoT1ClickProjects/Exception/IoT1ClickProjectsException.php',

    'Aws\OpsWorksCM\Exception\OpsWorksCMException' => __DIR__ . '/Aws/OpsWorksCM/Exception/OpsWorksCMException.php',

    'Aws\OpsWorksCM\OpsWorksCMClient' => __DIR__ . '/Aws/OpsWorksCM/OpsWorksCMClient.php',

    'Aws\FSx\Exception\FSxException' => __DIR__ . '/Aws/FSx/Exception/FSxException.php',

    'Aws\FSx\FSxClient' => __DIR__ . '/Aws/FSx/FSxClient.php',

    'Aws\Athena\AthenaClient' => __DIR__ . '/Aws/Athena/AthenaClient.php',

    'Aws\Athena\Exception\AthenaException' => __DIR__ . '/Aws/Athena/Exception/AthenaException.php',

    'Aws\Pricing\Exception\PricingException' => __DIR__ . '/Aws/Pricing/Exception/PricingException.php',

    'Aws\Pricing\PricingClient' => __DIR__ . '/Aws/Pricing/PricingClient.php',

    'Aws\Glacier\MultipartUploader' => __DIR__ . '/Aws/Glacier/MultipartUploader.php',

    'Aws\Glacier\TreeHash' => __DIR__ . '/Aws/Glacier/TreeHash.php',

    'Aws\Glacier\GlacierClient' => __DIR__ . '/Aws/Glacier/GlacierClient.php',

    'Aws\Glacier\Exception\GlacierException' => __DIR__ . '/Aws/Glacier/Exception/GlacierException.php',

    'Aws\History' => __DIR__ . '/Aws/History.php',

    'Aws\Kafka\KafkaClient' => __DIR__ . '/Aws/Kafka/KafkaClient.php',

    'Aws\Kafka\Exception\KafkaException' => __DIR__ . '/Aws/Kafka/Exception/KafkaException.php',

    'Aws\HandlerList' => __DIR__ . '/Aws/HandlerList.php',

    'Aws\WrappedHttpHandler' => __DIR__ . '/Aws/WrappedHttpHandler.php',

    'Aws\Organizations\OrganizationsClient' => __DIR__ . '/Aws/Organizations/OrganizationsClient.php',

    'Aws\Organizations\Exception\OrganizationsException' => __DIR__ . '/Aws/Organizations/Exception/OrganizationsException.php',

    'JmesPath\SyntaxErrorException' => __DIR__ . '/JmesPath/SyntaxErrorException.php',

    'JmesPath\TreeCompiler' => __DIR__ . '/JmesPath/TreeCompiler.php',

    'JmesPath\Lexer' => __DIR__ . '/JmesPath/Lexer.php',

    'JmesPath\Utils' => __DIR__ . '/JmesPath/Utils.php',

    'JmesPath\FnDispatcher' => __DIR__ . '/JmesPath/FnDispatcher.php',

    'JmesPath\Parser' => __DIR__ . '/JmesPath/Parser.php',

    'JmesPath\AstRuntime' => __DIR__ . '/JmesPath/AstRuntime.php',

    'JmesPath\CompilerRuntime' => __DIR__ . '/JmesPath/CompilerRuntime.php',

    'JmesPath\JmesPath' => __DIR__ . '/JmesPath/JmesPath.php',

    'JmesPath\DebugRuntime' => __DIR__ . '/JmesPath/DebugRuntime.php',

    'JmesPath\TreeInterpreter' => __DIR__ . '/JmesPath/TreeInterpreter.php',

    'JmesPath\Env' => __DIR__ . '/JmesPath/Env.php',

);



spl_autoload_register(function ($class) use ($mapping) {

    if (isset($mapping[$class])) {

        require $mapping[$class];

    }

}, true);



require __DIR__ . '/Aws/functions.php';

require __DIR__ . '/GuzzleHttp/functions_include.php';

require __DIR__ . '/GuzzleHttp/Psr7/functions_include.php';

require __DIR__ . '/GuzzleHttp/Promise/functions_include.php';

require __DIR__ . '/JmesPath/JmesPath.php';

