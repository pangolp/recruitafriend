<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * BlizzCMS
 *
 * An Open Source CMS for "World of Warcraft"
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017 - 2021, WoW-CMS
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */

class RecruitFriend extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('recruit_model');

        if (!ini_get('date.timezone')) {
            date_default_timezone_set($this->config->item('timezone'));
        }

        if (!$this->wowgeneral->getMaintenance()) {
            redirect(base_url('maintenance'), 'refresh');
        }

        if (!$this->wowauth->isLogged()) {
            redirect(base_url('login'), 'refresh');
        }
    }

    public function index()
    {
        $id = $this->recruit_model->getAccountID($this->session->userdata('wow_sess_id'));
        $recruiter = $this->recruit_model->getRecruiterID($this->session->userdata('wow_sess_id'));

        $data = array(
            'pagetitle' => $this->lang->line('tab_recruit_friend'),
            'lang' => $this->lang->lang(),
            'recruiter' => $recruiter,
            'id' => $id
        );

        $this->template->build('index', $data);
    }

    public function add()
    {
        $recruit = $this->input->post('recruit');
        echo $this->recruit_model->setRecruiter($recruit);
    }
}
