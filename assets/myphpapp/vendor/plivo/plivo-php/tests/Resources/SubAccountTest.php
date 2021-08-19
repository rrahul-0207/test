<?php

namespace Plivo\Tests\Resources;


use Plivo\Http\PlivoRequest;
use Plivo\Http\PlivoResponse;
use Plivo\Tests\BaseTestCase;

/**
 * Class SubAccountTest
 * @package Plivo\Tests\Resources
 */
class SubAccountTest extends BaseTestCase
{
    function testSubAccountCreate()
    {
        $subAccountAuthId = "MAssssssssssssssssss";
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Subaccount/',
            [
                'name' => "name",
                'enabled' => true,
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/subaccountCreateResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->subAccounts->create('name', true);

        $actual = json_decode($actual);

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->api_id, "97c8d1de-3f08-11e7-b6f4-061564b78b75");
        self::assertEquals($actual->auth_id, "SANDLHYZBIZMU4ZDEXNM");
        self::assertEquals($actual->auth_token, "MTMzZTZjNzdiNDVmY2VhZDQyNTUwYWVjNzI2OThk");
        self::assertEquals($actual->message, "created");
    }

    function testSubAccountList()
    {
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Subaccount/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/subaccountListResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->subAccounts->list;

        $this->assertRequest($request);

        self::assertNotNull($actual);

        $actual = json_decode($actual);

        $resource = false;
        foreach($actual->objects as $object) {
            if(stripos($object->resource_uri, "/v1/Account/MAXXXXXXXXXXXXXXXXXX/") !== false) {
                $resource = true;
            }
            self::assertEquals($resource, true);
        }
    }

    function testSubAccountGet()
    {
        $subAccountAuthId = "MAssssssssssssssssss";
        $request = new PlivoRequest(
            'GET',
            'Account/MAXXXXXXXXXXXXXXXXXX/Subaccount/' . $subAccountAuthId . '/',
            []);
        $body = file_get_contents(__DIR__ . '/../Mocks/subaccountGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $actual = $this->client->subAccounts->get($subAccountAuthId);

        $this->assertRequest($request);

        self::assertNotNull($actual);

        self::assertEquals($actual->account, "/v1/Account/MAXXXXXXXXXXXXXXXXXX/");
    }

    function testSubAccountModify()
    {
        $subAccountAuthId = "MAssssssssssssssssss";
        $request = new PlivoRequest(
            'POST',
            'Account/MAXXXXXXXXXXXXXXXXXX/Subaccount/' . $subAccountAuthId . '/',
            [
                'name' => "name",
                'enabled' => true,
            ]);
        $body = file_get_contents(__DIR__ . '/../Mocks/subaccountGetResponse.json');

        $this->mock(new PlivoResponse($request,200, $body));

        $subAccount = $this->client->subAccounts->get($subAccountAuthId);

        $body = file_get_contents(__DIR__ . '/../Mocks/subaccountModifyResponse.json');

        $this->mock(new PlivoResponse($request,202, $body));

        $actual = $subAccount->update("name", true);

        $this->assertRequest($request);


        self::assertNotNull($actual);

        self::assertEquals($actual->message, "changed");
    }

    function testSubAccountDelete()
    {
        $subAccountAuthId = "MAssssssssssssssssss";
        $request = new PlivoRequest(
            'DELETE',
            'Account/MAXXXXXXXXXXXXXXXXXX/Subaccount/' . $subAccountAuthId . '/',
            []);

        $this->mock(new PlivoResponse($request,204, null));

        $actual = $this->client->subAccounts->delete($subAccountAuthId);

        $this->assertRequest($request);

        self::assertNotNull($actual);
    }
}
