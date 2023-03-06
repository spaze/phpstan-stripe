<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

use Stripe\StripeObject;

// https://stripe.com/docs/api/payment_methods/object#payment_method_object-card
class PaymentMethodCard
{
	/*
	 * @var 'amex'|'diners'|'discover'|'jcb'|'mastercard'|'unionpay'|'visa'|'unknown'
	 */
	public string $brand;
	public StripeObject $checks;
	public int $exp_month;
	public int $exp_year;
	public string $fingerprint;
	public string $funding;
	public StripeObject $generated_from;
	public string $last4;
	public StripeObject $three_d_secure_usage;
	public StripeObject $wallet;
}
