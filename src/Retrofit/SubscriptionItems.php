<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

use Stripe\Collection;
use Stripe\StripeObject;
use Stripe\SubscriptionItem;

/**
 * @template TStripeObject of StripeObject
 * @template-extends Collection<TStripeObject>
 * @property array<int, SubscriptionItem> $data
 */
class SubscriptionItems extends Collection
{
}
