<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

use Stripe\PaymentMethod;
use Stripe\StripeObject;

class CustomerInvoiceSettings
{
	public StripeObject $custom_fields;
	public string|PaymentMethod $default_payment_method;
	public string $footer;
	public StripeObject $rendering_options;
}
