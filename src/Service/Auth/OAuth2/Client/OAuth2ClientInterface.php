<?php
declare(strict_types=1);

namespace Ridibooks\Cms\Service\Auth\OAuth2\Client;

use Ridibooks\Cms\Service\Auth\OAuth2\OAuth2Credential;

interface OAuth2ClientInterface
{
    public function getAuthorizationUrl(string $scope = null, string $state = null): string;

    public function getTokenWithAuthorizationGrant(string $code): OAuth2Credential;

    public function getTokenWithRefreshGrant(string $refresh_token): OAuth2Credential;

    public function validateToken(string $access_token);

    public function introspectResourceOwner(string $access_token): array;
}
