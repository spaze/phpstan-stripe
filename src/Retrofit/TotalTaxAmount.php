<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

use Stripe\TaxRate;

class TotalTaxAmount
{
	public int $amount;
	public bool $inclusive;
	public string|TaxRate $tax_rate;
}
