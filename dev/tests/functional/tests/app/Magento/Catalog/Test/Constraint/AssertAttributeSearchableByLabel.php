<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Catalog\Test\Constraint;

use Mtf\Constraint\AbstractConstraint;

/**
 * Class AssertAttributeSearchableByLabel
 */
class AssertAttributeSearchableByLabel extends AbstractConstraint
{
    /**
     * Constraint severeness
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * @return void
     */
    public function processAssert()
    {
        //
    }

    /**
     * @return string
     */
    public function toString()
    {
        //
    }
}
