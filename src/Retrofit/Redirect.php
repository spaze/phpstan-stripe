<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

class Redirect
{
	public string $failure_reason;
	public string $return_url;
	public string $status;
	public string $url;
}
