<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit\PaymentMethodBank;

/** @see Spaze\PHPStan\Stripe\Retrofit\PaymentMethodBank */
class Blocked
{
	/**
	 * @var 'R02'|'R03'|'R04'|'R05'|'R07'|'R08'|'R10'|'R11'|'R16'|'R20'|'R29'|'R31'|null
	 */
	public ?string $network_code;

	/**
	 * @var 'bank_account_closed'|'bank_account_frozen'|'bank_account_invalid_details'|'bank_account_restricted'|'bank_account_unusable'|'debit_not_authorized'|null
	 */
	public ?string $reason;
}
