<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authenticate = service('authentication');

        if (!$authenticate->check()) {
            session()->set('redirect_url', current_url());
            return redirect('login');
        } else {
            if (count(array_intersect($authenticate->user()->roles, $arguments)) == 0) {
                return redirect()->to('/');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
