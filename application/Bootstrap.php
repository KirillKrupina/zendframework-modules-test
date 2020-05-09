<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

//    protected function _initDB() {
//        $config = array(
//            'host' => 'localhost',
//            'username' => 'root',
//            'password' => '',
//            'dbname' => 'zfdb',
//            'charset' => 'utf8'
//        );
//        try {
//            $db = Zend_Db::factory('Pdo MySql', $config);
//        } catch (Zend_Db_Exception $e) {
//            echo 'Error: #' . $e;
//        }
//
//        if (!isset($db)) {
//            echo 'DB is undefined';
//        } else {
//            Zend_Db_Table::setDefaultAdapter($db);
//        }
//
//    }

    protected function _initLog()
    {
        $log = new Zend_Log();
        $log->addWriter(new Zend_Log_Writer_Stream(array(
            'stream' => APPLICATION_PATH . '/../data/logs/production.log'
        )));
    }

    protected function _initView() {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        $view->doctype('XHTML1_TRANSITIONAL');

        // setSeparator() - между общим названием сайта и названием страницы будет ставить разделитель
        $view->headTitle('ZF TEST')->setSeparator(' - ');

        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')
                         ->appendName('author', 'Author`s Name');

        $view->headLink()->appendStylesheet('/public/css/main.css');

        $view->headScript()->appendFile('/public/vendor/jquery/jquery-3.3.1.min.js');
    }

    protected function _initHelpers() {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();


    }
}

