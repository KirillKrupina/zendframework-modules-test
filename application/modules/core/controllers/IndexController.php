<?php

class IndexController extends Zend_Controller_Action
{


    public function indexAction()
    {
        $this->view->a = $this->_request->getParam('a', 100);

        echo $this->_request->getParam('param');

        // regular
//        echo $this->_request->getParam(1);

    }

    public function listAction() {

        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

       $users = $this->getUsers();

        return $this->_helper->json->sendJson(array(
            'success' => true,
            'rows' => $users,
            'count' => sizeof($users)
        ));

    }

    public function reportAction() {
        $users = $this->getUsers();

        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        Core_Model_Reports_UsersReportXLS::generate($users, 'filename.xls');



    }

    protected function getUsers() {

        $usersModel = new Core_Model_Users();

        $id_param = $this->getRequest()->getParam('id');
        $fullname_param = $this->getRequest()->getParam('fullname');

        if ($id_param != null) {
            $usersModel->whereUserId($id_param);
        }
        if ($fullname_param != null) {
            $usersModel->whereFullnameLike($fullname_param);
        }

        $users = $usersModel->myfetchAll();
        return $users;

    }

}

