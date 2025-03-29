<?php

namespace Deviddev\BillingoApiV3Wrapper\Tests;

use Deviddev\BillingoApiV3Wrapper\BillingoApiV3NativeWrapper as Billingo;
use PHPUnit\Framework\TestCase;

final class NativeWrapperTest extends TestCase
{

    /**
     * Partner data
     *
     * @var array
     */
    protected array $partner = [
        'name' => 'Test Company',
        'address' => [
            'country_code' => 'HU',
            'post_code' => '1010',
            'city' => 'Budapest',
            'address' => 'Nagy Lajos 12.',
        ],
        'emails' => ['test@company.hu'],
        'taxcode' => '',
    ];

    /**
     * Partner update data
     *
     * @var array
     */
    protected array $partnerUpdate = [
        'name' => 'Test Company updated',
        'address' => [
            'country_code' => 'HU',
            'post_code' => '1010',
            'city' => 'Budapest',
            'address' => 'Nagy Lajos 12.',
        ],
        'emails' => ['test@company.hu'],
        'taxcode' => '',
    ];

    /**
     * Hold billingoApi instance
     *
     * @var \Deviddev\BillingoApiV3Wrapper\BillingoApiV3NativeWrapper
     */
    protected Billingo $billingoApi;

    /**
     * Set up partner id accross tests
     *
     * @return integer|null
     */
    protected function &getPartnerId(): ?int
    {
        static $partnerId = null;
        return $partnerId;
    }

    /**
     * Set up variables
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->billingoApi = new Billingo('YOUR_API_V3_KEY');
    }

    /**
     * Test that partner create contains partner id
     *
     * @throws \Exception
     * @return void
     */
    public function testPartnerApiCreateContainsId(): void
    {
        $billingoApi = $this->billingoApi->api('Partner')->model('PartnerUpsert', $this->partner)->create()->getId();

        $partnerId = &$this->getPartnerId();

        $partnerId = $billingoApi;

        $this->assertIsInt($billingoApi);
    }

    /**
     * Test that partner create response contains partner name
     *
     * @throws \Exception
     * @return void
     */
    public function testPartnerApiCreateResponseContainsPartner(): void
    {
        $billingoApi = $this->billingoApi->api('Partner')->model('PartnerUpsert', $this->partner)->create()->getResponse();

        $this->assertContains('Test Company', $billingoApi);
    }

    /**
     * Test that partner update conatins partner id
     *
     * @throws \Exception
     * @return void
     */
    public function testPartnerApiUpdateContainsId(): void
    {
        $partnerId = &$this->getPartnerId();

        $billingoApi = $this->billingoApi->api('Partner')->model('PartnerUpsert', $this->partner)->update($partnerId)->getId();

        $this->assertIsInt($billingoApi);
    }

    /**
     * Test that partner update response contains partner name
     *
     * @throws \Exception
     * @return void
     */
    public function testPartnerApiUpdateResponseContainsPartner(): void
    {
        $partnerId = &$this->getPartnerId();

        $billingoApi = $this->billingoApi->api('Partner')->model('PartnerUpsert', $this->partnerUpdate)->update($partnerId)->getResponse();

        $this->assertContains('Test Company updated', $billingoApi);
    }

}
