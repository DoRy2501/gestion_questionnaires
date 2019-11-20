<?php

class Home_Test extends TestCase {
    /**************
     * TEST METHODS
     **************/
    /**
     * Test for `Home::index`
     * 
     * @dataProvider provider_index
     *
     * @param integer $access_level = Access level to set for the test
     * @param boolean $redirect_expected = Whether a redirect is expected
     * @return void
     */
    public function test_index(int $access_level, bool $redirect_expected)
    {
        $this->_login($access_level);

        $output = $this->request('GET', 'home/index');

        if($redirect_expected) {
            $this->assertRedirect('questionnaire');
        } else {
            $this->assertContains('Vous êtes connecté en tant qu\'utilisateur.', $output);
        }
    }
    /**
     * Test for `Home::index` while not logged in
     *
     * @return void
     */
    public function test_index_unlogged()
    {
        $this->_logout();

        $this->request('GET', 'home/index');

        $this->assertRedirect('auth/login');
    }

    /***********
     * PROVIDERS
     ***********/
    /**
     * Provider for `test_index`
     *
     * @return array
     */
    public function provider_index() : array
    {
        $data = [];

        $data['user'] = [
            ACCESS_LVL_USER,
            FALSE
        ];

        $data['manager'] = [
            ACCESS_LVL_MANAGER,
            TRUE
        ];

        $data['admin'] = [
            ACCESS_LVL_ADMIN,
            TRUE
        ];

        return $data;
    }

    /**************
     * MISC METHODS
     **************/
    /**
     * Sets $_SESSION correctly to make the pages think someone is logged in.
     *
     * @param integer $access_level = Access level that is needed
     * @return void
     */
    private function _login(int $access_level)
    {
        $this->_logout();
        $_SESSION['user_access'] = $access_level;
        $_SESSION['logged_in'] = TRUE;
    }
    /**
     * Destroys the contents of $_SESSION and resets the session
     *
     * @return void
     */
    private function _logout()
    {
        $_SESSION = [];
        session_reset();
    }
}