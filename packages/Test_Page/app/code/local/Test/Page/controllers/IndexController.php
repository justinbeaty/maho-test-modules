<?php

class Test_Page_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $success = [
            'AW Core' => false,
            'Basic Mod A' => false,
            'Basic Mod B' => false,
            'Core Override' => false,
            'Zend Override Require' => false,
            'Zend Override Autoload' => false,
        ];

        $config = Mage::app()->getConfig()->getNode('default/some/config');

        try {
            Mage::getModel('awcore/test')->test();
            $success['AW Core'] = true;
        } catch (Throwable $e) {
        }

        try {
            Mage::getModel('basic_mod/a')->test();
            $success['Basic Mod A'] = true;
        } catch (Throwable $e) {
        }

        try {
            basic_mod_model_b::$test;
            $success['Basic Mod B'] = true;
        } catch (Throwable $e) {
        }

        try {
            $msg = $this->getLayout()->createBlock('page/html_welcome')->toHtml();
            if ($msg === 'Welcome from Core_Override') {
                $success['Core Override'] = true;
            }
        } catch (Throwable $e) {
        }

        try {
            $filter = new Zend_Filter_LocalizedToNormalized(
                ['locale' => Mage::app()->getLocale()->getLocaleCode()]
            );
            if ($filter->filter(42) === 'success') {
                $success['Zend Override Require'] = true;
            }
        } catch (Throwable $e) {
        }

        try {
            if (Zend_Locale_Math::round(42) === 'success') {
                $success['Zend Override Autoload'] = true;
            }
        } catch (Throwable $e) {
        }

        echo '<h1>Test Page</h1>';
        echo '<table>';
        echo "<tr><td>Conflicting Config</td><td>$config</td></tr>";
        foreach ($success as $k => $v) {
            $v = $v ? 'Success' : 'Fail';
            echo "<tr class='$v'><td>$k</td><td>$v</td></tr>";
        }
        echo '</table>';
        echo '<style>td{padding:5px}tr.Fail{color:red}tr.Success{color:green}</style>';
    }
}
