<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

use Stripe\StripeObject;

class EventData extends StripeObject
{
	public StripeObject $object;
	public StripeObject $previous_attributes;
}
