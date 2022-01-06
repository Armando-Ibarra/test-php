<?php

namespace Checkout\Tests\Customers\Four;

use Checkout\CheckoutApiException;
use Checkout\Customers\Four\CustomerRequest;
use Checkout\Customers\Four\CustomersClient;
use Checkout\PlatformType;
use Checkout\Tests\UnitTestFixture;

class CustomersClientTest extends UnitTestFixture
{
    private CustomersClient $client;

    /**
     * @before
     */
    public function init(): void
    {
        $this->initMocks(PlatformType::$default);
        $this->client = new CustomersClient($this->apiClient, $this->configuration);
    }


    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldGetCustomer(): void
    {

        $this->apiClient
            ->method('get')
            ->willReturn('foo');

        $response = $this->client->get("customer_id");
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldCreateCustomer(): void
    {

        $this->apiClient
            ->method('post')
            ->willReturn('foo');

        $response = $this->client->create(new CustomerRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldUpdateCustomer(): void
    {

        $this->apiClient
            ->method('patch')
            ->willReturn('foo');

        $response = $this->client->update("customer_id", new CustomerRequest());
        $this->assertNotNull($response);
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldDeleteCustomer(): void
    {

        $this->apiClient
            ->method('delete')
            ->willReturn('foo');

        $response = $this->client->delete("customer_id");
        $this->assertNotNull($response);
    }

}