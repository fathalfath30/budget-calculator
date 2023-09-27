<?php
/*
//
//___________ _________
// |____|| | | || |/ _|| | | ||___ \ / _ \
// | |__ __ _| |_| |____ _| | |_ __ _| |_| |____) | | | |
// |__/ _` | __| '_ \ / _` | |_/ _` | __| '_ \ |__ <| | | |
// | | | (_| | |_| | | | (_| | | || (_| | |_| | | |___) | |_| |
// |_|\__,_|\__|_| |_|\__,_|_|_| \__,_|\__|_| |_|____/ \___/
//
// Written by Fathalfath30.
// Email : fathalfath30@gmail.com
// Follow me on:
//Github : https://github.com/fathalfath30
//Gitlab : https://gitlab.com/Fathalfath30
//
*/

namespace App\Utils\Http;
class ResponseFormat {
  const HttpContinue = 100;
  const HttpSwitchingProtocols = 101;
  const HttpProcessing = 102;// RFC2518

  const HttpOk = 200;
  const HttpCreated = 201;
  const HttpAccepted = 202;
  const HttpNonAuthoritativeInformation = 203;
  const HttpNoContent = 204;
  const HttpResetContent = 205;
  const HttpPartialContent = 206;
  const HttpMultiStatus = 207;// RFC4918
  const HttpAlreadyReported = 208;// RFC5842
  const HttpImUsed = 226;// RFC3229

  const HttpMultipleChoice = 300;
  const HttpMovedPermanently = 301;
  const HttpFound = 302;
  const HttpSeeOther = 303;
  const HttpNotModified = 304;
  const HttpUseProxy = 305;
  const HttpReserved = 306;
  const HttpTemporaryRedirect = 307;
  const HttpPermanentlyRedirect = 308;// RFC7238

  const HttpBadRequest = 400;
  const HttpUnauthorized = 401;
  const HttpPaymentRequired = 402;
  const HttpForbidden = 403;
  const HttpNotFound = 404;
  const HttpMethodNotAllowed = 405;
  const HttpNotAcceptable = 406;
  const HttpProxyAuthenticationRequired = 407;
  const HttpRequestTimeout = 408;
  const HttpConflict = 409;
  const HttpGone = 410;
  const HttpLengthRequired = 411;
  const HttpPreconditionFailed = 412;
  const HttpRequestEntityTooLarge = 413;
  const HttpRequestUriTooLong = 414;
  const HttpUnsupportedMediaType = 415;
  const HttpRequestedRangeNotSatisfiable = 416;
  const HttpExpectationFailed = 417;
  const HttpIAmTeaPot = 418; // RFC2324
  const HttpMisdirectedRequest = 421; // RFC7540
  const HttpUnprocessableEntity = 422;// RFC4918
  const HttpLocked = 423;// RFC4918
  const HttpFailedDependency = 424; // RFC4918
  const HttpReservedForWebdavAdvancedCollectionExpiredProposal = 425;// RFC2817
  const HttpUpgradeRequired = 426;// RFC2817
  const HttpPreconditionRequired = 428;// RFC6585
  const HttpToManyRequests = 429; // RFC6585
  const HttpRequestHeaderFieldsTooLarge = 431; // RFC6585
  const HttpUnavailableForLegalReasons = 451;
  const HttpInternalServerError = 500;
  const HttpNotImplemented = 501;
  const HttpBadGateway = 502;
  const HttpServiceUnavailable = 503;
  const HttpGatewayTimeout = 504;
  const HttpVersionNotSupported = 505;
  const HttpVariantAlsoNegotiatesExperimental = 506;// RFC2295
  const HttpInsufficientStorage = 507;// RFC4918
  const HttpLoopDetected = 508; // RFC5842
  const HttpNotExtended = 510;// RFC2774
  const HttpNetworkAuthenticationRequired = 511; // RFC6585

