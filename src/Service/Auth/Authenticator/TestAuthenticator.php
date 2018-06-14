<?php
declare(strict_types=1);

namespace Ridibooks\Cms\Service\Auth\Authenticator;

use Ridibooks\Cms\Service\Auth\Session\SessionStorageInterface;
use Symfony\Component\HttpFoundation\Request;

class TestAuthenticator extends BaseAuthenticator
{
    const AUTH_TYPE = 'test';

    /** @var string $test_user */
    private $test_user_id;

    public function __construct(SessionStorageInterface $session, string $test_user_id)
    {
        parent::__construct(self::AUTH_TYPE, $session);
        $this->test_user_id = $test_user_id;
    }

    /**
     * @throws \Exception
     */
    public function createCredential(Request $request)
    {
        $this->session->set(BaseAuthenticator::KEY_USER_ID, $this->test_user_id);
        $this->session->set(BaseAuthenticator::KEY_ACCESS_TOKEN, 'test');

        return $this->test_user_id;
    }

    public function validateCredential($test_user_id)
    {
        // Do nothing
    }

    public function getUserId($test_user_id): string
    {
        return $test_user_id;
    }
}
