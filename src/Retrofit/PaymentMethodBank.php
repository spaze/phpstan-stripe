<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

// Documentation on Bank objects in Payment Method can be found at:
// https://docs.stripe.com/api/payment_methods/object#payment_method_object-us_bank_account

// Additional documentation here for a separate endpoint, but useful reference:
// https://docs.stripe.com/api/customer_bank_accounts/object

class PaymentMethodBank
{
	// Simple types:

	public ?string $bank_name;
	public ?string $financial_connections_account;
	public ?string $fingerprint;
	public ?string $last4;
	public ?string $routing_number;

	// Deeper StripeObjects:

	public ?PaymentMethodBank\Networks $networks;
	public ?PaymentMethodBank\StatusDetails $status_details;

	// Enum values:

	/** @var 'company'|'individual'|null */
	public ?string $account_holder_type;

	/** @var 'checking'|'savings'|null */
	public ?string $account_type;

}
