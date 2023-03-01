<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

use Stripe\Collection;
use Stripe\StripeObject;
use Stripe\SubscriptionItem;

/**
 * @template TStripeObject of StripeObject
 * @template-extends Collection<TStripeObject>
 */
class SubscriptionItems extends Collection
{
	/**
	 * @var array<int, SubscriptionItem>
	 */
	public array $data;
}
