<?php
function trailingslashit($string)
{
	return untrailingslashit($string) . '/';
}

function untrailingslashit($string)
{
	return rtrim($string, '/\\');
}

function wp_parse_args($args, $defaults = '')
{
	if (is_object($args))
		$r = get_object_vars($args);
	elseif (is_array($args))
		$r =& $args;
	else
		wp_parse_str($args, $r);

	if (is_array($defaults))
		return array_merge($defaults, $r);
	return $r;
}

function wp_is_writable($path)
{
	if ('WIN' === strtoupper(substr(PHP_OS, 0, 3)))
		return win_is_writable($path);
	else
		return @is_writable($path);
}

function get_temp_dir()
{
	static $temp;

	$temp = ini_get('upload_tmp_dir');
	if (@is_dir($temp) && wp_is_writable($temp))
		return trailingslashit($temp);

	$temp = '/tmp/';
	return $temp;
}

function get_bloginfo($key)
{
	global $blogInfo;
	return $blogInfo[$key];
}

function __($text)
{
	return $text;
}

function is_wp_error($obj)
{
	return stripos(' ' . $obj, 'Error: ') > 0;
}

function mbstring_binary_safe_encoding($reset = false)
{
	static $encodings = array();
	static $overloaded = null;

	if (is_null($overloaded))
		$overloaded = function_exists('mb_internal_encoding') && (ini_get('mbstring.func_overload') & 2);

	if (false === $overloaded)
		return;

	if (!$reset) {
		$encoding = mb_internal_encoding();
		array_push($encodings, $encoding);
		mb_internal_encoding('ISO-8859-1');
	}

	if ($reset && $encodings) {
		$encoding = array_pop($encodings);
		mb_internal_encoding($encoding);
	}
}
function absint( $maybeint ) {
	return abs( intval( $maybeint ) );
}
function get_status_header_desc( $code ) {
	global $wp_header_to_desc;

	$code = absint( $code );

	if ( !isset( $wp_header_to_desc ) ) {
		$wp_header_to_desc = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			102 => 'Processing',

			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			207 => 'Multi-Status',
			226 => 'IM Used',

			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => 'Reserved',
			307 => 'Temporary Redirect',

			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			418 => 'I\'m a teapot',
			422 => 'Unprocessable Entity',
			423 => 'Locked',
			424 => 'Failed Dependency',
			426 => 'Upgrade Required',
			428 => 'Precondition Required',
			429 => 'Too Many Requests',
			431 => 'Request Header Fields Too Large',

			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported',
			506 => 'Variant Also Negotiates',
			507 => 'Insufficient Storage',
			510 => 'Not Extended',
			511 => 'Network Authentication Required',
		);
	}

	if ( isset( $wp_header_to_desc[$code] ) )
		return $wp_header_to_desc[$code];
	else
		return '';
}
function reset_mbstring_encoding() {
	mbstring_binary_safe_encoding( true );
}