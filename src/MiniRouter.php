<?php
namespace Ridibooks\Cms;

use Ridibooks\Cms\Service\AdminAuthService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MiniRouter
{
    /**
     * @param Request $request
     * @return null|Response
     */
    public static function shouldRedirectForLogin(Request $request)
    {
        // thrift request
        if (in_array('application/x-thrift', $request->getAcceptableContentTypes())) {
            return null;
        }

        if (self::onLoginPage($request)) {
            return null;
        }

        $login_required_response = AdminAuthService::authorize($request);
        if ($login_required_response !== null) {
            return $login_required_response;
        }

        return null;
    }

    /**
     * @param Request $request
     * @return bool
     */
    private static function onLoginPage($request)
    {
        $login_urls = [
            '/login',
            '/logout',
            '/authorize',
        ];

        foreach ($login_urls as $login_url) {
            if (strncmp($request->getRequestUri(), $login_url, strlen($login_url)) === 0) {
                return true;
            }
        }
    }
}
