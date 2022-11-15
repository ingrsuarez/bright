<?php

namespace App\Controllers;

class Secure extends BaseController
{
    public function login()
    {
        return view('templates/head') 
        . view('secure/login');
    }
    public function view($page = 'login')
    {
        if (! is_file(APPPATH . 'Views/secure/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('secure/' . $page);
    }
   
}


?>