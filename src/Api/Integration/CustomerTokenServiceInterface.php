<?php

namespace Hatimeria\Reagento\Api\Integration;

use Magento\Integration\Api\CustomerTokenServiceInterface as MagentoCustomerTokenServiceInterface;

interface CustomerTokenServiceInterface extends MagentoCustomerTokenServiceInterface
{
    /**
     * Create access token for admin given the customer credentials.
     *
     * @param string $username
     * @param string $password
     * @param string $guestQuoteId
     * @return \Hatimeria\Reagento\Api\Integration\Data\CustomerTokenInterface Token created
     * @throws \Magento\Framework\Exception\AuthenticationException
     */
    public function createCustomerAccessToken($username, $password, $guestQuoteId = null);
}