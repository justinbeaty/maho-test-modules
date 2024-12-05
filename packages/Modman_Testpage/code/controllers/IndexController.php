<?php

class Modman_Testpage_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $success = [
            'Modman Simple' => false,
            'Modman Complex A' => false,
            'Modman Complex B' => false,
            'Modman No Link' => false,
            'Composer Map' => false,
        ];

        try {
            $msg = $this->getLayout()->createBlock('modman_simple/test')->toHtml();
            if (trim($msg) === 'test') {
                $success['Modman Simple'] = true;
            }
        } catch (Throwable $e) {
            throw $e;
        }

        try {
            $msg = Mage::getModel('modman_complex_a/test')->test();
            if ($msg === 'test from modman complex a') {
                $success['Modman Complex A'] = true;
            }
        } catch (Throwable $e) {
        }

        try {
            $msg = Mage::getModel('modman_complex_b/test')->test();
            if ($msg === 'test from modman complex b') {
                $success['Modman Complex B'] = true;
            }
        } catch (Throwable $e) {
        }

        try {
            if (!file_exists(BP . '/vendor/mahocommerce/maho-modman-symlinks/modman/nolink')) {
                $success['Modman No Link'] = true;
            }
        } catch (Throwable $e) {
        }

        try {
            $files = ['README.md', 'public/js/foo.js', 'public/js/bar.js', 'lib/foo.php', 'lib/bar.php'];
            foreach ($files as $file) {
                if (!file_exists(BP . '/vendor/mahocommerce/maho-modman-symlinks/modman/composermap/' . $file)) {
                    throw new Exception;
                }
            }
            $success['Composer Map'] = true;
        } catch (Throwable $e) {
        }

        echo '<h1>Modman Test Page</h1>';
        echo '<table>';
        foreach ($success as $k => $v) {
            $v = $v ? 'Success' : 'Fail';
            echo "<tr class='$v'><td>$k</td><td>$v</td></tr>";
        }
        echo '</table>';
        echo '<style>td{padding:5px}tr.Fail{color:red}tr.Success{color:green}</style>';
    }
}
