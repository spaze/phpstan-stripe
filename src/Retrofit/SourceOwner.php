<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

class SourceOwner
{
	public Address|null $address;
	public string $email;
	public string $name;
	public string $phone;
	public Address|null $verified_address;
	public string $verified_email;
	public string $verified_name;
	public string $verified_phone;
}
