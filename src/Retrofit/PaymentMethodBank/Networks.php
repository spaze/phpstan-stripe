<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit\PaymentMethodBank;

/** @see Spaze\PHPStan\Stripe\Retrofit\PaymentMethodBank */
class Networks
{
	public ?string $preferred;

	/** @var array<'ach'|'us_domestic_wire'> */
	public array $supported;
}
