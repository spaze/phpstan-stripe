<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

use Stripe\StripeObject;

class PaymentIntentNextAction
{
	public StripeObject $redirect_to_url;

	/**
	 * @var 'redirect_to_url'|'use_stripe_sdk'|'alipay_handle_redirect'|'oxxo_display_details'|'verify_with_microdeposits'
	 */
	public string $type;
}
