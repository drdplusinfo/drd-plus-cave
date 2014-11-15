<?php

namespace DrdPlus\Cave\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request)
    {
        return $this->render(
            'DrdPlusCaveSecurityBundle:Security:login.html.twig',
            array(
                'last_username' => $this->getLastEnteredUserName($request),
                'error' => $this->getTheLastLoginError($request),
            )
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getTheLastLoginError(Request $request)
    {
        $error = '';
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } else {
            $session = $request->getSession();
            if (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
                $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
                $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
            }
        }

        return $error;
    }

    private function getLastEnteredUserName(Request $request)
    {
        $session = $request->getSession();
        return !is_null($session)
            ? $session->get(SecurityContextInterface::LAST_USERNAME)
            : '';
    }

}
