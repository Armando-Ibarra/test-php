<?php

namespace Checkout\Tests\Payments;

use Checkout\CheckoutApiException;
use Checkout\Payments\VoidRequest;

class VoidPaymentsIntegrationTest extends AbstractPaymentsIntegrationTest
{

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldVoidCardPayment(): void
    {
        $this->markTestSkipped("unstable");
        $paymentResponse = $this->makeCardPayment();

        $voidRequest = new VoidRequest();
        $voidRequest->reference = uniqid("shouldVoidCardPayment");

        $response = $this->defaultApi->getPaymentsClient()->voidPayment($paymentResponse["id"], $voidRequest);
        $this->assertResponse($response,
            "action_id",
            "reference");
    }

    /**
     * @test
     * @throws CheckoutApiException
     */
    public function shouldVoidCardPayment_Idempotent(): void
    {
        $this->markTestSkipped("unstable");
        $paymentResponse = $this->makeCardPayment();

        $voidRequest = new VoidRequest();
        $voidRequest->reference = uniqid("shouldVoidCardPayment");

        $response1 = $this->defaultApi->getPaymentsClient()->voidPayment($paymentResponse["id"], $voidRequest, $this->idempotencyKey);
        self::assertNotNull($response1);

        $response2 = $this->defaultApi->getPaymentsClient()->voidPayment($paymentResponse["id"], $voidRequest, $this->idempotencyKey);
        self::assertNotNull($response2);

        self::assertEquals($response1["action_id"], $response2["action_id"]);
    }

}
