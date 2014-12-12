<?php
/**
 *
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Tax\Api;

interface TaxRateRepositoryInterface
{
    /**
     * Create or update tax rate
     *
     * @param \Magento\Tax\Api\Data\TaxRateInterface $taxRate
     * @return \Magento\Tax\Api\Data\TaxRateInterface
     * @throws \Magento\Framework\Exception\InputException If input is invalid or required input is missing.
     * @throws \Exception If something went wrong while creating the TaxRate.
     */
    public function save(\Magento\Tax\Api\Data\TaxRateInterface $taxRate);

    /**
     * Get tax rate
     *
     * @param int $rateId
     * @return \Magento\Tax\Api\Data\TaxRateInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($rateId);

    /**
     * Delete tax rate
     *
     * @param int $rateId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException If no TaxRate with the given ID can be found.
     * @throws \Exception If something went wrong while performing the delete.
     */
    public function deleteById($rateId);

    /**
     * Search TaxRates
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Tax\Api\Data\TaxRateSearchResultsInterface containing Data\TaxRateInterface objects
     * @throws \Magento\Framework\Exception\InputException If there is a problem with the input
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete tax rate
     *
     * @param \Magento\Tax\Api\Data\TaxRateInterface $taxRate
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException If no TaxRate with the given ID can be found.
     * @throws \Exception If something went wrong while performing the delete.
     */
    public function delete(\Magento\Tax\Api\Data\TaxRateInterface $taxRate);
}