  public static array $statusTexts = [
    self::HttpContinue => 'Continue',
    self::HttpSwitchingProtocols => 'Switching Protocols',
    self::HttpProcessing => 'Processing',// RFC2518
    self::HttpOk => 'OK',
    self::HttpCreated => 'Created',
    self::HttpAccepted => 'Accepted',
    self::HttpNonAuthoritativeInformation => 'Non-Authoritative Information',
    self::HttpNoContent => 'No Content',
    self::HttpResetContent => 'Reset Content',
    self::HttpPartialContent => 'Partial Content',
    self::HttpMultiStatus => 'Multi-Status',// RFC4918
    self::HttpAlreadyReported => 'Already Reported',// RFC5842
    self::HttpImUsed => 'IM Used',// RFC3229
    self::HttpMultipleChoice => 'Multiple Choices',
    self::HttpMovedPermanently => 'Moved Permanently',
    self::HttpFound => 'Found',
    self::HttpSeeOther => 'See Other',
    self::HttpNotModified => 'Not Modified',
    self::HttpUseProxy => 'Use Proxy',
    self::HttpReserved => "Reserved",
    self::HttpTemporaryRedirect => 'Temporary Redirect',
    self::HttpPermanentlyRedirect => 'Permanent Redirect',// RFC7238
    self::HttpBadRequest => 'Bad Request',
    self::HttpUnauthorized => 'Unauthorized',
    self::HttpPaymentRequired => 'Payment Required',
    self::HttpForbidden => 'Forbidden',
    self::HttpNotFound => 'Not Found',
    self::HttpMethodNotAllowed => 'Method Not Allowed',
    self::HttpNotAcceptable => 'Not Acceptable',
    self::HttpProxyAuthenticationRequired => 'Proxy Authentication Required',
    self::HttpRequestTimeout => 'Request Timeout',
    self::HttpConflict => 'Conflict',
    self::HttpGone => 'Gone',
    self::HttpLengthRequired => 'Length Required',
    self::HttpPreconditionFailed => 'Precondition Failed',
    self::HttpRequestEntityTooLarge => 'Payload Too Large',
    self::HttpRequestUriTooLong => 'URI Too Long',
    self::HttpUnsupportedMediaType => 'Unsupported Media Type',
    self::HttpRequestedRangeNotSatisfiable => 'Range Not Satisfiable',
    self::HttpExpectationFailed => 'Expectation Failed',
    self::HttpIAmTeaPot => 'I\'m a teapot', // RFC2324
    self::HttpMisdirectedRequest => 'Misdirected Request', // RFC7540
    self::HttpUnprocessableEntity => 'Unprocessable Entity',// RFC4918
    self::HttpLocked => 'Locked',// RFC4918
    self::HttpFailedDependency => 'Failed Dependency', // RFC4918
    self::HttpReservedForWebdavAdvancedCollectionExpiredProposal =>
      'Reserved for WebDAV advanced collections expired proposal', // RFC2817
    self::HttpUpgradeRequired => 'Upgrade Required',// RFC2817
    self::HttpPreconditionRequired => 'Precondition Required',// RFC6585
    self::HttpToManyRequests => 'Too Many Requests', // RFC6585
    self::HttpRequestHeaderFieldsTooLarge => 'Request Header Fields Too Large', // RFC6585
    self::HttpUnavailableForLegalReasons => 'Unavailable For Legal Reasons', // RFC7725
    self::HttpInternalServerError => 'Internal Server Error',
    self::HttpNotImplemented => 'Not Implemented',
    self::HttpBadGateway => 'Bad Gateway',
    self::HttpServiceUnavailable => 'Service Unavailable',
    self::HttpGatewayTimeout => 'Gateway Timeout',
    self::HttpVersionNotSupported => 'HTTP Version Not Supported',
    self::HttpVariantAlsoNegotiatesExperimental => 'Variant Also Negotiates', // RFC2295
    self::HttpInsufficientStorage => 'Insufficient Storage',// RFC4918
    self::HttpLoopDetected => 'Loop Detected', // RFC5842
    self::HttpNotExtended => 'Not Extended',// RFC2774
    self::HttpNetworkAuthenticationRequired => 'Network Authentication Required', // RFC6585
  ];

  public static function getHttpMessage(int $code) : string {
    return self::$statusTexts[$code] ?? "";
  }

  public static function create(int $httpCode, string $statusCode, ?string $message, $data = null) : array {
    return [
      'status' => [
        'code' => $statusCode,
        'message' => (empty($message)) ? self::getHttpMessage($httpCode) : $message
      ],
      'data' => $data
    ];
  }
}
