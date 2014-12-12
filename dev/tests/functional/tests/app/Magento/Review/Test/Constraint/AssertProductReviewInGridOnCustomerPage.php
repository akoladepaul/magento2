<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Review\Test\Constraint;

use Magento\Customer\Test\Fixture\CustomerInjectable;
use Magento\Customer\Test\Page\Adminhtml\CustomerIndex;
use Magento\Customer\Test\Page\Adminhtml\CustomerIndexEdit;
use Magento\Review\Test\Block\Adminhtml\Product\Grid as ReviewsGrid;
use Magento\Review\Test\Fixture\ReviewInjectable;
use Mtf\Constraint\AbstractConstraint;

/**
 * Class AssertProductReviewInGridOnCustomerPage
 * Asserts all Product Review variables in the reviews grid on customer page
 */
class AssertProductReviewInGridOnCustomerPage extends AbstractConstraint
{
    /**
     * Constraint severeness
     *
     * @var string
     */
    protected $severeness = 'low';

    /**
     * Asserts all Product Review variables in the reviews grid on customer page
     *
     * @param CustomerInjectable $customer
     * @param ReviewInjectable $reviewInitial
     * @param ReviewInjectable $review
     * @param CustomerIndexEdit $customerIndexEdit
     * @param CustomerIndex $customerIndex
     * @param AssertProductReviewInGrid $assertProductReviewInGrid
     * @return void
     */
    public function processAssert(
        CustomerInjectable $customer,
        ReviewInjectable $reviewInitial,
        ReviewInjectable $review,
        CustomerIndexEdit $customerIndexEdit,
        CustomerIndex $customerIndex,
        AssertProductReviewInGrid $assertProductReviewInGrid
    ) {
        /** var CatalogProductSimple $product */
        $product = $reviewInitial->getDataFieldConfig('entity_id')['source']->getEntity();
        $customerIndex->open();
        $customerIndex->getCustomerGridBlock()->searchAndOpen(['email' => $customer->getEmail()]);
        $customerIndexEdit->getCustomerForm()->openTab('product_reviews');
        $filter = $assertProductReviewInGrid->prepareFilter($product, $this->prepareData($review, $reviewInitial));
        /** @var ReviewsGrid $reviewsGrid */
        $reviewsGrid = $customerIndexEdit->getCustomerForm()->getTabElement('product_reviews')->getReviewsGrid();
        $reviewsGrid->search($filter);
        unset($filter['visible_in']);
        \PHPUnit_Framework_Assert::assertTrue(
            $reviewsGrid->isRowVisible($filter, false),
            'Review is absent in Review grid on customer page.'
        );
    }

    /**
     * Prepare Review data
     *
     * @param ReviewInjectable $review
     * @param ReviewInjectable $reviewInitial
     * @return array
     */
    protected function prepareData(ReviewInjectable $review, ReviewInjectable $reviewInitial)
    {
        $dataReviewInitial = $reviewInitial->getData();
        $data = $review->getData();
        foreach ($dataReviewInitial as $key => $value) {
            if (!isset($data[$key])) {
                $data[$key] = $value;
            }
        }
        $data['type'] = 'Customer';
        return $data;
    }

    /**
     * Returns a string representation of the object
     *
     * @return string
     */
    public function toString()
    {
        return 'Review is present in grid on customer page.';
    }
}
